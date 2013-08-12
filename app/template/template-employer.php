<table id="mainTable">
   <?php generateEmployerTable($data); ?>
</table>
</div>
<div class="five columns">
    <div class="row card" id="employerCard">
        <?php
            generateEmployerCard(array());   
        ?> 
    </div> 
     <div class="row card" id="contactCard">
        <?php  generateContactCard(array()); 
        ?>
        <div class="row" id="no-contacts">
        <p>This employer currently has no contacts.</p>
            <div class="row text-center">
                <div class="metro medium btn secondary" id="add-contacts"><a href="#">Add a contact</a></div>
            </div>
        </div> 
    </div>
</div>                          
<div class="five columns card" id="eventCard">
        <div class="row top-bar">
            <p class="item_id">Event</p> 
        </div>
        
    <?php require "../event/view.php" ?>
            <?php  generateEventCard(array()) ?>     
    <div class="row">
    </div>
    <div style="width:95%;margin-top:1em" class="row" id="eventTable-container">        
        <h3>Registered events for:</h3>
        <div id="employee-title-name"></div>
        <div class="small btn secondary metro toggle-events" id="view-unregistered-events" style="display:inline-block;float:right;margin-right:1px;margin-top:1px"><a href="#">View Unregistered Events</a></div>
         <div class="small btn secondary metro toggle-events" id="view-registered-events" style="display:inline-block;float:right;margin-right:1px;margin-top:1px;display:none"><a href="#">View Registered Events</a></div>
        <table id="eventTable">
            <thead>
                <th>Event</th>
                <th>Date</th>
            </thead>
            <tbody>
            </tbody>    
        </table>          
    </div>
    <div class="row" id="no-events">
        <p>This employer is not currently registered to any events</p>
        <div class="row text-center">
            <div class="metro medium btn secondary" id="register-employer"><a href="#">Register Event</a></div>
        </div>
    </div>    
</div>    
</div>