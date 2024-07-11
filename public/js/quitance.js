

$(document).ready(function(){

    $('input#valeur_rechercher').quicksearch('table tbody tr');


    // ************************fonction de remplacement d'une class par un autre class
    
    (function ($) {
        $.fn.replaceClass = function (pFromClass, pToClass) {
            return this.removeClass(pFromClass).addClass(pToClass);
        };
     }(jQuery)); 

     //*****************fonction du notification */
       
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

    $(document).on('click', '#ajout_quitance', function(e) {
        e.preventDefault();
        var data = {
            'etab_id': $('#etab_id').val(),
            'num_quitance': $('#num_quitance').val(),
            'prix': $('#prix').val(),
            'type_quitance' : $('#type_quitance option:selected').text(),

        };
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_quitance",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 200 ){

                   var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                    $('#ajout_quitance').hide();
                    $('#carte_statistique').show();
                    $('#retour_liste').show();
                    // $('#span_success').replaceClass('label-success','label-danger');
                 }
                 else{
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }      
            }
         });
    });   

});