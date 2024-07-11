$(document).ready(function() {
    // Initialize Select2 on the province, region, and district select elements
    $('#province').select2({
        placeholder: "Sélectionner une province"
    });
    $('#region').select2({
        placeholder: "Sélectionner une région"
    });
    $('#district').select2({
        placeholder: "Sélectionner un district"
    });
    $('#commune').select2({
        placeholder: "Sélectionner une commune"
    });
    $('#fokontany').select2({
        placeholder: "Sélectionner un fokontany"
    });

    $('#province').change(function() {
        var provinceId = $(this).val();
        // Clear and reset the region and district select elements
        $('#region').empty().append('<option value="">Sélectionner une région</option>').trigger('change');
        $('#district').empty().append('<option value="">Sélectionner un district</option>').trigger('change');
        if (provinceId) {
            $.ajax({
                url: '/regions/' + provinceId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, region) {
                        $('#region').append('<option value="' + region.id + '">' + region.region + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#region').trigger('change');
                }
            });
        }
    });

    $('#region').change(function() {
        var regionId = $(this).val();
        // Clear and reset the district select element
        $('#district').empty().append('<option value="">Sélectionner un district</option>').trigger('change');
        if (regionId) {
            $.ajax({
                url: '/districts/' + regionId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, district) {
                        $('#district').append('<option value="' + district.id + '">' + district.district + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#district').trigger('change');
                }
            });
        }
    });
    $('#district').change(function() {
        var districtId = $(this).val();
        // Clear and reset the district select element
        $('#commune').empty().append('<option value="">Sélectionner une commune</option>').trigger('change');
        if (districtId) {
            $.ajax({
                url: '/communes/' + districtId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, commune) {
                        $('#commune').append('<option value="' + commune.id + '">' + commune.commune + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#commune').trigger('change');
                }
            });
        }
    });
    $('#commune').change(function() {
        var communeId = $(this).val();
        // Clear and reset the district select element
        $('#fokontany').empty().append('<option value="">Sélectionner un fokontany</option>').trigger('change');
        if (communeId) {
            $.ajax({
                url: '/fokontanis/' + communeId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, fokontany) {
                        $('#fokontany').append('<option value="' + fokontany.id + '">' + fokontany.fokotany + '</option>');
                    });
                    // Reinitialize Select2 after updating the options
                    $('#fokontany').trigger('change');
                }
            });
        }
    });
});