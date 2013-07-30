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
    $('input[type="text"]').blur(function(){
        $('#add-employer').fadeIn();
    });

    //listener add employer form submission
    $('#emp_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            type: $('#emp_form').attr('method'),
            url:"index.php?page=add-edit",
            data: $('#emp_form').serialize(),
            success:function(){
                //TODO
            }
        });
    });
   
    setTimeout(function() {
        $('#add-btn').click();
        $('.choose-me').chosen();
    }, 500);
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
                $('#card-title').html('Viewing Employer');
                $('#add-employer').hide();
                $('#id').val(data[0].id);
                $('input[type="radio"]').attr('checked','');
                $('#org_name_en').val(data[0].org_name_en);
                $('#org_name_fr').val(data[0].org_name_fr);
                $('#dep_name_en').val(data[0].dep_name_en);
                $('#dep_name_fr').val(data[0].dep_name_fr);
                $('#website_en').val(data[0].website_en);
                $('#website_fr').val(data[0].website_fr);
                (data[0].hst_exempt == 0 ? $('#hst_exempt-no').attr('checked','checked') : $('#hst_exempt-yes').attr('checked','checked'));
                (data[0].pst_exempt == 0 ? $('#pst_exempt-no').attr('checked','checked') : $('#pst_exempt-yes').attr('checked','checked'));
                $('.buttonset').buttonset();
            }
        });
    });
}
