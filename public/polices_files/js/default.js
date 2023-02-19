$('.nav_bar_image').on('click', function () {
    location.href = "/";
});


function loading_spinner(typeOfLoading) {

    if (typeOfLoading === "show") {
        $(".loading-container").removeClass("d-none d-flix");
    }

    if (typeOfLoading === "hide") {
        $(".loading-container").addClass("d-none d-flix");
    }
}

$(document).ready(function () {
    $('.search_select').select2();

    $('.search_multiple').on('select2:opening select2:closing', function (event) {

    });

});


function ajaxRequest(path, formData, callback = null, type = 'POST') {

    $.ajax({
        url: path,
        type: type,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function (withoutLoading) {
            loading_spinner("show");
        },
        success: function (response) {
            loading_spinner("hide");
            if (callback != null) callback(response);
        },
        error: function (response) {
            console.log(response)
            loading_spinner("hide");
            alert('error');
        }
    });
}

function ifNullReturnDefault(data_original, data_default) {
    if (data_original === null || data_original === '') {
        return data_default;
    }
    return data_original;
}

function get_form_attrs_as_array(form_id) {
    var values = {};
    $.each(form_id.serializeArray(), function (i, field) {
        values[field.name] = field.value;
    });

    return values;
}

function get_web_path_url(key) {
    return `/webPages.php?path=${key}`;
}

