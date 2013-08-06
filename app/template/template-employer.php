<table id="mainTable">
   <?php generateEmployerTable($data); ?>
</table>
</div>
<div class="five columns">
    <div class="row card" id="oriCard">
        <?php
            generateEmployerCard(array());   
        ?> 
    </div> 
     <div class="row card" id="contactCard">
        <?php  generateContactCard(array()); 
        ?>
    </div>
</div>                          
<div class="five columns card" id="eventCard">
    <?php require "../event/view.php" ?>
            <?php  generateCard(array()) ?>       
</div>    
</div>