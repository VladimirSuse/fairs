<?php
/**
*	MySQL Connection
*
**/
// define('mysql_username', 'sass');
// define('mysql_passwrod', '@ppleP13');
// define('mysql_dbname', 'sass');
// define('mysql_host', '10.33.32.41');
// define('mysql_port', 3306);
define('mysql_username', 'sass');
define('mysql_passwrod', 'pen56nant');
define('mysql_dbname', 'sass');
define('mysql_host', 'localhost');
define('mysql_port', 3306);

class SyncObject{
	private $mysql; // mysql connection object
	
	public function __construct() {
		$this->mysql = new mysqli(mysql_host, mysql_username, mysql_passwrod, mysql_dbname);
		if ($this->mysql->connect_errno) {
			exit("mysqli connect failed: ".$this->mysql->connect_error."\n");
		}
	}

	protected function mysql_insert($data, $query, $bulk_size=1000) {
		if ($this->mysql instanceof PDO) {
			return;
		}
		else if ($this->mysql->ping()) {
			$return = FALSE;
			$sql = NULL;
			$count = 0;
			$inner_count = 0;

			while ($count < count($data)) {
				
				while($inner_count < $bulk_size){
					if (isset($data[$count])){
						$sql .= "('" . implode("','", str_replace("'", "\'", $data[$count])) . "'),";
					}
					++$inner_count;
					++$count;
				}
				
				$sql = substr($sql, 0, -1);
				$sql_query = str_replace("{DATA}", $sql, $query);
				
				if ($this->mysql->query($sql_query, MYSQLI_USE_RESULT)){
					unset($sql, $sql_query, $inner_count);
					$return = TRUE;
				}
				else{
					exit("MySQL failed: ".$this->mysql->error.", execution terminated.\n");
				}
			}
			return $return;

		} else {
			printf("MySQL Ping failed: %s,\n trying to ping the mysql server...\n", $this->mysql->error);
			if($this->mysql->ping()){
				$return = TRUE;	
			}else{
				$return = FALSE;
				exit("Re-ping mysql server failed, execution terminated.\n");	
			}
		}
	}

	protected function mysql_binding_insert($data, $table_name){
		if ($this->mysql->ping()) {
			$type = NULL;
			$query = "INSERT INTO $table_name (";
				foreach ($data as $key=>$value){
					$query .= "$key, ";
					$type .= substr(gettype($value), 0, 1);
					$queryParams[] = &$data[$key];
				}
					$query = substr($query, 0, -2);
					$query .=")";
					$query .= " VALUES (".str_repeat("?,", count($data));
					$query = substr($query, 0, -1);
					$query .=")";
					$stmt = $this->mysql->prepare($query);
				if (isset($stmt)){
					call_user_func_array('mysqli_stmt_bind_param', array_merge (array($stmt, $type), $queryParams)); 
					if($stmt->execute()){
						$stmt->close();
						return $stmt->insert_id;
					}else{
						exit("MySQL failed: ".$this->mysql->error.", execution terminated.\n");
					}
				}else{
					exit("MySQL prepare binding failed: ".$this->mysql->error.", execution terminated.\n");
				}
			} else {
				printf("MySQL Ping failed: %s,\n trying to ping the mysql server...\n", $this->mysql->error);
				if(!$this->mysql->ping()){
					exit("Re-ping mysql server failed, execution terminated.\n");	
				}
			}
		}

		protected function mysql_binding_update($data, $id, $table_name){
			if ($this->mysql->ping()) {
				$type = NULL;
				$query = "UPDATE $table_name SET ";
				foreach ($data as $key=>$value){
					$query.="$key=?, ";
					$type .= substr(gettype($value), 0, 1);
					$queryParams[] = &$data[$key];
				}
				$query = substr($query, 0, -2);
				$query.=" WHERE id=$id";
				$stmt = $this->mysql->prepare($query);
				if (isset($stmt)){
					call_user_func_array('mysqli_stmt_bind_param', array_merge (array($stmt, $type), $queryParams)); 
					if($stmt->execute()){
						$stmt->close();
						return $stmt->affected_rows;
					}else{
						exit("MySQL failed: ".$this->mysql->error.", execution terminated.\n");
					}
				}else{
					exit("MySQL prepare binding failed: ".$this->mysql->error.", execution terminated.\n");
				}
			} else {
				printf("MySQL Ping failed: %s,\n trying to ping the mysql server...\n", $this->mysql->error);
				if(!$this->mysql->ping()){
					exit("Re-ping mysql server failed, execution terminated.\n");	
				}
			}
		}

		protected function mysql_query($query){
			if ($this->mysql->ping()){
				if ($result = $this->mysql->query($query)){
					if($result && $result->num_rows > 0) {	
						$data = array();
						while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
							$data[] = $row;
						}
						$result->close();
						return $data;
					}else{
						return $result;
					}
				}else{
					exit("MySQL failed: ".$this->mysql->error.", execution terminated.\n");
				} 
			}else{
				printf("MySQL Ping failed: %s,\n trying to ping the mysql server...\n", $this->mysql->error);
				if($this->mysql->ping()){
					return TRUE;	
				}else{
					exit("Re-ping mysql server failed, execution terminated.\n");
				}
			}
		}


	}
	?>