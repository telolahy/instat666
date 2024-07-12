$(document).ready(function() {
    // Initialize Select2 on the province, region, and district select elements
    $('#section_2').select2({
        placeholder: "Sélectionner une section"
    });
    $('#division_2').select2({
        placeholder: "Sélectionner une division"
    });
    $('#groupe_2').select2({
        placeholder: "Sélectionner un groupe"
    });
    $('#classe_2').select2({
        placeholder: "Sélectionner une classe"
    });
    $('#categorie_2').select2({
        placeholder: "Sélectionner une categorie"
    });

    $('#section_2').change(function() {
        var sectionId = $(this).val();
        // Clear and reset the region and district select elements
        $('#division_2').empty().append('<option value="">Sélectionner une division</option>').trigger('change');
        $('#groupe_2').empty().append('<option value="">Sélectionner un groupe</option>').trigger('change');
        if (sectionId) {
            $.ajax({
                url: '/division_2/' + sectionId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, division) {
                        $('#division_2').append('<option value="' + division.id + '">' + division.code_division + ' ' + division.type_division +'</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#division_2').trigger('change');
                }
            });
        }
    });

    $('#division_2').change(function() {
        var divisionId = $(this).val();
        // Clear and reset the district select element
        $('#groupe_2').empty().append('<option value="">Sélectionner un groupe</option>').trigger('change');
        if (divisionId) {
            $.ajax({
                url: '/groupe_2/' + divisionId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, groupe) {
                        $('#groupe_2').append('<option value="' + groupe.id + '">' + groupe.type_groupe + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#groupe_2').trigger('change');
                }
            });
        }
    });
    $('#groupe_2').change(function() {
        var groupeId = $(this).val();
        // Clear and reset the district select element
        $('#classe_2').empty().append('<option value="">Sélectionner une classe</option>').trigger('change');
        if (groupeId) {
            $.ajax({
                url: '/classe_2/' + groupeId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, classe) {
                        $('#classe_2').append('<option value="' + classe.id + '">' + classe.type_classe + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#classe_2').trigger('change');
                }
            });
        }
    });
    $('#classe_2').change(function() {
        var classeId = $(this).val();
        // Clear and reset the district select element
        $('#categorie_2').empty().append('<option value="">Sélectionner une categorie</option>').trigger('change');
        if (classeId) {
            $.ajax({
                url: '/categorie_2/' + classeId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, categorie) {
                        $('#categorie_2').append('<option value="' + categorie.id + '">' + categorie.type_categorie + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#categorie_2').trigger('change');
                }
            });
        }
    });
});
