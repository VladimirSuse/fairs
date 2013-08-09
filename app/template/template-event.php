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
            <h3 id="employerTableDivTitle">Registered Employer(s)</h3>
            <table id="employerTable" data="true">
                <thead>
                    <th>Name</th>
                </thead>
                <tbody>
                    <td itemprop="org_name"></td>
                </tbody>
            </table>
        </div>
        <div id="employerInfo">
            <?php
                generateEmployerCard(array());
            ?>
        </div>
    </div>
    <div class="card" id="contactCard">
        <?php
            generateContactCard(array());
        ?>
    </div>
</div>