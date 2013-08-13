function initializePage() {
    populate();

    $('#mainTable').dataTable({
        "iDisplayLength": -1,
        "aaSorting": [[0, "asc"]],
        "sDom": 'frt',
        "fnDrawCallback": function() {
            highlightSelectedRow();
        }
        
    });
    $('#eventTable').dataTable({
        "iDisplayLength": -1,
        "aaSorting": [[0, "asc"]],
        "sDom": 'frt',
        "fnDrawCallback": function() {
            highlightSelectedRow();
        }
        
    });

    $('#mainTable_filter').addClass('field');
    $('#mainTable_filter input').addClass('normal search input');

    // The selected_row variable describes which the item_id of the currently selected row, or -1 if no row is selected.
    window.selected_row = -1;

    //listener add/edit employer form submission
    $('#emp_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            type: $('#emp_form').attr('method'),
            dataType:'json',
            url:"index.php?page=add-edit-employer",
            data: $('#emp_form').serialize(),
            success:function(data){
                console.log(data['emp_info']);
                if(data['type'] == 'add'){
                    $('#mainTable').dataTable().fnAddData([
                        '<p>' + data['emp_info'][0].org_name_en + '<br>' + data['emp_info'][0].org_name_fr + '</p>'+
                        '<div data-id="' + data['emp_info'][0].id + '" style="display:none">'+
                            '<p itemprop="' + data['emp_info'][0].dep_name_en + '">' + data['emp_info'][0].dep_name_fr + '</p>'+
                            '<p itemprop="' + data['emp_info'][0].website_en + '">' + data['emp_info'][0].website_en + '</p>'+
                            '<p itemprop="' + data['emp_info'][0].website_fr + '">' + data['emp_info'][0].website_fr + '</p>'+
                        '</div>'  
                    ]);
                    $('tr:has(div[data-id="' + data['emp_info'][0].id + '"])').attr('data_item_id', data['emp_info'][0].id);
                    showMessage('Employer was successfully added.');
                    $("#mainTable tr[data_item_id='"+ data['emp_info'][0].id+"']").trigger("click");
                }
                else if(data['type'] == 'update'){
                    if(data['success'] == "true"){ 
                        var node = $('tr[data_item_id="' + $("#employer_id").val() + '"]')[0];
                        var location = $('#mainTable').dataTable().fnGetPosition(node);             
                        $('#mainTable').dataTable().fnUpdate([
                            "<p>" + $("#employer_org_name_en").val() + "<br/>" + $("#employer_org_name_fr").val() + "</p>"
                            ],
                            location
                        );
                        showMessage('Employer was successfully updated.');
                    }
                }
            }
        });
    });
    
    //event handler for when the user clicks add a contact
    $('#add-contacts').on('click', function(e){
        e.preventDefault();
        $('.contact-card-value').val("");
        $('#contacts-select').empty();
        $('#contacts-list').hide();
        $('#no-contacts').hide();
        $('#contact_form').fadeIn();

    });

    //listener for when the user cllicks view registered/unergistered events
    $(".toggle-events").on("click", function(){
        if($(this).attr('id') == "view-registered-events"){
            $(this).hide();
            $("#mainTable tr[data_item_id='"+ $("#employer_id").val()+"']").trigger("click");
        }    
        else{
            $.ajax({
                type:'post',
                dataType:'json',
                url:'index.php?page=get-unregistered-events',
                data:'id=' + $("#employer_id").val(),
                success: function(data){
                    console.log(data);
                    eventListTable(data);
                    $('#view-unregistered-events').hide();
                    $('#view-registered-events').show();
                }
            });
        }
    });

    //listener add/edit contact form submission
    $('#contact_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            type: $('#contact_form').attr('method'),
            dataType:'json',
            url:"index.php?page=add-edit-contact",
            data: $('#contact_form').serialize(),
            success:function(data){
                if(data['type'] == 'add'){
                    showMessage('Employer contact was successfully added.');  
                    listContacts(data['emp_contacts']);
                    $('#contacts-list').fadeIn();
                }
                else if(data['type'] == 'update'){
                    if(data['success'] == "true"){ 
                        showMessage('Employer contact was successfully updated.');
                    }
                }
            }
        });
    });
   
}

function populate() {

    $(document).on('click', 'tbody tr', function(e) {
        window.selected_row = $(this).attr('data_item_id');
        highlightSelectedRow();
        if($('#save-employer input').val() == "Add employer"){
            $('#save-employer input').val('Save changes');
        }
        $('#view-registered-events').hide();
        $('#view-unregistered-events').show();
        $.ajax({
            type:'post',
            dataType:'json',
            url:'index.php?page=card',
            data: 'id='+window.selected_row,
            success:function(data){
                //employer card data
                $('#employer-card-title').html('Viewing Employer');
                $('#contact-card-title').html('Employer Contacts');
                $('#card-title').html('Viewing Event Registration');
                (data['emp_info'][0] !== undefined ? cardPopulate(data['emp_info'][0],'employer') : '');
                //populate with the first contact retrieved
                if(data['emp_contacts'][0] !== undefined){
                    cardPopulate(data['emp_contacts'][0],'contact');
                    $('#no-contacts').fadeOut();
                    $('#contact_form').fadeIn();
                    listContacts(data['emp_contacts']);
                }
                else{ 
                    $('#contact_employer_id').val($('#employer_id').val());
                    $('#contact_form').fadeOut();
                    $('#no-contacts').fadeIn();
                } 
                if(data['events'][0] !== undefined){
                    $('#employee-title-name').html(data['emp_info'][0].org_name_en);
                    console.log(data['events']);
                    eventListTable(data['events']);
                    $('#no-events').hide();
                    $('#eventTable-container').fadeIn();
                }
                else{ 
                    $('#eventTable-container').hide();
                    $('#no-events').fadeIn();
                }   
            
                $('.buttonset').buttonset();
                $('#employerCard').animate({opacity: "1"}, 1000);
                $('#contactCard').animate({opacity: "1"}, 1000);
                $('#eventCard').animate({opacity: "1"}, 1000);
            }
        });
    });
}

$(document).on('click', '#add-btn', function() {
    $('#contactCard').animate({opacity: "0"}, 500);
    $('#eventCard').animate({opacity: "0"}, 500);
    $('#save-employer input').val('Add employer');
    $('.card-value').val('');
    $('#employer-card-title').text('Add a New Employer');
});

//populates the list of employers based on the selected event
function eventListTable(data) {
    $("#eventTable").dataTable().fnClearTable();
    $.each(data, function() {
        $("#eventTable").dataTable().fnAddData( [
            '<p>' + this.name_en + '<br>' + this.name_fr + '</p>' +
            '<div data-id="' + this.id + '" style="display:none">'+
                '<p itemprop="' + this.capacity + '">' + this.capacity + '</p>'+
                '<p itemprop="' + this.location_en + '">' + this.location_en + '</p>'+
                '<p itemprop="' + this.location_fr + '">' + this.location_fr + '</p>'+
                '<p itemprop="' + this.website_en + '">' + this.website_en + '</p>'+
                '<p itemprop="' + this.website_fr + '">' + this.website_fr + '</p>'+
            '</div>',
            this.start_date
        ]);
        $('tr:has(div[data-id="' + this.id + '"])').attr('data_item_id', this.id);   
    });
}

