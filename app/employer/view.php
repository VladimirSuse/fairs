<?php

function generateTable($data, $equip) {
?>
<thead>
    <th>Name</th>
    <th>Department</th>
    <th>Website</th>
</thead>
<tbody>
    <?php 
    foreach ($data as $r): ?>
    <tr data_item_id="<?= $r['id'] ?>">
        <?php generateRow($r, $equip); ?>
    </tr>
    <?php endforeach; ?>
</tbody>
<?php
}

function generateRow($r, $equip) {?>
    <td itemprop="org_name" data-emp-id="<?= $r['emp_id'] ?>"><p><?= htmlspecialchars($r['org_name_en']) . "<br/>" . htmlspecialchars($r['org_name_fr']); ?></p></td>
    <td itemprop="dep_name"><p><?= htmlspecialchars($r['dep_name_en']) . "<br/>" . htmlspecialchars($r['dep_name_fr']); ?></p></td>
    <td itemprop="website"><p><?= htmlspecialchars($r['website_en']) . "<br/>" . htmlspecialchars($r['website_fr']); ?></p></td>

        <!-- Metadata -->

        <div style="display: none">
<!--        <p itemprop="cpu_id_formatted"><?= htmlspecialchars($r['cpu_id_formatted']) ?></p>
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
            <p itemprop="updated_on"><?= htmlspecialchars($r['updated_on']) ?></p> -->
        </div>
    </td>
<?php } 

function generateCard($data, $lists, $icon) {
    ?>
    <form method="POST" class="card" id="form<?= $data['cpu_id'] ?>">
        <div class="row top-bar">
            <p id="item_id"><?= $data['cpu_id_formatted']; ?></p>
            <div id="closeCompare" class="medium btn danger metro"><a href='javascript: closeCompare("#form<?= $data['cpu_id']?>")' type="submit"><i class="icon-cancel"></i></a></div>
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="card-title"><?= $data['make_name'] . ' ' . $data['cpu_mod_series'] ?></span></h3>
        </div>
        <div class="row">
            <div class="row">
                <h4>General Info</h4>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="make_id" class="card-label">Make</label>
                </div>
                <div class="six columns">
                    <select class="card-value" name="make_id" id="make_id">
                        <?php foreach ($lists['makes'] as $make): 
                            if ($make['make_id'] == $data['make_id']) {?>
                                <option value="<?= $make['make_id'] ?>" selected><?= htmlspecialchars($make['make_name']) ?></option>
                            <?php } else { ?>
                                <option value="<?= $make['make_id'] ?>"><?= htmlspecialchars($make['make_name']) ?></option>
                            <?php }
                        endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <input type="hidden" class="card-value" name="cpu_id" id="cpu_id" value="<?= $data['cpu_id'] ?>" <?= $data['cpu_id'] ? '' : 'disabled' ?> />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_mod_series" class="card-label">Series</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value" name="cpu_mod_series" id="cpu_mod_series" value="<?= $data['cpu_mod_series'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_mod_type" class="card-label">Model No</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_mod_type" id="cpu_mod_type" value="<?= $data['cpu_mod_type'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_serial" class="card-label">Serial No</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_serial" id="cpu_serial" value="<?= $data['cpu_serial'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_platenum" class="card-label">Plate No</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_platenum" id="cpu_platenum" value="<?= $data['cpu_platenum'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_ip_addr" class="card-label">IPv4 Address</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_ip_addr" id="cpu_ip_addr" value="<?= $data['ipAddress'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_mac_addr" class="card-label">MAC Address</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_mac_addr" id="cpu_mac_addr" value="<?= $data['cpu_mac_addr'] ?>" />
                </div>
            </div>
            <div class="row">
                <h4>Warranty</h4>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_warranty" class="card-label">Duration</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_warranty" id="cpu_warranty" placeholder="(months)" value="<?= $data['cpu_warranty'] ?> months" />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_purchased" class="card-label">Purchase Date</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_purchased" id="cpu_purchased" placeholder="YYYY-MM-DD" value="<?= $data['cpu_purchased'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_purprice" class="card-label">Purchase Price</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_purprice" id="cpu_purprice" value="$<?= $data['cpu_purprice'] ?>" />
                </div>
            </div>
            <div class="row">
                <h4>Assignment</h4>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="emp_id" class="card-label">Assigned to</label>
                </div>
                <div class="six columns">
                    <select class="card-value editable choose-me" name="emp_id" id="emp_id">
                        <option value="Unassigned" selected><?= htmlspecialchars("Unassigned") ?></option>
                        <?php foreach ($lists['employees'] as $emp): 
                            if ($emp['emp_id'] == $data['emp_id']) { ?>
                                <option value="<?= $emp['emp_id'] ?>" selected><?= htmlspecialchars($emp['emp_firstname'] . ' ' . $emp['emp_lastname']) ?></option>
                            <?php } else {?>
                                <option value="<?= $emp['emp_id'] ?>"><?= htmlspecialchars($emp['emp_firstname'] . ' ' . $emp['emp_lastname']) ?></option>
                            <?php }
                        endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="dept_id" class="card-label">Department</label>
                </div>
                <div class="six columns">
                    <select class="card-value editable" name="dept_id" id="dept_id">
                        <?php foreach ($lists['departments'] as $dep):
                            if ($dep['dep_id'] == $data['dept_id']) { ?>
                                <option value="<?= $dep['dep_id'] ?>" selected><?= htmlspecialchars($dep['dep_name_en']) ?></option>
                            <?php } else { ?>
                                <option value="<?= $dep['dep_id'] ?>"><?= htmlspecialchars($dep['dep_name_en']) ?></option>
                            <?php }
                        endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="cpu_room_number" class="card-label">Room No</label>
                </div>
                <div class="six columns">
                    <input type="text" class="card-value editable" name="cpu_room_number" id="cpu_room_number" value="<?= $data['cpu_room_number'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="status" class="card-label">Status</label>
                </div>
                <div class="six columns">
                    <select class="card-value editable" name="status" id="status">
                        <option value="0" <?= $data['status'] != NULL && $data['status'] == 0 ? 'selected' : '' ?>><?= htmlspecialchars($lists['statuses'][0]) ?></option>
                        <option value="3" <?= $data['status'] != NULL && $data['status'] == 3 ? 'selected' : '' ?>><?= htmlspecialchars($lists['statuses'][3]) ?></option>
                        <option value="2" <?= $data['status'] != NULL && $data['status'] == 2 ? 'selected' : '' ?>><?= htmlspecialchars($lists['statuses'][2]) ?></option>
                        <option value="4" <?= $data['status'] != NULL && $data['status'] == 4 ? 'selected' : '' ?>><?= htmlspecialchars($lists['statuses'][4]) ?></option>
                        <option value="1" <?= $data['status'] != NULL && $data['status'] == 1 ? 'selected' : '' ?>><?= htmlspecialchars($lists['statuses'][1]) ?></option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="tag_id" class="card-label">Tags</label>
                </div>
                <div class="six columns">
                    <select class="card-value choose-me" data-placeholder=" " name="tag_id[]" id="tag_id" multiple="true">
                        <?php if ($lists['tags']) { 
                            foreach ($lists['tags'] as $tag): ?>
                            <option value="<?= $tag['tag_id'] ?>"><?= htmlspecialchars($tag['tag_name_en']) ?></option>
                        <?php endforeach; } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <label for="cpu_description"><h4>Notes</h4></label>
            </div>
            <div class="row">
                <div class="twelve columns">
                    <textarea class="card-value editable" name="cpu_description" id="cpu_description"><?= $data['cpu_description'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="push_four four columns">
                    <div class="medium btn secondary metro"><a id="submitFormButton" href='javascript: submitForm("#form<?= $data['cpu_id']?>");' type="submit"><i class="icon-check"></i>Save Changes</a></div>
                </div>
                <div class="four columns" style="text-align: right">
                    <input type="number" class="card-value editable bQ" name="bulkQuantity" id="bulkQuantity" step="1" min="1" placeholder="Number to Add" />
                    <p id="updated_on"><?= ($data['updated_on'] ? 'Updated ' . $data['updated_on'] : '') ?></p>
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>