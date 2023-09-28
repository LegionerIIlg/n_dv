





function    enterDestroyFunction() {

    if (confirm('Вы дествительно уходите?')) {
        $.ajax({
            url: '/index.php/?enter=destroy',
            type: 'GET',
            cache: false,
            dataType: "JSON",
            beforeSend: function () {
                load__show();
            },
            success: function ($data) {
                load__hide();

                if ($data.success) {
                    sucses__view($data.success);
                    window.location.reload();
                }

            }
            ,
            error: function ($data) {
                load__hide();
                error__view($data);
            }
        })
    }
    return false;


}

function     addNewFunction(form) {

    let $form = $(form);


    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        cache: false,
        dataType: "JSON",
        data: $form.serialize(),
        beforeSend: function () {
            load__show();
        },
        success: function ($data) {
            load__hide();
            if ($data.success) {
                sucses__view($data.success);
                $('#modalAdd').modal('hide');
                $form.find('.form-control').val('');
                functionGetTable();
            }
        }
        ,
        error: function ($data) {
            load__hide();
            error__view($data);
        }
    })

    return false;


}





function     functionChange(action) {


    var $id = $(action).parents('tr').data('id');
    $('#inputChangeRecord').val($id);


    $.ajax({
        url: '/index.php/?mainurl=change&record=' + $id,
        type: 'GET',
        cache: false,
        dataType: "JSON",
        beforeSend: function () {
            load__show();
        },
        success: function ($data) {
            load__hide();

            if ($data.danue) {
                $('#inputChangeName').val($data.danue.name);
                $('#inputChangePhone').val($data.danue.phone);
                $('#inputChangeKey').val($data.danue.keyt);

                $('#modalChange').modal('show');
                $('#inputChangeName').focus();
            }

        }
        ,
        error: function ($data) {
            load__hide();
            error__view($data);
        }
    })

}


function     saveChangeNowFunction(form) {

    let $form = $(form);
    
    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        cache: false,
        dataType: "JSON",
        data: $form.serialize(),
        beforeSend: function () {
            load__show();
        },
        success: function ($data) {
            load__hide();
            if ($data.success) {
                sucses__view($data.success);
                $('#modalChange').modal('hide');
                $form.find('.form-control').val('');
                functionGetTable(); 
            }
        }
        ,
        error: function ($data) {
            load__hide();
            error__view($data);
        }
    })

    return false;


}



function     functionDestroy(action) {

    var $tr = $(action).parents('tr');
    var $id = $(action).parents('tr').data('id');
    
    if (confirm('Действительно хотите удалить?')) {
        $.ajax({
            url: '/index.php/?mainurl=destroy&record=' + $id,
            type: 'GET',
            cache: false,
            dataType: "JSON",
            beforeSend: function () {
                load__show();
            },
            success: function ($data) {
                load__hide();
                if ($data.success) {
                    sucses__view($data.success);
                    $tr.remove();
                }
            },
            
            error: function ($data) {
                load__hide();
                error__view($data);
            }
        })
    }
}




function     functionGetTable() {

    var $tbody = $('#table-body');
    
   
        $.ajax({
            url: '/index.php/?mainurl=gettable',
            type: 'GET',
            cache: false,
            dataType: "JSON",
            beforeSend: function () {
                load__show();
            },
            success: function ($data) {
                load__hide();
                $tbody.empty();
                if ($data.html) {
                $tbody.html($data.html);
                }
            },
            
            error: function ($data) {
                load__hide();
                error__view($data);
            }
        })
    
}






function     functionLog(action) {


    var $id = $(action).parents('tr').data('id');
  


    $.ajax({
        url: '/index.php/?mainurl=logviewone&record=' + $id,
        type: 'GET',
        cache: false,
        dataType: "JSON",
        beforeSend: function () {
            load__show();
        },
        success: function ($data) {
            load__hide();
           $('#modalLogBody').empty();
            if ($data.html) {
                 $('#modalLogBody').html($data.html);
                $('#modalLogs').modal('show');
               
            }

        }
        ,
        error: function ($data) {
            load__hide();
            error__view($data);
        }
    })

}


