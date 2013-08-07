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
        <div id="employerTableDiv">
            <h3>Registered Employers</h3>
            <table id="employerTable">
                <thead>
                    <th>Name</th>
                </thead>
                <tbody>
                    <td itemprop="org_name"></td>
                </tbody>
            </table>
        </div>
        <?php
            generateEmployerCard(array());
        ?>
    </div>
    <div class="card" id="contactCard">
        <?php
            generateContactCard(array());
        ?>
    </div>
</div>