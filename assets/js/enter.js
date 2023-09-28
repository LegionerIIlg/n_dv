
   function    enterInFunction(form){
       
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
                       window.location.reload();
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