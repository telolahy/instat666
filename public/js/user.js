

$(document).ready(function(){

    $('input#valeur_rechercher').quicksearch('table tbody tr');

       
function notify(from, align, icon, type, animIn, animOut, message){
        $.growl({
            icon: icon,
            message: message,
            url: ''
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 30,
                y: 30
            },
            spacing: 10,
            z_index: 999999,
            delay: 4500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span> </span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
        });
    };

    $(document).on('click', '#ajout_user', function(e) {

        let form_data = new FormData($('#userForm')[0]);
        e.preventDefault();
        // var data = {
        //     'name': $('#name').val(),
        //     'email': $('#email').val(),
        //      'image' : $("#image").get(0).files,
        //     // 'image' :$('#image').val(),
        //     'region_user' : $('#region_user option:selected').val(),
        //     'role' : $('#role option:selected').text(),
        //     'password': $('#password').val(),
        //     'password2': $('#password2').val(),
        // };

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_user",
            data: form_data,
            processData: false,
            contentType: false,
            success : function (response) {

                $('#name').val("");
                $('#email').val("");
                $('#password').val("");
                $('#password2').val("");

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 200 ){
                    var nIcons = "fa fa-check";
                    var nType = "inverse";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                 }
                 else
                 {
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
            }
         });
    }); 
    
    $(document).on('click','a.affiche_modal_user',function(e){
        e.preventDefault();
        $user_id = $(this).attr('id');
        $('#modal_user').modal('show');  
         $('#value_userM').val($user_id);
     });

     $(document).on('click','#supprimer_user',function(){
         $user_id = $('#value_user').val();
         console.log($user_id);
         
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            type: "DELETE",
            url : "/supprimer_user/"+$user_id,
            success : function (response) {
                $('#modal_user').modal('hide');
                 $('tr#'+$user_id).remove();

                 var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";
                var nIcons = "fa fa-check";
                var nType = "inverse";
                notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                console.log(response);
            }
         })
     });


     $(document).on('click', '#modifier_user', function(e) {
        e.preventDefault();
        let form_data = new FormData($('#userForm')[0]);

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/modifier_user",
            data: form_data,
            processData: false,
            contentType: false,
            success : function (response) {

                $('#name').val("");
                $('#email').val("");
                $('#password').val("");
                $('#password2').val("");

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 200 ){
                    var nIcons = "fa fa-check";
                    var nType = "inverse";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                 }
                 else
                 {
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
            }
         });
    });
});