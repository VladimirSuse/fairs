function initializePage() {
    
    populate();

    $('#mainTable').dataTable({
        "iDisplayLength": 25,
        "aaSorting": [[0, "asc"]],
        "aLengthMenu":[
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
        ],
        "fnDrawCallback": function() {
            highlightSelectedRow();
        }
        
    });
    $('#eventTable').dataTable({
        "iDisplayLength": 10,
        "aaSorting": [[0, "asc"]],
        "aLengthMenu":[
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
        ],
        "fnDrawCallback": function() {
            highlightSelectedRow();
        }
        
    });

    $('#mainTable_filter').addClass('field');
    $('#mainTable_filter input').addClass('normal search input');

    // The selected_row variable describes which the item_id of the currently selected row, or -1 if no row is selected.
    window.selected_row = -1;

    //listener for editing employer form for existing employer
    $('.card-value').blur(function(){
        $('#add-employer').fadeIn();
    });

    //listener add/edit employer form submission
    $('#emp_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            type: $('#emp_form').attr('method'),
            dataType:'json',
            url:"index.php?page=add-edit-employer",
            data: $('#emp_form').serialize(),
            success:function(data){
                
                if(data['type'] == 'add'){
                    $('#mainTable').dataTable().fnAddData([
                        '<p>' + data['emp_info'][0].org_name_en + '<br>' + data['emp_info'][0].org_name_fr + '</p>',
                        '<p>' + data[0].dep_name_en + '<br>' + data[0].dep_name_fr +
                        '<div data-id="' + data['emp_info'][0].id + '" style="display:none">'+
                            '<p itemprop="' + data['emp_info'][0].website_en + '">' + data['emp_info'][0].website_en + '</p>'+
                            '<p itemprop="' + data['emp_info'][0].website_fr + '">' + data['emp_info'][0].website_fr + '</p>'+
                        '</div>'  
                    ]);
                    $('tr:has(div[data-id="' + data['emp_info'][0].id + '"])').attr('data_item_id', data['emp_info'][0].id);
                    $('#contactCard').fadeIn();
                }
                else if(data['type'] == 'update'){
                    var node = $('tr[data_item_id="' + $("#employer_id").val() + '"]')[0];
                    var location = $('#mainTable').dataTable().fnGetPosition(node);             
                    $('#mainTable').dataTable().fnUpdate([
                        "<p>" + $("#employer_org_name_en").val() + "<br/>" + $("#employer_org_name_fr").val() + "</p>"
                        ],
                        location
                    );
                }
            }
        });
    });
   
}

function populate() {

    $(document).on('click', 'tbody tr', function(e) {
        window.selected_row = $(this).attr('data_item_id');
        highlightSelectedRow();
        $.ajax({
            type:'post',
            dataType:'json',
            url:'index.php?page=card',
            data: 'id='+window.selected_row,
            success:function(data){
                //clear the select box
                $('#contacts-select').empty();
                //employer card data
                $('#employer-card-title').html('Viewing Employer');
                $('#contact-card-title').html('Employer Contacts');
                $('#card-title').html('Viewing Event Registration');
                (data['emp_info'][0] !== undefined ? cardPopulate(data['emp_info'][0],'employer') : '');
                //populate with the first contact retrieved
                (data['emp_contacts'][0] !== undefined ? cardPopulate(data['emp_contacts'][0],'contact') : '');
                if(data['events'][0] !== undefined){
                    cardPopulate(data['events'][0],'event');
                    $('#no-events').fadeOut();
                    $('#form').fadeIn();

                }
                else{ 
                    $('#form').fadeOut();
                    $('#no-events').fadeIn();
                }   
                $.each(data['emp_contacts'], function(){
                    $('#contacts-select').append('<option id="' + this.id + '">' +this.first_name + ' ' + this.last_name + '</option>');
                });
                
                $('.chosen').chosen();
                $('.chosen').trigger('liszt:updated');
                $('.buttonset').buttonset();
                $('#employerCard').animate({opacity: "1"}, 1000);
                $('#contactCard').animate({opacity: "1"}, 1000);
            }
        });
    });
}

$(document).on('click', '#add-btn', function() {
    clearForm();
    $('#card-title').text('Add a New Employer');

    window.selected_row = -1;
    $('form').attr('action', 'index.php?page=add');
    highlightSelectedRow();
});