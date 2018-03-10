$('button[name=delete]').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes!",
        closeOnConfirm: false
    }, function(isConfirm){
        if (isConfirm) form.submit();
    });
});

$('input[name=domain]').keyup(function(){
    $(this).val($(this).val().toLowerCase());
});
