<?php
/**
*	Employer class
*	
*	This class extends SyncObject class, and it contains many functions to get/save/update tables on the database related to the Career Fairs, Employers, and Invoices.
*	@author Kwok Hong Kelvin Chan <Kelvin.Chan@uOttawa.ca>	
*	@copyright University of Ottawa, SASS IT
*	@license
*
*/

/**
*	require SyncObject class
*/
require_once "SyncObject.php";

class Employer extends SyncObject{
	/**
	*	Get table column names by given a table name
	*	@param String $table_name a table name
	*	@param array $colums column names to be stored
	*	@return an array of column name/s
	*/
	public function getColumnName($table_name){
		$returnObject = $this->mysql_query("DESCRIBE ");
		$columns = array();
		foreach ($returnObject as $key=>$field){
			array_push($columns, $returnObject[$key]['Field']);
		}
		return $columns;
	}

	/**
	*	Get employer data from career_employers table
	*	@param int $id an id represent career employer
	*	@return an array of employer/s 
	*/
	public function getAllEmployer($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employers".(isset($id) ? " WHERE id = '$id'" : ''));
	}

	/**
	*	Get employer organization name/s from career_employers table
	*	@param int $id an id represent career employer
	*	@return an array of employer organization name/s
	*/
	public function getOrganizationName($id=NULL){
		return $this->mysql_query("SELECT `org_name_en`, `org_name_fr` FROM career_employers".(isset($id) ? " WHERE id = '$id'" : ''));
	}

	/**
	*	Get employer department name/s from career_employers table
	*	@param int $id an id represent career employer
	*	@return an array of employer department name/s
	*/
	public function getDepartmentName($id=NULL){
		return $this->mysql_query("SELECT `dep_name_en`, `dep_name_fr` FROM career_employers".(isset($id) ? " WHERE id = '$id'" : ''));
	}

	/**
	*	Save employer data into career_employers table
	*	@param array $data an array of data needs to be inserted
	*	@return last insert id after insertion
	*/
	public function saveEmployer($data){
		return$this->mysql_binding_insert($data, 'career_employers');
	}

	/**
	*	Update employer data from career_employers table
	*	@param array $data an array of data needs to be updated
	*	@param int $employerID an id represent career employer
	*	@return a number of affected rows after update
	*/
	public function updateEmployer($data, $employerID){
		return $this->mysql_binding_update($data, $id, 'career_employers');
	}

	/**
	*	Get event/s from career_employer_events table
	*	@param int $id an id represent career event
	*	@return an array of event/s 
	*/
	public function getEvent($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employer_events".(isset($id) ? " WHERE id = '$id'" : ''));
	}

	/**
	*	Save event data into career_employer_events table
	*	@param array $data an array of data needs to be inserted
	*	@return last insert id after insertion
	*/
	public function saveEvent($data){
		return$this->mysql_binding_insert($data, 'career_employer_events');
	}

	/**
	*	Update event/s data from career_employer_events table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent career event
	*	@return a number of affected rows after update
	*/
	public function updateEvent($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_events');
	}

	/**
	*	Get service/s from career_employer_services table
	*	@param int $id an id represent career service
	*	@return an array of service/s 
	*/
	public function getService($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employer_services".(isset($id) ? " WHERE id = '$id'" : ''));
	}

	/**
	*	Save service data into career_employer_services table
	*	@param array $data an array of data needs to be inserted
	*	@return last insert id after insertion
	*/
	public function saveService($data){
		return$this->mysql_binding_insert($data, 'career_employer_services');
	}

	/**
	*	Update service data from career_employer_services table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent career service
	*	@return a number of affected rows after update
	*/
	public function updateService($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_services');
	}

	/**
	*	Get event registration with service/s and employer info
	*	@param int $id an id represent career employer
	*	@return an array of event registration with service/s and employer info 
	*/
	public function getEventRegistration($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employer_event_registrations emr
			JOIN career_employers em ON emr.career_employer_id = em.id
			JOIN career_employer_events e ON emr.career_employer_event_id = e.id
			JOIN career_employer_event_services es ON emr.career_employer_event_service_id = es.id
			JOIN career_employer_services s ON es.career_employer_service_id = s.id
			".(isset($id) ? " WHERE emr.career_employer_id = '$id'" : ''));
	}

	/**
	*	Save event registraton into career_employer_event_registrations table
	*	@param array $data an array of data needs to be inserted
	*	@return last insert id after insertion
	*/
	public function saveEventRegistrations($data){
		return $this->mysql_binding_insert($data, 'career_employer_event_registrations');
	}

	/**
	*	Update event registraton data from career_employer_event_registrations table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent career event registration
	*	@return a number of affected rows after update
	*/
	public function updateEventRegistrations($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_event_registrations');
	}

	/**
	*	Get event service with event/s and employer info
	*	@param int $id an id represent career event
	*	@return an array of event registration with service/s and employer info 
	*/
	public function getEventService($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employer_event_services emes
			JOIN career_employer_events e ON emes.career_employer_event_id = e.id
			JOIN career_employer_services s ON emes.career_employer_service_id = s.id
			".(isset($id) ? " WHERE e.id = '$id'" : ''));
	}

	/**
	*	Save event service into career_employer_event_services table
	*	@param array $data an array of data needs to be inserted
	*	@return last insert id after insertion
	*/
	public function saveEventService($data){
		return $this->mysql_binding_insert($data, 'career_employer_event_services');
	}


	/**
	*	Update event service data from career_employer_event_services table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent career event service
	*	@return a number of affected rows after update
	*/
	public function updateEventService($data, $id){
		return $this->mysql_binding_update($data, 'career_employer_event_services');
	}

	/**
	*	Get event invoice with event registration, event and service info
	*	@param int $id an id represent career employer
	*	@return an array of event invoice with event registration, event and service info
	*/
	public function getInvoice($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employer_invoices i
			JOIN career_employer_invoice_details id ON i.career_employer_invoice_id = id.id
			JOIN career_employer_event_registrations emr ON i.career_employer_event_registration_id = emr.id
			JOIN career_employers em ON emr.career_employer_id = em.id
			JOIN career_employer_events e ON emr.career_employer_event_id = e.id
			JOIN career_employer_event_services es ON emr.career_employer_event_service_id = es.id
			JOIN career_employer_services s ON es.career_employer_service_id = s.id
			".(isset($id) ? " WHERE emr.career_employer_id = '$id'" : ''));
	}

	/**
	*	Save event invoice into career_employer_invoices and career_employer_invoice_details table
	*	@param array $data an array of data needs to be inserted
	*	@param int $eventRegistrationID an id represent a event registration
	*	@return last insert id after insertion
	*/
	public function saveInvoice($data, $eventRegistrationID){
		$return = $this->mysql_binding_insert($data, 'career_employer_invoice_details');
		$data = array("career_employer_invoice_id"=>$return, "career_employer_event_registrations_id"=>$eventRegistrationID);
		return $this->mysql_binding_insert($data, 'career_employer_invoices');		
	}

	/**
	*	Update invoice from career_employer_invoices table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent an invoice
	*	@return a number of affected rows after update
	*/
	public function updateInvoice($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_invoices');
	}

	/**
	*	Update event invoice data from career_employer_invoice_details table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent an invoice
	*	@return a number of affected rows after update
	*/
	public function updateInvoiceDetail($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_invoice_details');
	}

	/**
	*	Get direct contact 
	*	@param int $id an id represent an employer
	*	@return an array of direct contact
	*/
	public function getDirectContact($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employer_direct_contacts emc 
			JOIN career_employers em ON emc.career_employer_id = em.id 
			JOIN career_employer_contact_details emcd ON emc.career_employer_contact_id = emcd.id
			".(isset($id) ? " WHERE emc.career_employer_id = '$id'" : ''));
	}

	/**
	*	Save direct contact 
	*	@param array $data an array of data needs to be inserted
	*	@param int $employerID an id represent an employer
	*	@return last insert id after insertion
	*/
	public function saveDirectContact($data, $employerID){
		$return = $this->mysql_binding_insert($data, 'career_employer_contact_details');
		$data = array("career_employer_contact_id"=>$return, "career_employer_id"=>$employerID);
		return $this->mysql_binding_insert($data, 'career_employer_direct_contacts');	
	}

	/**
	*	Update direct contact from career_employer_direct_contacts table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent a direct contact
	*	@return a number of affected rows after update
	*/
	public function updateDirectContact($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_direct_contacts');
	}

	/**
	*	Get billing contact 
	*	@param int $id an id represent an employer
	*	@return an array of direct contact
	*/
	public function getBillingContact($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employer_billing_contacts emc
			JOIN career_employers em ON emc.career_employer_id = em.id 
			JOIN career_employer_contact_details emcd ON emc.career_employer_contact_id = emcd.id
			".(isset($id) ? " WHERE emc.career_employer_id = '$id'" : ''));
	}

	/**
	*	Save billing contact 
	*	@param array $data an array of data needs to be inserted
	*	@param int $employerID an id represent an employer
	*	@return last insert id after insertion
	*/
	public function saveBillingContact($data, $employerID){
		$return = $this->mysql_binding_insert($data, 'career_employer_contact_details');
		$data = array("career_employer_contact_id"=>$return, "career_employer_id"=>$employerID);
		return $this->mysql_binding_insert($data, 'career_employer_billing_contacts');	
	}

	/**
	*	Update billing contact from career_employer_billing_contacts table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent a billing contact
	*	@return a number of affected rows after update
	*/
	public function updateBillingContact($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_billing_contacts');
	}

	/**
	*	Get event contact 
	*	@param int $id an id represent an event
	*	@return an array of event contact
	*/
	public function getEventContact($id=NULL){
		return $this->mysql_query("SELECT * FROM career_employer_event_contacts emc
			JOIN career_employers em ON emc.career_employer_id = em.id 
			JOIN career_employer_contact_details emcd ON emc.career_employer_contact_id = emcd.id
			".(isset($id) ? " WHERE emc.career_event_id = '$id'" : ''));
	}

	/**
	*	Save event contact 
	*	@param array $data an array of data needs to be inserted
	*	@param int $eventID an id represent an event
	*	@return last insert id after insertion
	*/
	public function saveEventContact($data, $eventID){
		$return = $this->mysql_binding_insert($data, 'career_employer_contact_details');
		$data = array("career_employer_contact_id"=>$return, "career_event_id"=>$eventID);
		return $this->mysql_binding_insert($data, 'career_employer_event_contacts');	
	}

	/**
	*	Update event contact from career_employer_event_contacts table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent an event contact
	*	@return a number of affected rows after update
	*/
	public function updateEventContact($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_event_contacts');
	}

	/**
	*	Update contact details data from career_employer_contact_details table
	*	@param array $data an array of data needs to be updated
	*	@param int $id an id represent a contact detail
	*	@return a number of affected rows after update
	*/
	public function updateContactDetail($data, $id){
		return $this->mysql_binding_update($data, $id, 'career_employer_contact_details');
	}

}
?>