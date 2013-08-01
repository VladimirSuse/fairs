<?php

function generateTable($data, $equip) {
?>
<thead>
    <th>Name</th>
    <th>Start/End</th>
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
    <td itemprop="event_name"><p><?= htmlspecialchars($r['name_en']) . "<br/>" . htmlspecialchars($r['name_fr']); ?></p></td>
    <td itemprop="start_end_date"><p><?= htmlspecialchars($r['start_date']) . "<br/>" . htmlspecialchars($r['end_date']); ?></p>
        
        <!-- Metadata -->
        <div style="display: none">
            <p itemprop="event_location"><?= htmlspecialchars($r['location_en']) . "<br/>" . htmlspecialchars($r['location_fr']); ?></p>
            <p itemprop="website_en"><?= htmlspecialchars($r['website_en']) ?></p>
            <p itemprop="website_fr"><?= htmlspecialchars($r['website_fr']) ?></p> 
        </div>
    </td>
<?php } 

function generateCard($data) {
    ?>
    <form method="POST" class="card" id="form<?= $data['id'] ?>">
        <div class="row top-bar">
            <p id="item_id">Event <?= $data['id']; ?></p>
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="card-title"><?= $data["name_en"] . "<br/>" . $data["name_fr"] ?></span></h3>
        </div>
        <div class="row">
            <div class="row">
                <h4>General Info</h4>
            </div>
            <div class="row">
                <div class="seven columns">
                    <input type="hidden" class="card-value" name="id" id="id" value="<?= $data['id'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="seven columns">
                    <input type="hidden" class="card-value" name="publish" id="publish" value="<?= $data['publish'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="seven columns">
                    <input type="hidden" class="card-value" name="old_id" id="old_id" value="<?= $data['old_id'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="name_en" class="card-label">Name (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="name_en" id="name_en" value="<?= $data['name_en'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="name_fr" class="card-label">Name (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="name_fr" id="name_fr" value="<?= $data['name_fr'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="price" class="card-label">Price</label>
                </div>
                <div class="seven columns">
                    <input type="number" class="card-value" name="price" id="price" min="0" value="<?= $data['price'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="location_en" class="card-label">Location (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="location_en" id="location_en" value="<?= $data['location_en'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="location_fr" class="card-label">Location (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value" name="location_fr" id="location_fr" value="<?= $data['location_fr'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="start_date" class="card-label">Start Date</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="start_date" id="start_date" value="<?= $data['start_date'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="end_date" class="card-label">End Date</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="end_date" id="end_date" value="<?= $data['end_date'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="website_en" class="card-label">Website (En)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="website_en" id="website_en" value="<?= $data['website_en'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="website_fr" class="card-label">Website (Fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="website_fr" id="website_fr" value="<?= $data['website_fr'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="capacity" class="card-label">Capacity</label>
                </div>
                <div class="seven columns">
                    <input type="number" class="card-value" name="capacity" id="capacity" min="0" value="<?= $data['capacity'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <label for="description_en"><h4>Description (En)</h4></label>
                </div>
                <div class="sixteen columns">
                    <textarea class="card-value editable" name="description_en" id="description_en"><?= $data['description_en'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <label for="description_fr"><h4>Description (Fr)</h4></label>
                </div>
                <div class="sixteen columns">
                    <textarea class="card-value editable" name="description_fr" id="description_fr"><?= $data['description_fr'] ?></textarea>
                </div>
            </div>
            <div class="row" id="saveRow">
                <div class="centered three columns">
                    <div class="medium btn secondary metro"><a id="submitFormButton" type="submit"><i class="icon-check"></i>Save </a></div>
                </div>
                <div class="six columns" style="text-align: right">
                    <p id="updated_on"><?= ($data['last_updated'] ? 'Updated ' . $data['last_updated'] : '') ?></p>
                </div>
            </div>  
        </div>
    </form>
    <?php
}
?>