$("#province").on("change", function () {
    var province_code = $(this).val();
    var url = $('#province').attr('at');
    startLoading();
    $.ajax({
        type: 'POST',
        url: url,
        data: {province_code: province_code},

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            $("#county").html(data);
            $('#county').select2({});
            $("#ward").html("");
            $("#street").html("");
            $('#ward').select2({});
            $('#street').select2({});

            stopLoading()
           /* $('#form_order').bootstrapValidator(

            ).on('error.field.bv', function (e, data) {
                if (data.bv.getSubmitButton()) {
                    data.bv.disableSubmitButtons(false);
                }
            })
                .on('success.field.bv', function (e, data) {
                    if (data.bv.getSubmitButton()) {
                        data.bv.disableSubmitButtons(false);
                    }
                });*/
        }
    });

    getUnit(province_code);
    getPackages(province_code);

});


$("#county").on("change", function () {
    var county_id = $(this).val();
    var province_code = $("#province").val();
    var url = $('#county').attr('at');
    startLoading();
    console.log(county_id);
    $.ajax({
        type: 'POST',
        url: url,
        data: {province_code: province_code, county_id: county_id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            $("#ward").html(data);
            $('#ward').select2({});

            stopLoading()

        }
    });

});

$("#ward").on("change", function () {
    var ward_id = $(this).val();
    var url = $('#ward').attr('at');
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url,
        data: {ward_id: ward_id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            $("#street").html(data);
        }
    });
});
$("#unit").on("change", function () {
    var province_code = $("#province").val();
    var unit_id = $("#unit").val();
    console.log(province_code, unit_id);
    getPostOffice(province_code, unit_id);
})

function getUnit(province_code) {
    var unit_id = $("#unit").val();
    var url = $("#url_ajax_unit").val();
    $.ajax({
        type: 'POST',
        url: url,
        data: {province_code: province_code},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            $("#unit").html(data);
            $('#unit').select2({});
            $("#post_office").html("");
            $("#post_office").select2();
        }
    });

}

function getPostOffice(province_code, unit_id) {
    var url = $("#url_post_office").val();
    $.ajax({
        type: 'POST',
        url: url,
        data: {province_code: province_code, unit_id: unit_id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            $("#post_office").html(data);

        },
        error: function () {
            alertify.error("fa")
        }
    });
}

function rollBackStatus(id, status) {
    $("#handle-order" + id + ' option').eq(0).prop('selected', true);
}

function getPackages(province_code) {
    var url = $("#urlPack").attr('at');
    $.ajax({
        type: 'POST',
        url: url,
        data: {province_code: province_code},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            $("#info-package").html(data);
        },
        error: function () {
            alertify.error("fa")
        }
    });
}
