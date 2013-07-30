// Document ready
$(function() {

	initializePage();
	keyNav();

    $("#mainTable").animate({opacity: "1"}, 1000);

	$('.buttonset').buttonset();

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

    

});

function keyNav() {
    $(document).keydown(function(e) {
        if (window.selected_row != -1 && $(':focus').length == 0) {
            var keyCode = e.keyCode || e.which;
            var arrow = {left: 37, up: 38, right: 39, down: 40};

            switch (keyCode) {
                case arrow.up:
                    var row = $('tr[item_id=' + window.selected_row + ']');
                    if (row.prev().length) {
                        row.prev().click();
                        
                        return false;
                    }
                    break;
                case arrow.down:
                    var row = $('tr[item_id=' + window.selected_row + ']');
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