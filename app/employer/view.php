<?php

function generateTable($data, $equip) {
?>
<thead>
    <th><div class="small btn default metro" id="checkButton"><a href="javascript: uncheckAll();"><i class="icon-minus"></i></a></div></th>
    <th>Make</th>
    <th>Series</th>
    <th>Serial No.</th>
    <th>Date Purchased</th>
    <th>Tags</th>
</thead>
<tbody>
    <?php 
    foreach ($data as $r): ?>
    <tr item_id="<?= $r['cpu_id'] ?>">
        <?php generateRow($r, $equip); ?>
    </tr>
    <?php endforeach; ?>
</tbody>
<?php
}

function generateRow($r, $equip) {?>
    <td><input type="checkbox"></td>
    <td itemprop="cpu_make" data-make-id="<?= $r['make_id'] ?>"><p><?= htmlspecialchars($r['make_name']) ?></p></td>
    <td itemprop="cpu_mod_series"><p><?= htmlspecialchars($r['cpu_mod_series']) ?></p></td>
    <td itemprop="cpu_serial"><p><?= htmlspecialchars($r['cpu_serial']) ?></p></td>
    <td itemprop="cpu_purchased"><p><div class="star" style="color: <?= $r['cpu_rating'] ?>">&#8226;</div><time datetime="<?= date('Y-m-d', strtotime($r['cpu_purchased'])); ?>"><?= date('Y-m-d', strtotime($r['cpu_purchased'])); ?></time></p></td>
    <td itemprop="tags">
        <?php
        $tags = $equip->listTags($r['cpu_id']);
        if (isset($tags)) {
            foreach ($tags as $t) {
                $bgcolour = '(' . $t['tag_colour_r'] . ', ' . $t['tag_colour_g'] . ', ' . $t['tag_colour_b'] . ')';
                ?>
                <li class='label' style='background-color: rgb<?= $bgcolour ?>' tag_id="<?= $t['tag_id'] ?>"><?= $t['tag_name_en'] ?></li>
                <?php
            }
        }
        ?>
      
        <!-- Metadata -->

        <div style="display: none">
            <p itemprop="cpu_id_formatted"><?= htmlspecialchars($r['cpu_id_formatted']) ?></p>
            <p itemprop="cpu_mod_type"><?= htmlspecialchars($r['cpu_mod_type']) ?></p>
            <p itemprop="cpu_ip_addr"><?= htmlspecialchars($r['ipAddress']) ?></p>
            <p itemprop="cpu_mac_addr"><?= htmlspecialchars($r['cpu_mac_addr']) ?></p>
            <p itemprop="cpu_platenum"><?= htmlspecialchars($r['cpu_platenum']) ?></p>
            <p itemprop="dept_id" data-dept-id="<?= $r['dept_id'] ?>"><?= htmlspecialchars($r['dep_name_en']) ?></p>
            <p itemprop="cpu_room_number"><?= htmlspecialchars($r['cpu_room_number']) ?></p>
            <p itemprop="emp_id" data-emp-id="<?= $r['emp_id'] ?>"><?= htmlspecialchars($r['emp_firstname'] . ' ' . $r['emp_lastname']) ?></p>
            <p itemprop="cpu_warranty"><?= htmlspecialchars($r['cpu_warranty']) ?></p>
            <p itemprop="cpu_description"><?= htmlspecialchars($r['cpu_description']) ?></p>
            <p itemprop="cpu_purprice"><?= $r['cpu_purprice'] ?></p>
            <p itemprop="status" data-status-id="<?= htmlspecialchars($r['status']) ?>"><?= htmlspecialchars($r['status_name']) ?></p>
            <p itemprop="updated_on"><?= htmlspecialchars($r['updated_on']) ?></p>
        </div>
    </td>
<?php } 

function generateCard() {
    ?>
    <form method="POST" class="card" id="emp_form">
        <div class="row top-bar">
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="card-title">Add New Employer</span></h3>
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
                   <span class="buttonset">
                      <input type='checkbox' name='hst_exempt' id='hst_exempt' value='1'>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="pst_exempt" class="card-label">PST exempt</label>
                </div>
                <div class="seven columns">
                    <div class="buttonset">
                        <input type='checkbox' name='pst_exempt' id='pst_exempt' value='1'>
                    </div>
                </div>
            </div>            
    </form>
    <?php
}
?>