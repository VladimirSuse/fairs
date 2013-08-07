<table id="mainTable">
   <?php generateEmployerTable($data); ?>
</table>
</div>
<div class="five columns">
    <div class="row card" id="employeriCard">
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
            <?php  generateEventCard(array()) ?>     
    
    <div  class="row" id="eventTable-container">        
        <table id="eventTable">
            <thead>
                <th>Event</th>
            </thead>
            <tbody>
            </tbody>    
        </table>          
    </div>
    <div class="row" id="no-events">
        <p>This employer is not currently registered to any events</p>
        <div class="row text-center">
            <div class="metro medium btn secondary" id="register-employer"><a href="#">Register</a></div>
        </div>
    </div>    
</div>    
</div>