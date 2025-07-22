// Adjust class 'money' to currency
$(".money").keypress(function(event) {
    if((event.which < 46 || event.which >= 59) && event.which != 8 && event.which != 0) {
        event.preventDefault();
    }

    if(event.which == 46 && $(this).val().indexOf('.') != -1) {
        event.preventDefault();
    }
});

// Blur submit button
function buttonBlur(formName, text){
    var name = '[name=' + formName + ']';

    $(name).on('submit', function() {
        var button = $(this).find('button[type="submit"]');
        button.attr({disabled: true}).html(text).blur();
    });
}

// Show/Hide content
function fadeInOut(fadeIn, fadeOut, form){
    $(fadeIn).on('click', function () { $(form).fadeIn(); });
    $(fadeOut).on('click', function () { $(form).fadeOut(); });
    if($(fadeIn).is(':checked')) { $(form).show(); }
}

// Show/Hide content if checkbox
function showByCheck(fadeIn, form)
{
    $(fadeIn).each(function(index, element) {
        if($(element).is(':checked')) {
            $(form).show();
            return false;
        }

        $(form).hide();
    });
}

// Show/Hide inputs
function merchantAdvertiseShow(field)
{
    var brands = $(field + ' option:selected');
    $(brands).each(function(index, brand){
        if('I' === $(this).val())
        {
            $('.maWebsite').fadeIn();
        }
        if('Other' === $(this).val())
        {
            $('.maOther').fadeIn();
        }
    });
}

// > Bootstrap Popover
$('[data-toggle="popover"]').popover({
    placement : 'right',
    html : true,
    trigger: 'manual',
    container: 'body'
}).click(function(e) {
    $(this).popover('toggle');
    e.stopPropagation();
});

$(document).on("click", ".popover .close" , function(){
    $(this).parents(".popover").popover('hide');
});

$('body').on('click', function (e) {
    if ($(e.target).data('toggle') !== 'popover'
        && $(e.target).parents('.popover.in').length === 0) {
        $('[data-toggle="popover"]').popover('hide');
    }
});
// < Bootstrap Popover
