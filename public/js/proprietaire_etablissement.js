

$(document).ready(function(){

// **********************fonction de recherche

    $('input#valeur_rechercher').quicksearch('table tbody tr');

       
    // ************************fonction de notification

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

    // ************************fonction de remplacement d'une class par un autre class
    
    (function ($) {
        $.fn.replaceClass = function (pFromClass, pToClass) {
            return this.removeClass(pFromClass).addClass(pToClass);
        };
     }(jQuery)); 
                               // ajout nouveau prprietaire et etablissement

    $(document).on('click', '#ajout_proprietaire', function(e) {
        e.preventDefault();
        var data = {
            'nom': $('#nom').val(),
            'cin': $('#cin').val(),
            'adresse': $('#adresse').val(),
            'commune_proprietaire': $('#commune_proprietaire').val(),
            'fokotany_proprietaire' : $('#fokotany_proprietaire option:selected').text(),
            'lien': $('#lien').val(),
            'num_tel': $('#num_tel').val(),
            'nationalite_proprietaire' : $('#nationalite_proprietaire option:selected').text(),
            'email': $('#email').val(),
            'identification_stat': $('#identification_stat').val(),
            'sigle': $('#sigle').val(),
            'num_patente': $('#num_patente').val(),
            'comptabilite' : $('#comptabilite option:selected').text(),
            'fond': $('#fond').val(),
            'duplicata' : $('#duplicata option:selected').text(),
            'bp': $('#bp').val(),
            'tel_etab': $('#tel_etab').val(),
            'adresse_etab': $('#adresse_etab').val(),
            'type' : $('#type option:selected').text(),
            'fokotany_etab' : $('#fokotany_etab option:selected').text(),
            'activite_etab' : $('#activite_etab option:selected').text(),
            'activite_sec1' : $('#activite_sec1 option:selected').text(),
            'activite_sec2' : $('#activite_sec2 option:selected').text(),
            'lchef_etab' : $('#lchef_etab option:selected').text(),
            'juridique_etab' : $('#juridique_etab option:selected').text(),
            'commune_etab' : $('#commune_etab option:selected').text(),
            'malagasy_m': $('#malagasy_m').val(),
            'malagasy_f': $('#malagasy_f').val(),
            'etranger_m': $('#etranger_m').val(),
            'etranger_f': $('#etranger_f').val(),

        };
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_proprietaire",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 400 ){
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
                 else{
                    var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                    $('#nom').val("");
                    $('#cin').val("");
                    $('#num_tel').val("");
                    $('#adresse').val("");
                    $('#email').val("");
                    $('#sigle').val("");
                    $('#num_patente').val("");
                    $('#fond').val("");
                    $('#bp').val("");
                    $('#malagasy_m').val("");
                    $('#malagasy_f').val("");
                    $('#etranger_m').val("");
                    $('#etranger_f').val("");
                 }      
            }
         });
    });   

                                  //affiche region et district selectionné

   $('#commune_etab').on('change', function() {
      $commune = this.value ;
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            type: "GET",
            url : "/get_region/"+$commune,
            success : function (response) {
                $('#district_etab').val(response.etab[0].district);
                $('#region_etab').val(response.etab[0].region);

            }
         })
    });

                          //   rectification proprietaire et etablissement

    $(document).on('click', '#rectifier_proprietaire', function(e) {
        e.preventDefault();
        var data = {
            'id_proprietaire': $('#id_proprietaire').val(),
            'id_etab': $('#id_etab').val(),
            'nom': $('#nom').val(),
            'cin': $('#cin').val(),
            'adresse': $('#adresse').val(),
            'fokotany_proprietaire' : $('#fokotany_proprietaire option:selected').text(),
            'lien': $('#lien').val(),
            'num_tel': $('#num_tel').val(),
            'nationalite_proprietaire' : $('#nationalite_proprietaire option:selected').text(),
            'email': $('#email').val(),
            'identification_stat': $('#identification_stat').val(),
            'sigle': $('#sigle').val(),
            'num_patente': $('#num_patente').val(),
            'comptabilite' : $('#comptabilite option:selected').text(),
            'fond': $('#fond').val(),
            'duplicata' : $('#duplicata option:selected').text(),
            'bp': $('#bp').val(),
            'tel_etab': $('#tel_etab').val(),
            'adresse_etab': $('#adresse_etab').val(),
            'type' : $('#type option:selected').text(),
            'fokotany_etab' : $('#fokotany_etab option:selected').text(),
            'activite_etab' : $('#activite_etab option:selected').text(),
            'activite_sec1' : $('#activite_sec1 option:selected').text(),
            'activite_sec2' : $('#activite_sec2 option:selected').text(),
            'lchef_etab' : $('#lchef_etab option:selected').text(),
            'juridique_etab' : $('#juridique_etab option:selected').text(),
            'commune_etab' : $('#commune_etab option:selected').text(),
            'malagasy_m': $('#malagasy_m').val(),
            'malagasy_f': $('#malagasy_f').val(),
            'etranger_m': $('#etranger_m').val(),
            'etranger_f': $('#etranger_f').val(),

        };
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/rectifier_etab",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 400 ){
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
                 else{
                    var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                    $('#nom').val("");
                    $('#num_tel').val("");
                    $('#sigle').val("");
                    $('#num_patente').val("");
                    $('#fond').val("");
                    $('#bp').val("");
                    $('#malagasy_m').val("");
                    $('#malagasy_f').val("");
                    $('#etranger_m').val("");
                    $('#etranger_f').val("");
                 }      
            }
         });
    });
  
                          //   Ajout d\'un etablissement avec un proprietaire existant

    
    $(document).on('click', '#ajout_proprietaire_exist', function(e) {
        e.preventDefault();
        var data = {
            'id_proprio': $('#id_proprio').val(),
            'nom': $('#nom').val(),
            'cin': $('#cin').val(),
            'lien': $('#lien').val(),
            'identification_stat': $('#identification_stat').val(),
            'sigle': $('#sigle').val(),
            'num_patente': $('#num_patente').val(),
            'comptabilite' : $('#comptabilite option:selected').text(),
            'fond': $('#fond').val(),
            'duplicata' : $('#duplicata option:selected').text(),
            'bp': $('#bp').val(),
            'tel_etab': $('#tel_etab').val(),
            'adresse_etab': $('#adresse_etab').val(),
            'type' : $('#type option:selected').text(),
            'fokotany_etab' : $('#fokotany_etab option:selected').text(),
            'activite_etab' : $('#activite_etab option:selected').text(),
            'activite_sec1' : $('#activite_sec1 option:selected').text(),
            'activite_sec2' : $('#activite_sec2 option:selected').text(),
            'lchef_etab' : $('#lchef_etab option:selected').text(),
            'juridique_etab' : $('#juridique_etab option:selected').text(),
            'commune_etab' : $('#commune_etab option:selected').text(),
            'malagasy_m': $('#malagasy_m').val(),
            'malagasy_f': $('#malagasy_f').val(),
            'etranger_m': $('#etranger_m').val(),
            'etranger_f': $('#etranger_f').val(),

        };
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_etab_proprietaire_exist",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 400 ){
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
                 else{
                    var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                  
                    $('#sigle').val("");
                    $('#num_patente').val("");
                    $('#fond').val("");
                    $('#bp').val("");
                    $('#malagasy_m').val("");
                    $('#malagasy_f').val("");
                    $('#etranger_m').val("");
                    $('#etranger_f').val("");
                 }      
            }
         });
    });  

              //  modification du proprietaire et etablissement et ajout de son quittance

    $(document).on('click', '#edit_proprietaire', function(e) {
        e.preventDefault();
        var data = {
            'id_proprietaire': $('#id_proprietaire').val(),
            'id_etab': $('#id_etab').val(),
            'nom': $('#nom').val(),
            'cin': $('#cin').val(),
            'adresse': $('#adresse').val(),
            'fokotany_proprietaire' : $('#fokotany_proprietaire option:selected').text(),
            'lien': $('#lien').val(),
            'num_tel': $('#num_tel').val(),
            'email': $('#email').val(),
            'identification_stat': $('#identification_stat').val(),
            'sigle': $('#sigle').val(),
            'num_patente': $('#num_patente').val(),
            'comptabilite' : $('#comptabilite option:selected').text(),
            'fond': $('#fond').val(),
            'duplicata' : $('#duplicata option:selected').text(),
            'bp': $('#bp').val(),
            'tel_etab': $('#tel_etab').val(),
            'adresse_etab': $('#adresse_etab').val(),
            'type' : $('#type option:selected').text(),
            'fokotany_etab' : $('#fokotany_etab option:selected').text(),
            'activite_etab' : $('#activite_etab option:selected').text(),
            'activite_sec1' : $('#activite_sec1 option:selected').text(),
            'activite_sec2' : $('#activite_sec2 option:selected').text(),
            'lchef_etab' : $('#lchef_etab option:selected').text(),
            'juridique_etab' : $('#juridique_etab option:selected').text(),
            'commune_etab' : $('#commune_etab option:selected').text(),
            'malagasy_m': $('#malagasy_m').val(),
            'malagasy_f': $('#malagasy_f').val(),
            'etranger_m': $('#etranger_m').val(),
            'etranger_f': $('#etranger_f').val(),
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
            url : "/modifier_proprio_etablissement",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 400 ){
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
                 else{
                    var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                    $('#nom').val("");
                    $('#num_tel').val("");
                    $('#sigle').val("");
                    $('#num_patente').val("");
                    $('#fond').val("");
                    $('#bp').val("");
                    $('#malagasy_m').val("");
                    $('#malagasy_f').val("");
                    $('#etranger_m').val("");
                    $('#etranger_f').val("");
                    $('#num_quitance').val("");
                    $('#prix').val("");
                 }      
            }
         });
    });

    //  mutation d'etablissement et ajout de son quittance

    $(document).on('click', '#mutation', function(e) {
        e.preventDefault();
        var data = {
            'id_proprietaire': $('#id_proprietaire').val(),
            'id_etab': $('#id_etab').val(),
            'ancien_nom': $('#ancien_nom').val(),
            'ancien_cin': $('#ancien_cin').val(),
            'ancien_adresse': $('#ancien_adresse').val(),
            'ancien_fokotany' : $('#ancien_fokotany').val(),
            'ancien_commune' : $('#ancien_commune').val(),
            'ancien_lien': $('#ancien_lien').val(),
            'ancien_num_tel': $('#ancien_num_tel').val(),
            'ancien_email': $('#ancien_email').val(),
            'nom': $('#nom').val(),
            'cin': $('#cin').val(),
            'adresse': $('#adresse').val(),
            'fokotany_proprietaire' : $('#fokotany_proprietaire option:selected').text(),
            'commune_proprio' : $('#commune_proprio option:selected').text(),
            'nationalite_proprietaire' : $('#nationalite_proprietaire option:selected').text(),
            'lien': $('#lien').val(),
            'num_tel': $('#num_tel').val(),
            'email': $('#email').val(),   
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
            url : "/ajout_mutation",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 400 ){
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
                 else{
                    var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                    $('#nom').val("");
                    $('#num_tel').val("");
                    $('#sigle').val("");
                    $('#num_patente').val("");
                    $('#fond').val("");
                    $('#bp').val("");
                    $('#malagasy_m').val("");
                    $('#malagasy_f').val("");
                    $('#etranger_m').val("");
                    $('#etranger_f').val("");
                    $('#num_quitance').val("");
                    $('#prix').val("");
                 }      
            }
         });
    });

                                     //afficher information du proprietaire selectionné

   $('#cin_proprietaire').on('change', function() {
      $cin = this.value ;
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            type: "GET",
            url : "/get_proprietaire/"+$cin,
            success : function (response) {
                $('#id_nouveau').val(response.proprietaire[0].id);
                $('#nom').val(response.proprietaire[0].nom);
                $('#adresse').val(response.proprietaire[0].adresse);
                $('#email').val(response.proprietaire[0].email);
                $('#lien').val(response.proprietaire[0].lien);
                $('#num_tel').val(response.proprietaire[0].num_tel);
                $('#fokotany').val(response.fokotany[0].fokotany);

            }
         })
    });

    //**********************ajout mutation propriietaire existant */

    $(document).on('click', '#mutation_proprietaire_existant', function(e) {
        e.preventDefault();
        var data = {
            'id_proprietaire': $('#id_proprietaire').val(),  
            'id_etab': $('#id_etab').val(), 
            'id_nouveau': $('#id_nouveau').val(), 
            'num_quitance': $('#num_quitance').val(),
            'prix': $('#prix').val(),
            'type_quitance' : $('#type_quitance option:selected').text(), 

            'ancien_nom': $('#ancien_nom').val(),  
            'ancien_cin': $('#ancien_cin').val(), 
            'ancien_commune': $('#ancien_commune').val(), 
            'ancien_adresse': $('#ancien_adresse').val(),
            'ancien_email': $('#ancien_email').val(),
            'ancien_num_tel' : $('#ancien_num_tel').val(), 

        };
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_mutation_proprio_existant",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 400 ){
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
                 else{
                    var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                    $('#ancien_nom').val("");
                    $('#ancien_adresse').val("");
                    $('#ancien_fokotany').val("");
                    $('#ancien_num_tel').val("");
                    $('#ancien_lien').val("");
                    $('#ancien_email').val("");
                    $('#anom').val("");
                    $('#adresse').val("");
                    $('#fokotany').val("");
                    $('#num_tel').val("");
                    $('#lien').val("");
                    $('#email').val("");
                 }      
            }
         });
    });


// *************************ajouter quittance du certificat d'existence

    $(document).on('click', '#ajout_quittance_certificat_existence', function(e) {
        e.preventDefault();
        var data = {
            'id_etab': $('#id_etab').val(),  
            'num_quitance': $('#num_quitance').val(),
            'prix': $('#prix').val(),
            'type_quitance' : $('#type_quitance option:selected').val(),

        };
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_quittance_certificat_existence",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 400 ){
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
                 else{
                    var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                    $('#nom').val("");
                    $('#identification_stat').val("");
                    $('#sigle').val("");
                    $('#cin').val("");
                    $('#num_quitance').val("");
                    $('#prix').val("");
                    $('#btn_certificat_existence').show();
                 }      
            }
         });
    });

    //*********************afficher modal annulation */

    $(document).on('click','a.annulation',function(e){
        e.preventDefault();
        $btn_id = $(this).attr('id');
        $etablissement_id = $(this).attr('name');
        $('#modal_annulation').modal('show');  
         $('#value_etablissement').val($btn_id);
         $('#id_etablissement').val($etablissement_id);
     });

// ***************************annulation de l'etablissement

     $(document).on('click','#annuler_etablissement',function(){
         $btn_id = $('#value_etablissement').val();
         $etablissement_id = $('#id_etablissement').val();
         
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            type: "GET",
            url : "/annulation_etablissement/"+$etablissement_id,
            success : function (response) {
                $('#modal_annulation').modal('hide');
                 $('a#'+$btn_id).hide();
                //   $("#span_success").attr("class", "label label-danger");
                  $("#span_success").text("Annulé");
                  $('#c_'+$etablissement_id).show();
                  $('#span_success').replaceClass('label-success','label-danger');
                 

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

     // *************************ajouter quittance pour reprise d'etablissement

    $(document).on('click', '#ajout_quittance_reprise_etablissement', function(e) {
        e.preventDefault();
        var data = {
            'id_etab': $('#id_etab').val(),  
            'num_quitance': $('#num_quitance').val(),
            'prix': $('#prix').val(),
            'type_quitance' : $('#type_quitance option:selected').val(),

        };
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $.ajax({
            type: "POST",
            url : "/ajout_quittance_reprise_etablissement",
              data: data,
              dataType: "json",
            success : function (response) {

                var nFrom = "top";
                var nAlign = "center";
                var nAnimIn = "animated fadeInLeft";
                var nAnimOut = "animated fadeOutLeft";

                 if(response.status == 400 ){
                    var nIcons = "fa fa-times";
                    var nType = "danger";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.error);
                 }
                 else{
                    var nIcons = "fa fa-check";
                    var nType = "info";
                    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, response.message);
                    $('#nom').val("");
                    $('#identification_stat').val("");
                    $('#sigle').val("");
                    $('#cin').val("");
                    $('#num_quitance').val("");
                    $('#prix').val("");
                 }      
            }
         });
    });


    // **********************************exportation de données en excel

    
    // $(document).on('click', '#export_excel', function() {
    //         $donnee = $('#donnee option:selected').val(),
        
    //      $.ajax({
    //         type: "GET",
    //         url : "/export_data/"+$donnee,
    //         success : function () {
    // console.log("dfdfd")
    //         }
    //      });
    // });
});
