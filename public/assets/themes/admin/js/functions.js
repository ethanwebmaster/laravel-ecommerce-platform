/**
 * init elements on page loading and ajax complete
 */
function initThemeElements() {


    $('[data-toggle="tooltip"]').tooltip();

    $('td .item-actions').addClass('pull-left');

    $('.select2-normal').select2();
    $('.select2-normal.tags').select2({
        tags: []
    });

    init_iCheck();

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "preventDuplicates": false,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
}

function init_iCheck() {

    // iCheck init
    $('input[type=checkbox],input[type=radio]').not('.disable-icheck').each(function () {
        if ($(this).css('opacity') != "0") {
            $(this).iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue',
                // increaseArea: '20%' // optional
            });
            $(this).on('ifClicked', function (event) {
                $(event.target).click()
            });
            $(this).on('ifChanged', function (event) {
                $(event.target).trigger('change');
            });
        }

    });


}

function set_menu_classes() {
    var items = $(".sidebar-menu").find('.active');

    items.each(function (i) {
        var item = $(this);
        item.closest('li').addClass('active');
        item.closest('.treeview').addClass('menu-open');
        item.closest('.treeview-menu').css('display', 'block');
    });
}

function themeConfirmation(title, text, type, confirm_btn, cancel_btn, callback, dismiss_callback) {
    swal({
        title: title,
        text: text,
        type: type,
        showCancelButton: true,
        animation: true,
        // customClass: 'animated tada',
        confirmButtonColor: "#ff7014",
        confirmButtonText: confirm_btn,
        cancelButtonText: cancel_btn
    }).then(
        function () {
            if (typeof callback === "function") {
                // Call it, since we have confirmed it is callable​
                callback();
            }
        }, function (dismiss) {
            if (typeof dismiss_callback === "function") {
                // Call it, since we have confirmed it is callable​
                dismiss_callback()
            }
        });
}

function themeNotify(data) {

    if (undefined == data.level && undefined == data.message) {

        if (undefined != data.responseJSON) {
            data = data.responseJSON;
        }

        var level = 'error';
        var message = data.message;
        var errors = data.errors;

        if (undefined == errors && undefined == message) {
            return;
        }
    } else {
        var level = data.level;
        var message = data.message;
    }

    if (undefined != errors) {
        message += "<br>";
        $.each(errors, function (key, val) {
            message += val + "<br>";
        });
    }
    if (undefined == level && undefined == message) {
        level = 'error';
        message = 'Something went wrong!!';
    }

    toastr[level](message);
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}