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
                $(this).css('background-color', 'rgba(0, 0, 0, 0.025)');
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
    $('tr.even').css('background-color', 'rgba(0, 0, 0, 0.025)');
    $('tr').css('color', '#555');
    $('tr[data_item_id=' + window.selected_row + ']').css('background-color', 'rgb(66, 165, 66)');
    $('tr[data_item_id=' + window.selected_row + ']').css('color', 'rgb(255, 255, 255)');
}

// function clearForm() {
//     $('.card-value').val('');
// }

function showMessage(message) {
    $('#message p').text(message);
    $('#message').animate({top: '10px', opacity: '1.0'}, 300, 'easeOutCubic').delay(1000).animate({top: '-35px', opacity: '0.0'}, 300, 'easeOutCubic');
}

//function for populating the employer contact card
function cardPopulate(data, cardType){
    if(cardType == "employer" ){
        $('#employer_id').val(data.id);
        $('input[type="radio"]').attr('checked','');
        $('#employer_org_name_en').val(data.org_name_en);
        $('#employer_org_name_fr').val(data.org_name_fr);
        $('#employer_dep_name_en').val(data.dep_name_en);
        $('#employer_dep_name_fr').val(data.dep_name_fr);
        $('#employer_website_en').val(data.website_en);
        $('#employer_website_fr').val(data.website_fr);
        (data.hst_exempt == 0 ? $('#hst_exempt-no').attr('checked','checked') : $('#hst_exempt-yes').attr('checked','checked'));
        (data.pst_exempt == 0 ? $('#pst_exempt-no').attr('checked','checked') : $('#pst_exempt-yes').attr('checked','checked'));
    }
    else if(cardType =="contact"){
        $('#contact_id').val(data.id);
        $('#contact_first_name').val(data.first_name);
        $('#contact_last_name').val(data.last_name);
        $('#contact_street').val(data.street);
        $('#contact_street2').val(data.street2);
        $('#contact_postal_code').val(data.postal_code);
        $('#contact_province').val(data.province);
        $('#contact_city').val(data.city);
        $('#contact_country').val(data.country);
        $('#contact_phone').val(data.phone);
        $('#contact_extension').val(data.extension);
        $('#contact_e-mail').val(data['e-mail']);
    }
    else if(cardType == "event"){
        $('#event-card-title').closest("form.card").attr("id", "form" + data.id);
        $('#event-card-title').html("Event Card");
        $('#event_item_id').html("Event " + data.id);
        $('#event_id').val(data.id);
        $('#event_publish').val(data.publish);
        $('#event_old_id').val(data.old_id);
        $('#event_name_en').val(data.name_en);
        $('#event_name_fr').val(data.name_fr);
        $('#event_price').val(data.price);
        $('#event_location_en').val(data.location_en);
        $('#event_location_fr').val(data.location_fr);
        $('#event_start_date').val(data.start_date);
        $('#event_website_en').val(data.website_en);
        $('#event_website_fr').val(data.website_fr);
        $('#event_capacity').val(data.capacity);
        $('#event_description_en').val(data.description_en);
        $('#event_description_fr').val(data.description_fr);
        
    }
    else {
        //Display some sort of error
    }

}