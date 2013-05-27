/**
 * Created with JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 08/05/13
 * Time: 00:28
 * To change this template use File | Settings | File Templates.
 */
$(window).load(function(){
    $('#uploadForm input[type=file]').on('change invalid', function() {
        var filefield = $(this).get(0);
        var uneditableinput = $('div.uneditable-input');
        var button = $('#btnConvert');
        var _popover;
        _popover = $(uneditableinput).popover({
            trigger: "manual",
            placement: "top",
            content: '<i class="icon-warning-sign icon-large"></i>&nbsp;Veuillez choisir un fichier',
            delay: {show: 500, hide: 100},
            html: 'true',
            template: '<div class="popover"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content text-error"><p></p></div></div></div>'
        });
        if (!filefield.validity.valid) {
            uneditableinput.addClass("customerror");
            _popover.popover('show');
            button.prop('disabled', true);
        } else {
            uneditableinput.removeClass("customerror");
            _popover.popover('hide');
            button.prop('disabled', false);
        }
    });

    var formulaire = $("#uploadForm");

    formulaire.on('submit', function(event) {
        var result = true;
        var spanfileselected = $('span.fileupload-preview');
        var button = $('#btnConvert');
        if (spanfileselected.text().length == 0) {
            result = false;
        } else {
            button.html('<i class="icon-spinner icon-spin"></i>&nbsp;En cours de traitement');
            button.removeClass("btn-primary");
            button.prop('disabled', true);
        }
        return result;
    });
});