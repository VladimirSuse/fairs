<div class="sixteen columns">
    <table id="mainTable">
       <?php generateEventTable($data); ?>
    </table>
</div>
</div>
<div class="five columns">
    <div id="oriCard">
        <?php
            generateEventCard();
        ?>
    </div>
</div>
<div class="five columns">
    <div id="employerCard">
        <?php
            generateEmployerCard();
        ?>
    </div>
    <div id="contactCard">
        <?php
            generateContactCard();
        ?>
    </div>
</div>