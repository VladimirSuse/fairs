<div class="sixteen columns">
    <table id="mainTable">
       <?php generateEventTable($data); ?>
    </table>
</div>
</div>
<div class="five columns">
    <div class="card" id="oriCard">
        <?php
            generateEventCard();
        ?>
    </div>
</div>
<div class="five columns">
    <div class="card" id="employerCard">
        <?php
            generateEmployerCard();
        ?>
    </div>
    <div class="card" id="contactCard">
        <?php
            generateContactCard();
        ?>
    </div>
</div>