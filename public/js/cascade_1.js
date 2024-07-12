$(document).ready(function() {
    // Initialize Select2 on the province, region, and district select elements
    $('#section_1').select2({
        placeholder: "Sélectionner une section"
    });
    $('#division_1').select2({
        placeholder: "Sélectionner une division"
    });
    $('#groupe_1').select2({
        placeholder: "Sélectionner un groupe"
    });
    $('#classe_1').select2({
        placeholder: "Sélectionner une classe"
    });
    $('#categorie_1').select2({
        placeholder: "Sélectionner une categorie"
    });

    $('#section_1').change(function() {
        var sectionId = $(this).val();
        // Clear and reset the region and district select elements
        $('#division_1').empty().append('<option value="">Sélectionner une division</option>').trigger('change');
        $('#groupe_1').empty().append('<option value="">Sélectionner un groupe</option>').trigger('change');
        if (sectionId) {
            $.ajax({
                url: '/division_1/' + sectionId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, division) {
                        $('#division_1').append('<option value="' + division.id + '">' + division.type_division + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#division_1').trigger('change');
                }
            });
        }
    });

    $('#division_1').change(function() {
        var divisionId = $(this).val();
        // Clear and reset the district select element
        $('#groupe_1').empty().append('<option value="">Sélectionner un groupe</option>').trigger('change');
        if (divisionId) {
            $.ajax({
                url: '/groupe_1/' + divisionId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, groupe) {
                        $('#groupe_1').append('<option value="' + groupe.id + '">' + groupe.type_groupe + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#groupe_1').trigger('change');
                }
            });
        }
    });
    $('#groupe_1').change(function() {
        var groupeId = $(this).val();
        // Clear and reset the district select element
        $('#classe_1').empty().append('<option value="">Sélectionner une classe</option>').trigger('change');
        if (groupeId) {
            $.ajax({
                url: '/classe_1/' + groupeId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, classe) {
                        $('#classe_1').append('<option value="' + classe.id + '">' + classe.type_classe + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#classe_1').trigger('change');
                }
            });
        }
    });
    $('#classe_1').change(function() {
        var classeId = $(this).val();
        // Clear and reset the district select element
        $('#categorie_1').empty().append('<option value="">Sélectionner une categorie</option>').trigger('change');
        if (classeId) {
            $.ajax({
                url: '/categorie_1/' + classeId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, categorie) {
                        $('#categorie_1').append('<option value="' + categorie.id + '">' + categorie.type_categorie + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#categorie_1').trigger('change');
                }
            });
        }
    });
});
