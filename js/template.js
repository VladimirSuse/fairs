// Document ready
$(function() {

	initializePage();

    $("#mainTable").animate({opacity: "1"}, 1000);
    $("#mainTable tr:first-child").click();


	$('.buttonset').buttonset().fadeIn();

	$(document).on('mouseenter', '#mainTable tr', function() {
        if ($(this).attr('data_item_id') != window.selected_row) {
            $(this).css('background-color', '#EEE');
        }
    });
    
    $(document).on('mouseleave', '#mainTable tr', function() {
        if ($(this).attr('data_item_id') != window.selected_row) {
            if ($(this).hasClass('even')) {
                $(this).css('background-color', 'rgba(255, 255, 255, 0.25)');
            } else {
                $(this).css('background-color', 'rgba(0, 0, 0, 0)');
            }
        }
    });

    keyNav();   

});

function keyNav() {
    $(document).keydown(function(e) {
        if (window.selected_row != -1 && $(':focus').length == 0) {
            var keyCode = e.keyCode || e.which;
            var arrow = {left: 37, up: 38, right: 39, down: 40};

            switch (keyCode) {
                case arrow.up:
                    var row = $('tr[data_item_id=' + window.selected_row + ']');
                    if (row.prev().length) {
                        row.prev().click();
                        
                        return false;
                    }
                    break;
                case arrow.down:
                    var row = $('tr[data_item_id=' + window.selected_row + ']');
                    if (row.next().length) {
                        row.next().click();
                       
                        return false;
                    }
                    break;
            }
        }
    });
}

function highlightSelectedRow() {
    $('tr.odd').css('background-color', 'rgba(0, 0, 0, 0)');
    $('tr.even').css('background-color', 'rgba(255, 255, 255, 0.25)');
    $('tr').css('color', '#555');
    $('tr[data_item_id=' + window.selected_row + ']').css('background-color', 'rgb(66, 165, 66)');
    $('tr[data_item_id=' + window.selected_row + ']').css('color', 'rgb(255, 255, 255)');
}

function clearForm() {
    $('.card-value').val('');
}

function showMessage(message) {
    $('#message p').text(message);
    $('#message').animate({top: '10px', opacity: '1.0'}, 300, 'easeOutCubic').delay(1000).animate({top: '-35px', opacity: '0.0'}, 300, 'easeOutCubic');
}

function populateEventCard(e) {
    $('#event-card-title').closest("form.card").attr("id", "form" + e.id);
    $('#event-card-title').html("Event Card");
    $('#event_item_id').html("Event " + e.id);
    $('#event_id').val(e.id);
    $('#event_old_id').val(e.old_id);
    $('#event_name_en').val(e.name_en);
    $('#event_name_fr').val(e.name_fr);
    $('#event_publish').val(e.publish);
    $('#event_price').val(e.price);
    $('#event_location_en').val(e.location_en);
    $('#event_location_fr').val(e.location_fr);
    $('#event_start_date').val(e.start_date);
    $('#event_end_date').val(e.end_date);
    $('#event_website_en').val(e.website_en);
    $('#event_website_fr').val(e.website_fr);
    $('#event_capacity').val(e.capacity);
    $('#event_description_en').val(e.description_en);
    $('#event_description_fr').val(e.description_fr);
}