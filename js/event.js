function initializePage() {
    
    populate();

    $('#mainTable').dataTable({
        "iDisplayLength": 25,
        "aaSorting": [[0, "asc"]],
        "aLengthMenu":[
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
        ],
        "aoColumns": [
           { "sWidth": "2rem" },
        ],
        "bAutoWidth": false,
        "fnDrawCallback": function() {
            highlightSelectedRow();
        }
        
    });

    $('#mainTable_filter').addClass('field');
    $('#mainTable_filter input').addClass('normal search input');

    // The selected_row variable describes which the item_id of the currently selected row, or -1 if no row is selected.
    window.selected_row = -1;
   
    $(document).on("click", "#submitFormButton", function(event) {
        event.preventDefault();
        var form = $(this).closest("form.card");
        var id = form.attr("id");
        id = id.replace("form", "");

        if (window.selected_row == -1) {
            $.ajax({
                url: 'index.php?page=add', 
                data: form.serializeArray(),
                type: "POST", 
                success: function(result) {  
                    $('#mainTable').dataTable().fnAddData( [
                        "<p>" + $("#event_name_en").val() + "<br/>" + $("#event_name_fr").val() + "</p>" +
                        " <p id='justAdded' style='display: none;'>" + result + "</p>" 
                        ] 
                    );
                    $("#justAdded").parents("tr").attr("data_item_id", result).click();
                    $("#justAdded").remove();
                    showMessage("Item " + id + " added!");
                }
            });
        } else {
            $.ajax({
                url: 'index.php?page=edit', 
                data: form.serializeArray(),
                type: "POST", 
                success: function() {
                    var node = $('tr[data_item_id="' + id + '"]')[0];
                    var location = $('#mainTable').dataTable().fnGetPosition(node);    
                    $('#mainTable').dataTable().fnUpdate( [
                        "<p>" + $("#event_name_en").val() + "<br/>" + $("#event_name_fr").val() + "</p>"
                        ],
                        location
                    );
                    showMessage("Item " + id + " saved!");
                }
            });
        }
    }); 

}

function populate() {

    $(document).on('click', 'tbody tr', function(e) {
        window.selected_row = $(this).attr('data_item_id');
        highlightSelectedRow();

        $("#oriCard").css({opacity: "0"});

        $.ajax({
            url: "index.php?page=card&id=" + window.selected_row,
            dataType: "JSON",    
            success: function(data) {
                populateEventCard(data['event'][0]);
                $("#oriCard").animate({opacity: "1"}, 1000);
            }
        });

    });

}

$(document).on('click', '#add-btn', function() {
    clearForm();
    $('#event-card-title').text('Add a New Event');
    $('#event_item_id').html("New Event");
    $("#event_item_id").closest("form.card").attr("id", "form");

    window.selected_row = -1;
    $('form').attr('action', 'index.php?page=add');
    highlightSelectedRow();
});