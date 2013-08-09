<?php
function generateEventTable($data) {
?>
    <thead>
        <th>Name</th>
    </thead>
    <tbody>
        <?php 
        foreach ($data as $r): ?>
        <tr data_item_id="<?= $r['id'] ?>">
            <?php generateEventRow($r); ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
<?php
}

function generateEventRow($r) {
?>
    <td itemprop="event_name"><p><?= htmlspecialchars($r['name_en']) . "<br/>" . htmlspecialchars($r['name_fr']); ?></p></td>
<?php 
} 

function generateEventCard() {
?>
    <form method="POST" id="event_form">
        <div class="row top-bar">
            <p id="event_item_id"> New Event</p>
        </div>
        <div class="row">
            <h3><i class="<?= $icon ?>"></i> <span id="event-card-title"></span></h3>
        </div>
        <div class="row">
            <div class="row">
                <h4>General Info</h4>
            </div>
            <div class="row">
                <div class="ten columns">
                    <input type="hidden" class="card-value" name="id" id="event_id">
                </div>
            </div>
            <div class="row">
                <div class="ten columns">
                    <input type="hidden" class="card-value" name="publish" id="event_publish">
                </div>
            </div>
            <div class="row">
                <div class="ten columns">
                    <input type="hidden" class="card-value" name="old_id" id="event_old_id">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="name_en" class="card-label">Name (En)</label>
                </div>
                <div class="ten columns">
                    <input type="text" class="card-value" name="name_en" id="event_name_en">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="name_fr" class="card-label">Name (Fr)</label>
                </div>
                <div class="ten columns">
                    <input type="text" class="card-value" name="name_fr" id="event_name_fr">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="price" class="card-label">Price</label>
                </div>
                <div class="ten columns">
                    <input type="number" class="card-value" name="price" id="event_price" min="0">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="location_en" class="card-label">Location (En)</label>
                </div>
                <div class="ten columns">
                    <input type="text" class="card-value" name="location_en" id="event_location_en">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="location_fr" class="card-label">Location (Fr)</label>
                </div>
                <div class="ten columns">
                    <input type="text" class="card-value" name="location_fr" id="event_location_fr">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="start_date" class="card-label">Start Date</label>
                </div>
                <div class="ten columns">
                    <input type="text" class="card-value editable" name="start_date" id="event_start_date">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="end_date" class="card-label">End Date</label>
                </div>
                <div class="ten columns">
                    <input type="text" class="card-value editable" name="end_date" id="event_end_date">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="website_en" class="card-label">Website (En)</label>
                </div>
                <div class="ten columns">
                    <input type="text" class="card-value editable" name="website_en" id="event_website_en">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="website_fr" class="card-label">Website (Fr)</label>
                </div>
                <div class="ten columns">
                    <input type="text" class="card-value editable" name="website_fr" id="event_website_fr">
                </div>
            </div>
            <div class="row">
                <div class="six columns">
                    <label for="capacity" class="card-label">Capacity</label>
                </div>
                <div class="ten columns">
                    <input type="number" class="card-value" name="capacity" id="event_capacity" min="0">
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <label for="description_en"><h4>Description (En)</h4></label>
                </div>
                <div class="sixteen columns">
                    <textarea class="card-value editable" name="description_en" id="event_description_en"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <label for="description_fr"><h4>Description (Fr)</h4></label>
                </div>
                <div class="sixteen columns">
                    <textarea class="card-value editable" name="description_fr" id="event_description_fr"></textarea>
                </div>
            </div>
            <div class="row" id="saveRow">
                <div class="centered three columns">
                    <div class="medium btn secondary metro"><input id="submitFormButton" type="submit" value="Save"></div>
                </div>
                <div class="six columns" style="text-align: right">
                </div>
            </div>  
        </div>
    </form>
<?php
}
?>