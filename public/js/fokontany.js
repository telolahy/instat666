

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

    $(document).on('click', '#ajout_fokontany', function(e) {
        e.preventDefault();
        var data = {
            'code_commune': $('#code_commune').val(),
            'commune': $('#commune').val(),
            'code_district': $('#code_district').val(),
            'district': $('#district').val(),
            'code_region': $('#code_region').val(),
            'region': $('#region').val(),
            'code_fokotany': $('#code_fokotany').val(),
            'fokotany': $('#fokotany').val(),
        };

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_fokontany",
            data: data,
            dataType: "json",
            success : function (response) {

                $('#code_commune').val("");
                $('#commune').val("");
                $('#code_district').val("");
                $('#district').val("");
                $('#code_region').val("");
                $('#region').val("");
                $('#code_fokotany').val("");
                $('#fokotany').val("");

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

    $(document).on('click','a.affiche_modal_fokontany',function(e){
        e.preventDefault();
        $fokontany_id = $(this).attr('id');
        $('#modal_fokontany').modal('show');  
         $('#value_fokontany').val($fokontany_id);
     });

     $(document).on('click','#supprimer_fokontany',function(){
         $fokontany_id = $('#value_fokontany').val();
         
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            type: "DELETE",
            url : "/supprimer_fokontany/"+$fokontany_id,
            success : function (response) {
                $('#modal_fokontany').modal('hide');
                 $('tr#'+$fokontany_id).remove();

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


     $(document).on('click', '#modifier_fokontany', function(e) {
        e.preventDefault();
        var data = {
            'id': $('#id').val(),
            'code_commune': $('#code_commune').val(),
            'commune': $('#commune').val(),
            'code_district': $('#code_district').val(),
            'district': $('#district').val(),
            'code_region': $('#code_region').val(),
            'region': $('#region').val(), 
            'code_fokotany': $('#code_fokotany').val(),
            'fokotany': $('#fokotany').val(),
        };

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/modifier_fokontany",
            data: data,
            dataType: "json",
            success : function (response) {

                $('#code_commune').val("");
                $('#commune').val("");
                $('#code_district').val("");
                $('#district').val("");
                $('#code_region').val("");
                $('#region').val("");       
                $('#code_fokotany').val("");
                $('#fokotany').val("");

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