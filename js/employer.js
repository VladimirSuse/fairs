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
            url:"index.php?page=add-edit",
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
                    var node = $('tr[data_item_id="' + $("#id").val() + '"]')[0];
                    var location = $('#mainTable').dataTable().fnGetPosition(node);             
                    $('#mainTable').dataTable().fnUpdate([
                        "<p>" + $("#org_name_en").val() + "<br/>" + $("#org_name_fr").val() + "</p>",
                        "<p>" + $("#dep_name_en").val() + "<br/>" + $("#dep_name_fr").val() + "</p>"
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
                $('#emp-card-title').html('Viewing Employer');
                $('#contact-card-title').html('Viewing Employer Contacts');
                cardPopulate(data['emp_info'][0],'employer');
                //populate with the first contact retrieved
                cardPopulate(data['emp_contacts'][0],'contact');
                $.each(data['emp_contacts'], function(){
                    $('#contacts-select').append('<option id="' + this.id + '">' +this.first_name + ' ' + this.last_name + '</option>');
                });
                
                $('.chosen').chosen();
                $('.chosen').trigger('liszt:updated');
                $('.buttonset').buttonset();
                $('#contactCard').animate({opacity: "1"}, 1000);
            }
        });
    });
}

//function for populating the employer contact card
function cardPopulate(data, cardType){
    if(cardType == "employer"){
        $('#id').val(data.id);
        $('input[type="radio"]').attr('checked','');
        $('#org_name_en').val(data.org_name_en);
        $('#org_name_fr').val(data.org_name_fr);
        $('#dep_name_en').val(data.dep_name_en);
        $('#dep_name_fr').val(data.dep_name_fr);
        $('#website_en').val(data.website_en);
        $('#website_fr').val(data.website_fr);
        (data.hst_exempt == 0 ? $('#hst_exempt-no').attr('checked','checked') : $('#hst_exempt-yes').attr('checked','checked'));
        (data.pst_exempt == 0 ? $('#pst_exempt-no').attr('checked','checked') : $('#pst_exempt-yes').attr('checked','checked'));
    }
    else if(cardType =="contact"){
        $('#first_name').val(data.first_name);
        $('#last_name').val(data.last_name);
        $('#street').val(data.street);
        $('#street2').val(data.street2);
        $('#postal_code').val(data.postal_code);
        $('#province').val(data.province);
        $('#city').val(data.city);
        $('#country').val(data.country);
        $('#phone').val(data.phone);
        $('#extension').val(data.extension);
        $('#e-mail').val(data['e-mail']);
    }
    else{
        //Display some sort of error
    }

}

$(document).on('click', '#add-btn', function() {
    clearForm();
    $('#card-title').text('Add a New Employer');

    window.selected_row = -1;
    $('form').attr('action', 'index.php?page=add');
    highlightSelectedRow();
});