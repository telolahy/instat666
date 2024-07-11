$(document).ready(function() {
    // Initialize Select2 on the province, region, and district select elements
    $('#section_0').select2({
        placeholder: "Sélectionner une section"
    });
    $('#division_0').select2({
        placeholder: "Sélectionner une division"
    });
    $('#groupe_0').select2({
        placeholder: "Sélectionner un groupe"
    });
    $('#classe_0').select2({
        placeholder: "Sélectionner une classe"
    });
    $('#categorie_0').select2({
        placeholder: "Sélectionner une categorie"
    });

    $('#section_0').change(function() {
        var sectionId = $(this).val();
        // Clear and reset the region and district select elements
        $('#division_0').empty().append('<option value="">Sélectionner une division</option>').trigger('change');
        $('#groupe_0').empty().append('<option value="">Sélectionner un groupe</option>').trigger('change');
        if (sectionId) {
            $.ajax({
                url: '/division_0/' + sectionId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, division) {
                        $('#division_0').append('<option value="' + division.id + '">' + division.type_division + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#division_0').trigger('change');
                }
            });
        }
    });

    $('#division_0').change(function() {
        var divisionId = $(this).val();
        // Clear and reset the district select element
        $('#groupe_0').empty().append('<option value="">Sélectionner un groupe</option>').trigger('change');
        if (divisionId) {
            $.ajax({
                url: '/groupe_0/' + divisionId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, groupe) {
                        $('#groupe_0').append('<option value="' + groupe.id + '">' + groupe.type_groupe + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#groupe_0').trigger('change');
                }
            });
        }
    });
    $('#groupe_0').change(function() {
        var groupeId = $(this).val();
        // Clear and reset the district select element
        $('#classe_0').empty().append('<option value="">Sélectionner une classe</option>').trigger('change');
        if (groupeId) {
            $.ajax({
                url: '/classe_0/' + groupeId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, classe) {
                        $('#classe_0').append('<option value="' + classe.id + '">' + classe.type_classe + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#classe_0').trigger('change');
                }
            });
        }
    });
    $('#classe_0').change(function() {
        var classeId = $(this).val();
        // Clear and reset the district select element
        $('#categorie_0').empty().append('<option value="">Sélectionner une categorie</option>').trigger('change');
        if (classeId) {
            $.ajax({
                url: '/categorie_0/' + classeId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, categorie) {
                        $('#categorie_0').append('<option value="' + categorie.id + '">' + categorie.type_categorie + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#categorie_0').trigger('change');
                }
            });
        }
    });
});