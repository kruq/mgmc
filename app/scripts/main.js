var setCorrectMenu = function () {
    var scroll = $(window).scrollTop();
    if (scroll > 10) {
        $('section.menu').addClass('small');
    } else {
        $('section.menu').removeClass('small');
    }
};

var clearMenuSelection = function () {
    $('a[href*="#"]')
        .not('[href="#"]')
        .not('[href="#0"]').removeClass('selected');
}

var selectMenu = function (element) {
    clearMenuSelection();
    $(element).addClass('selected');
};

var findAndSelectMenu = function () {
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    var documentHeight = $(document).height();

    if (scroll == 0 || (scroll + windowHeight == documentHeight)) {
        clearMenuSelection();
    } else {
        var element = $('h3[id]').filter(function (index, el) {
            var top = $(el).offset().top - scroll;
            return top > 0 && top < 160;
        })[0];

        if (element != undefined) {
            var elementId = element.id;
            var link = $('a[href="#' + elementId + '"]');
            selectMenu(link);
        }
    }
}

var onScroll = function () {
    setCorrectMenu();
    findAndSelectMenu();
}

$('a[href*="#"]')
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function (event) {
        if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            &&
            location.hostname == this.hostname
        ) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 120
                }, 1000, function () {

                });
            }
        }
    });

$(window).on('scroll', onScroll);
$(document).ready(onScroll);
setTimeout("$('span.alert').hide('slow');", 3000);