<?php

function generateEmployerTable($data) {
?>
<thead>
    <th>Name</th>
</thead>
<tbody>
    <?php 
    foreach ($data as $r): ?>
    <tr data_item_id="<?= $r['id'] ?>">
        <?php generateEmployerRow($r); ?>
    </tr>
    <?php endforeach; ?>
</tbody>
<?php
}

function generateEmployerRow($r) {?>
    <td itemprop="org_name"><p><?= htmlspecialchars($r['org_name_en']) . "<br/>" . htmlspecialchars($r['org_name_fr']); ?></p></td>
        <!-- Metadata -->
        <div style="display: none">
            <p itemprop="dep_name_en"><?= htmlspecialchars($r['dep_name_en']) ?></p>
            <p itemprop="dep_name_fr"><?= htmlspecialchars($r['dep_name_fr']) ?></p>
            <p itemprop="website_en"><?= htmlspecialchars($r['website_en']) ?></p>
            <p itemprop="website_fr"><?= htmlspecialchars($r['website_fr']) ?></p>
        </div>
    </td>
<?php } 

function generateEmployerCard($data) {
    ?>
    <form method="POST" id="emp_form">
        <div class="row top-bar">
            <p class="item_id">Employer</p>
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="employer-card-title">Add New Employer</span></h3>
        </div>
        <div class="row">
            <div class="row">
                <h4>General Info</h4>
            </div>
            <div class="row">
                <div class="seven columns">
                    <input type="hidden" class="card-value" name="id" id="employer_id">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="org_ganme_en" class="card-label">Organization Name (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="org_name_en" id="employer_org_name_en">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="org_name_en" class="card-label">Organization Name (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="org_name_fr" id="employer_org_name_fr">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="dep_name_en" class="card-label">Department Name (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="dep_name_en" id="employer_dep_name_en">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="dep_name_fr" class="card-label">Department name (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="dep_name_fr" id="employer_dep_name_fr">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="website_en" class="card-label">Website (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="website_en" id="employer_website_en">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="website_fr" class="card-label">Website (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="website_fr" id="employer_website_fr">
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
            <div class="row edit-button">
                <div class="sixteen columns text-center">
                    <div class="medium btn secondary metro" id='save-employer'><input type="submit" value="Save changes"></div>  
                </div>          
            </div>
        </div>    
    </form>
    <?php
}
function generateContactCard($data) {
    ?>
    <form method="POST" id="contact_form">
        <div class="row top-bar">
            <p class="item_id">Contact</p>
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="contact-card-title">Add Employer Contact</span></h3>
        </div>
        <div class="row" id="contacts-list">
             <div class="nine columns">
                <label for="contacts-select" class="card-label">Viewing</label>
            </div>
            <select style="width:11em" class="chosen" id="contacts-select" data-placeholder="contact_select a contact">
            </select>
        </div>
        <div class="row">
            <div class="row">
                <div class="seven columns">
                    <input type="hidden" class="card-value contact-card-value" name="id" id="contact_id">
                </div>
            </div>
            <div class="row">
                <div class="seven columns">
                    <input type="hidden" class="card-value" name="career_employer_id" id="contact_employer_id">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="first_name" class="card-label">First Name</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="first_name" id="contact_first_name">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="last_name" class="card-label">Last Name</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="last_name" id="contact_last_name">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="street" class="card-label">Street Address</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="street" id="contact_street">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="street2" class="card-label">Alternate Street Address</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="street2" id="contact_street2">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="postal_code" class="card-label">Postal Code</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="postal_code" id="contact_postal_code">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="province" class="card-label">Province</label>
                </div>
                <div class="seven columns"> 
                    <input type="text" class="card-value contact-card-value" name="province" id="contact_province">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="city" class="card-label">City</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="city" id="contact_city">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="country" class="card-label">Country</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="country" id="contact_country">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="phone" class="card-label">Phone Number</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="phone" id="contact_phone">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="extension" class="card-label">Extension</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="extension" id="contact_extension">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="email" class="card-label">Email</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value contact-card-value" name="email" id="contact_email">
                </div>
            </div>
            <div class="row edit-button">
                <div class="sixteen columns text-center">
                    <div class="medium btn secondary metro" id='save-contact'><input type="submit" value="Save changes"></div>  
                </div>          
            </div>
        </div>    
    </form>

    <?php
}
?>