function initializePage() {

    // The selected_row variable describes which the item_id of the currently selected row, or -1 if no row is selected.
    window.selected_row = -1;
    
    listeners();

    //load and format the datatables
    $('#mainTable').dataTable({
        "iDisplayLength": -1,
        "aaSorting": [[0, "asc"]],
        "aoColumns": [
           {  }
        ],
        "bAutoWidth": false,
        "fnDrawCallback": function() {
            highlightSelectedRow();
        }
        
    });

    $('#mainTable_filter').addClass('field');
    $('#mainTable_filter input').addClass('normal search input');

    $("#employerTable").dataTable({
        "iDisplayLength": -1,
        "aaSorting": [[0, "asc"]],
        "bAutoWidth": false,
        "aoColumns": [
            { "sWidth": "20rem" }
        ],
        "fnDrawCallback": function() {
            highlightSelectedRow();
        }
    });

    $("#mainTable_filter").remove();
    $("#mainTable_length").remove();
    // $("#mainTable_length").removeClass("dataTables_length").addClass("sixteen columns").empty().attr("id", "addEvent");
    // $("#addEvent").html('<div class="small btn secondary metro"><input id="add-btn" type="submit" value="Add New Event"></div>');

    $("#employerTable_paginate").remove();
    $("#employerTable_info").remove();
    $("#employerTable_length").removeClass("dataTables_length").addClass("eight columns").empty().attr("id", "registerEmployer");
    $("#registerEmployer").html('<div class="small btn secondary metro"><input id="registerEmployerButton" type="submit" value="Register New Employer"></div>');
   
}

//populates the list of employers based on the selected event
function empListTable(data) {

    $("#employerTable").dataTable().fnClearTable();

    if(data.length > 0) {
        $.each(data, function() {
            $("#employerTable").dataTable().fnAddData( [
                '<p>' + this.org_name_en + '<br>' + this.org_name_fr + '</p>' +
                " <p id='justAdded' style='display: none;'> </p>" 
            ]);
            $("#justAdded").parents("tr").attr("data_item_id", this.id);
            $("#justAdded").remove();       
        });

    }

    $("#employerTableDiv").show();
}

function listeners() {

    //handles loading card based on #mainTable click
    $(document).on('click', '#mainTable tbody tr', function() {
        window.selected_row = $(this).attr('data_item_id');
        highlightSelectedRow();

        $("#oriCard").css({opacity: "0"});

        $.ajax({
            url: "index.php?page=card&id=" + window.selected_row,
            dataType: "JSON",    
            success: function(data) {
                cardPopulate(data['event'][0], "event");
                $("#oriCard").animate({opacity: "1"}, 1000);
                $("#employerCard").animate({opacity: "1"}, 1000);
                empListTable(data['employers']);
                $("#emp_form").hide();
            }
        });

    });

     //handles loading employer based on #employerTable click
    $(document).on('click', '#employerTable tbody tr', function() {

        $("#employerTableDiv").hide();

        $.ajax({
            url: "index.php?page=employer&id=" + $(this).attr('data_item_id'),
            dataType: "JSON",    
            success: function(data) {
                cardPopulate(data['emp_info'][0], "employer");
                $("#emp_form").show();
                $("#emp_form .card-value").attr("readonly", true);
                if($("#employerTable").attr("data") == "false") {
                    $("#add-employer").show().children("input").val("Register");
                } else {
                    $("#add-employer").hide();
                }
            }
        });

    });

    //clears the current card in order to add a new event to the database
    $(document).on('click', '#add-btn', function() {
        window.selected_row = -1;

        highlightSelectedRow(); 

        $('#event_form .card-value').val('');
        $('#event-card-title').text('Add a New Event');
        $('#event_item_id').html("New Event");
        $("#employerTable").dataTable().fnClearTable();
        $("#employerCard").css({opacity: "0"});

    });

    $(document).on('click', '#add-employer', function(event) {
        event.preventDefault();

        var id = $("#employer_id").val();
        var node = $('tr[data_item_id="' + id + '"]')[0];
        var location = $('#employerTable').dataTable().fnGetPosition(node);

        $.ajax({
                url: 'index.php?page=registerEmployer', 
                data: {"employer_id": $("#employer_id").val(), "event_id": $("#event_id").val(), "service_id": "1"},
                dataType: "JSON",
                type: "POST", 
                success: function(result) {  
                    $("#emp_form").hide();
                    $("#employerTableDiv").show();
                    $('#employerTable').dataTable().fnDeleteRow(location);                    
                }
            });

        showMessage("Employer " + id + " registered!");
    });

    //switches the employerTable to employers not registered to the event
    $(document).on("click", "#registerEmployerButton", function(event) {
        
        $("#employerTable").dataTable().fnClearTable();

        if($("#employerTable").attr("data") == "true") {
            $("#employerTableDivTitle").html("Non-Registered Employer(s)");
            $("#employerTable").attr("data", "false");           
            $("#registerEmployerButton").val("Return to Registered Employer(s)");

            $.ajax({
                url: "index.php?page=notRegisteredList&id=" + $("#event_id").val(),
                dataType: "JSON",    
                success: function(data) {                
                    empListTable(data);
                }
            });

        } else {
            $("#employerTableDivTitle").html("Registered Employer(s)");
            $("#employerTable").attr("data", "true");
            $("#registerEmployerButton").val("Register New Employer");

            $.ajax({
                url: "index.php?page=registeredList&id=" + $("#event_id").val(),
                dataType: "JSON",    
                success: function(data) {                
                    empListTable(data);
                }
            });
        
        }


    });

    //handles the save button for a new event entry or editting of an existing entry
    $(document).on("click", "#submitFormButton", function(event) {
        event.preventDefault();
        var id = $("#event_id").val();

        //if: add, else: edit
        if (window.selected_row == -1) {
            $.ajax({
                url: 'index.php?page=add', 
                data: $("#event_form").serializeArray(),
                type: "POST", 
                success: function(result) {  
                    $('#mainTable').dataTable().fnAddData( [
                        "<p>" + $("#event_name_en").val() + "<br/>" + $("#event_name_fr").val() + "</p>" +
                        " <p id='justAdded' style='display: none;'>" + result + "</p>" 
                        ] 
                    );
                    $("#justAdded").parents("tr").attr("data_item_id", result).click();
                    $("#justAdded").remove();
                    showMessage("Event " + id + " added!");
                }
            });
        } else {
            $.ajax({
                url: 'index.php?page=edit', 
                data: $("#event_form").serializeArray(),
                type: "POST", 
                success: function() {
                    var node = $('tr[data_item_id="' + id + '"]')[0];
                    var location = $('#mainTable').dataTable().fnGetPosition(node);    
                    $('#mainTable').dataTable().fnUpdate( [
                        "<p>" + $("#event_name_en").val() + "<br/>" + $("#event_name_fr").val() + "</p>"
                        ],
                        location
                    );
                    showMessage("Event " + id + " saved!");
                }
            });
        }
    }); 
}