<?php

function generateTable($data) {
?>
<thead>
    <th>Name</th>
    <th>Department</th>
</thead>
<tbody>
    <?php 
    foreach ($data as $r): ?>
    <tr data_item_id="<?= $r['id'] ?>">
        <?php generateRow($r); ?>
    </tr>
    <?php endforeach; ?>
</tbody>
<?php
}

function generateRow($r) {?>
    <td itemprop="org_name"><p><?= htmlspecialchars($r['org_name_en']) . "<br/>" . htmlspecialchars($r['org_name_fr']); ?></p></td>
    <td itemprop="dep_name"><p><?= htmlspecialchars($r['dep_name_en']) . "<br/>" . htmlspecialchars($r['dep_name_fr']); ?></p>
        
        <!-- Metadata -->
        <div style="display: none">
            <p itemprop="website_en"><?= htmlspecialchars($r['website_en']) ?></p>
            <p itemprop="website_fr"><?= htmlspecialchars($r['website_fr']) ?></p>
        </div>
    </td>
<?php } 

function generateEmployerCard() {
    ?>
    <form method="POST" class="card" id="emp_form">
        <div class="row top-bar">
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="emp-card-title">Add New Employer</span></h3>
        </div>
        <div class="row">
            <div class="row">
                <h4>General Info</h4>
            </div>
            <div class="row">
                <div class="seven columns">
                    <input type="hidden" class="card-value" name="id" id="id">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="org_ganme_en" class="card-label">Organization Name (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="org_name_en" id="org_name_en">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="org_name_en" class="card-label">Organization Name (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="org_name_fr" id="org_name_fr">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="dep_name_en" class="card-label">Department Name (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="dep_name_en" id="dep_name_en">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="dep_name_fr" class="card-label">Department name (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="dep_name_fr" id="dep_name_fr">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="website_en" class="card-label">Website (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="website_en" id="website_en">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="website_fr" class="card-label">Website (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="website_fr" id="website_fr">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="hst_exempt" class="card-label">HST exempt</label>
                </div>
                <div class="seven columns">
                   <div class="buttonset">
                       <input type='radio' name='hst_exempt' id='hst_exempt-yes' value='1'><label for='hst_exempt-yes'>Yes</label>
                       <input type='radio' name='hst_exempt' id='hst_exempt-no' checked='checked' value='0'><label for='hst_exempt-no'>No</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="pst_exempt" class="card-label">PST exempt</label>
                </div>
                <div class="seven columns">
                    <div class="buttonset">
                        <input type='radio' name='pst_exempt' id='pst_exempt-yes' value='1'><label for='pst_exempt-yes'>Yes</label>
                        <input type='radio' name='pst_exempt' id='pst_exempt-no' checked='checked' value='0'><label for='pst_exempt-no'>No</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="sixteen columns text-center">
                    <div class="medium btn secondary metro" id='add-employer'><input type="submit" value="Save"></div>  
                </div>          
            </div>
    </form>
    <?php
}
function generateContactCard() {
    ?>
    <form method="POST" class="card" id="contact_form">
        <div class="row top-bar">
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="contact-card-title">Add Employer Contact</span></h3>
        </div>
        <div class="row">
            <div class="row">
                <div class="seven columns">
                    <input type="hidden" class="card-value" name="id" id="contact_emp_id">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="first_name" class="card-label">First Name</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="first_name" id="first_name">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="last_name" class="card-label">Last Name</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="last_name" id="last_name">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="street" class="card-label">Street Address</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="street" id="street">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="street2" class="card-label">Alternate Street Address</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="street2" id="street2">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="postal_code" class="card-label">Postal Code</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="postal_code" id="postal_code">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="province" class="card-label">Province</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="province" id="province">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="city" class="card-label">City</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="city" id="city">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="country" class="card-label">Country</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="country" id="country">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="phone" class="card-label">Phone Number</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="phone" id="phone">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="extension" class="card-label">Extension</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="extension" id="extension">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="e-mail" class="card-label">Email</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="e-mail" id="e-mail">
                </div>
            </div>
            <div class="row text-center">
                <select class="chosen" id="contacts-select" data-placeholder="select a contact">
                </select>
            </div>
            <div class="row">
                <div class="sixteen columns text-center">
                    <div class="medium btn secondary metro" id='add-contact'><input type="submit" value="Save"></div>  
                </div>          
            </div></div>
    </form>
    <?php
}
?>