addAction(INIT, function() {
    var $sliders = $('.content-slider--height-match');

    function fixHeight() {
        var $container = $(this);
        var $slides = $container.find('.vc-content-slide');
        $slides.css('min-height', '');
        var height = $slides.map(function() {
            return $(this).outerHeight();
        }).get().reduce(function(a, b) {
            return Math.max(a, b);
        });
        $slides.css('min-height', height + 'px');
    }

    $sliders.each(fixHeight);
    addAction(LAYOUT, function() {
        $sliders.each(fixHeight);
    });
});
