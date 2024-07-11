

$(document).ready(function(){

    $('#test').select2();

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

    $(document).on('click', '#ajout_nationalite', function(e) {
        e.preventDefault();
        var data = {
            'code_nationalite': $('#code_nationalite').val(),
            'nationalite': $('#nationalite').val(),
        };

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_nationalite",
            data: data,
            dataType: "json",
            success : function (response) {

                $('#code_nationalite').val("");
                $('#nationalite').val("");

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

    $(document).on('click','a.affiche_modal_nationalite',function(e){
        e.preventDefault();
        $nationalite_id = $(this).attr('id');
        $('#modal_nationalite').modal('show');  
         $('#value_nationalite').val($nationalite_id);
     });

     $(document).on('click','#supprimer_nationalite',function(){
         $nationalite_id = $('#value_nationalite').val();
         
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            type: "DELETE",
            url : "/supprimer_nationalite/"+$nationalite_id,
            success : function (response) {
                $('#modal_nationalite').modal('hide');
                 $('tr#'+$nationalite_id).remove();

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


     $(document).on('click', '#modifier_nationalite', function(e) {
        e.preventDefault();
        var data = {
            'id': $('#id').val(),
            'code_nationalite': $('#code_nationalite').val(),
            'nationalite': $('#nationalite').val(),
        };

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/modifier_nationalite",
            data: data,
            dataType: "json",
            success : function (response) {

                $('#code_nationalite').val("");
                $('#nationalite').val("");

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