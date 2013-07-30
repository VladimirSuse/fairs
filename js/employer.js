function populate() {

    $(document).on('click', 'tbody tr', function(e) {
        window.selected_row = $(this).attr('data_item_id');
        highlightSelectedRow();
    });
}

function initializePage() {
    
    populate();

    $('#mainTable').dataTable({
        "iDisplayLength": 25,
        "aaSorting": [[4, "desc"]],
        "aLengthMenu":[
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
        ],
        "fnDrawCallback": function() {
            highlightSelectedRow();
        }
        
    });
    $('#mainTable').fadeIn();
    $('.buttonset').fadeIn();

    $('#mainTable_filter').addClass('field');
    $('#mainTable_filter input').addClass('normal search input');

    // The selected_row variable describes which the item_id of the currently selected row, or -1 if no row is selected.
    window.selected_row = -1;
   
    setTimeout(function() {
        $('#add-btn').click();
        $('.choose-me').chosen();
    }, 500);

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
}