<?php

function generateTable($data) {
?>
<thead>
    <th>Name</th>
    <th>Price</th>
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
    <td itemprop="service_name"><p><?= htmlspecialchars($r['name_en']) . "<br/>" . htmlspecialchars($r['name_fr']); ?></p></td>
    <td itemprop="price"><p><?= htmlspecialchars($r['price']); ?></p></td>

<?php } 

function generateCard($data) {
    ?>
    <form method="POST" class="card" id="form<?= $data['id'] ?>">
        <div class="row top-bar">
            <p id="item_id">Service <?= $data['id']; ?></p>
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="card-title"><?= $data["name_en"] . "<br/>" . $data["name_fr"] ?></span></h3>
        </div>
        <div class="row">
            <div class="row">
                <div class="nine columns">
                    <input type="hidden" class="card-value" name="id" id="id" value="<?= $data['id'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="nine columns">
                    <label for="price" class="card-label">Name (en)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="name_en" id="name_en" value="<?= $data['name_en'] ?>">
                </div>
            </div>    
            <div class="row">
                <div class="nine columns">
                    <label for="price" class="card-label">Name (fr)</label>
                </div>
                <div class="seven columns">
                    <input type="text" class="card-value editable" name="name_fr" id="name_fr" value="<?= $data['name_fr'] ?>">
                </div>
            </div>    
            <div class="row">
                <div class="nine columns">
                    <label for="price" class="card-label">Price</label>
                </div>
                <div class="seven columns">
                    <input type="number" class="card-value editable" name="price" id="price" min="0" value="<?= $data['price'] ?>">
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