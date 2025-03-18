(function($) {
    "use strict"

    var form = $("#add-product-form");
    form.children('div').steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        finish: 'Опубликовать',
        next: 'Далее',
        previous: 'Предыдущее',
        autoFocus: true,
        enableFinishButton: true,
        cancel: 'Отмена',
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            $("#add-product-form").submit();
        }
    });

})(jQuery);
