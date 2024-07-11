$(document).ready(function() {
    // Initialize Select2 on the province, region, and district select elements
    $('#district_etab').select2({
        placeholder: "Sélectionner un district"
    });
    $('#commune_etab').select2({
        placeholder: "Sélectionner une commune"
    });
    $('#fokontany_etab').select2({
        placeholder: "Sélectionner un fokontany"
    });


    $('#district_etab').change(function() {
        var districtId = $(this).val();
        // Clear and reset the district select element
        $('#commune_etab').empty().append('<option value="">Sélectionner une commune</option>').trigger('change');
        if (districtId) {
            $.ajax({
                url: '/communes_etab/' + districtId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, commune) {
                        $('#commune_etab').append('<option value="' + commune.id + '">' + commune.commune + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#commune_etab').trigger('change');
                }
            });
        }
    });
    $('#commune_etab').change(function() {
        var communeId = $(this).val();
        // Clear and reset the district select element
        $('#fokontany_etab').empty().append('<option value="">Sélectionner un fokontany</option>').trigger('change');
        if (communeId) {
            $.ajax({
                url: '/fokontanis_etab/' + communeId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, fokontany) {
                        $('#fokontany_etab').append('<option value="' + fokontany.id + '">' + fokontany.fokotany + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#fokontany_etab').trigger('change');
                }
            });
        }
    });
});