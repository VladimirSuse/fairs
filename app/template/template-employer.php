<table id="mainTable">
   <?php generateEmployerTable($data); ?>
</table>
</div>
<div class="five columns">
    <div class="row" id="oriCard">
        <?php
            generateEmployerCard(array());   
        ?> 
    </div> 
     <div class="row" id="contactCard">
        <?php  generateContactCard(array()); 
        ?>
    </div>
</div>                          
<div class="five columns">
    <?php require "../event/view.php" ?>
            <?php  generateCard(array()) ?>       
</div>    
</div>