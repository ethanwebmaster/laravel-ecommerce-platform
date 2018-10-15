$(document).ajaxComplete(function (event, xhr, settings) {
    if (IsJsonString(xhr.responseText)) {
        var response = JSON.parse(xhr.responseText);
        if (response.notification) {
            themeNotify(response.notification);
        }
    }


    initElements();
});

function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

$(document).ajaxStart(function (event) {
    var panelEl = $(".box-body");
    if (panelEl.closest('.box').hasClass('no-block-ui')) {
        return false;
    }

    if (panelEl.length === 0 && !$('body').hasClass('no-block-ui')) {
        panelEl = $('body');
    }
    if (panelEl.length) {
        blockUI(panelEl);
    }
});

$(document).ajaxStop(function () {
    var panelEl = $(".box-body");

    if (panelEl.length === 0) {
        panelEl = $('body');
    }

    unblockUI(panelEl);

    if (window.Ladda) {
        Ladda.stopAll();
    }
});

$(document).ready(function () {
    initElements();
});

$('body').on('click', '[data-action]', function (e) {
    e.preventDefault();

    var $element = $(this);

    var action = $element.data('action');
    var requestData = $element.data('request_data');
    var confirmation_message = $element.data('confirmation');

    if (undefined === requestData) {
        requestData = {};
    }

    var url = $element.prop('href');

    var page_action = $element.data('page_action');
    var action_data = $element.data('action_data');

    var table = $element.data('table');

    if (action === 'delete') {

        themeConfirmation(
            corals.confirmation.title,
            corals.confirmation.delete.text,
            'warning',
            corals.confirmation.delete.yes,
            corals.confirmation.cancel,
            function () {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        _method: 'delete'
                    },
                    success: function (response, textStatus, jqXHR) {
                        handleAjaxSubmitSuccess(response, textStatus, jqXHR, page_action, action_data, table);
                    },
                    error: function (data, textStatus, jqXHR) {
                        themeNotify(data);
                    }
                });
            });

        return;
    }

    if (action === 'logout') {
        $.ajax({
            url: url,
            type: 'POST',
            success: function (data, textStatus, jqXHR) {
            },
            error: function (data, textStatus, jqXHR) {
            },
            complete: function (data) {
                window.location = window.base_url;
            }
        });
    }

    if (action === 'load') {
        var load_to = $element.data('load_to');
        $(load_to).load(url);
    }

    if (action === 'post' || action === 'get') {
        if (undefined !== confirmation_message) {
            themeConfirmation(
                corals.confirmation.title,
                confirmation_message,
                'info',
                corals.confirmation.yes,
                corals.confirmation.cancel, function () {
                    ajaxRequest(url, requestData, table, page_action, action);
                });
        } else {
            ajaxRequest(url, requestData, table, page_action, action);
        }
    }
});

$('body').on('submit', '.ajax-form', function (event) {
    event.preventDefault();

    $('.has-error .help-block').html('');

    $('.form-group').removeClass('has-error');

    $('.nav.nav-tabs li a').removeClass('c-red');

    $form = $(this);

    ajax_form($form);
});

/*
* Select2 dependency handler
* The following attributes must be added to the main select:
*
* 'class'=>'dependent-select'
* 'data-dependency-field'=>'field_id',// the target element Id
* 'data-dependency-args'=>'arg1_id,arg2_id'//any additional fields that their values are required to get the data
* 'data-dependency-ajax-url'=>url('') //ajax url that handles the dependency
* */
$('.dependent-select').on('change', function () {
    var thisVal = this.value;
    var thisId = this.id;
    var dependencyArgs = [];

    if ($(this).data('dependency-args')) {
        dependencyArgs = $(this).data('dependency-args').split(',');
    }
    var dependencyFieldId = $(this).data('dependency-field');

    var ajaxParams = thisId + "=" + thisVal + "&";

    $.each(dependencyArgs, function (index, arg) {
        argValue = $('#' + arg).val();
        ajaxParams += arg + "=" + argValue + "&";
    });

    var targetUrl = $(this).data('dependency-ajax-url');
    var ajaxUrl = targetUrl + "?" + ajaxParams;

    $.ajax(ajaxUrl,   // request url
        {
            success: function (data, status, xhr) {// success callback function
                var targetElementData = [];

                targetElementData.push({'id': '', 'text': ''});

                $.each(data, function (index) {
                    targetElementData.push({'id': index, 'text': data[index]});
                });

                $("#" + dependencyFieldId).select2().empty().select2({
                    data: targetElementData
                });
            }
        });
});

$(document).on('change blur keyup keypress mouseup', '.limited-text', function (event) {
    var value = $(this).val();

    var limit = $(this).prop('maxlength');

    if (value.length == limit) {
        event.preventDefault();
    } else if (value.length > limit) {
        // Maximum exceeded
        value = value.substring(0, limit);
        $(this).val(value);
    }

    $(".limit-counter").text(value.length);
});