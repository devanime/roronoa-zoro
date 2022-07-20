(function($) {
    var Estarossa = window.Estarossa;
    var addAction = Estarossa.addAction;
    var INIT = Estarossa.INIT;
    var LAYOUT = Estarossa.LAYOUT;
    addAction(INIT, function() {
        var $rows = $(".content-row");

        function applyClass() {
            var $container = $(this);
            var columnGroups = Estarossa.groupByRow($container.find("> .content-column").removeClass("content-column--last"));
            if (columnGroups.length) {
                var $last = columnGroups.pop();
                $last.addClass("content-column--last")
            }
        }
        $rows.each(applyClass);
        addAction(LAYOUT, function(widthHasChanged) {
            if (widthHasChanged) {
                $rows.each(applyClass)
            }
        })
    });
    addAction(INIT, function() {
        var $sliders = $(".content-slider--height-match");

        function fixHeight() {
            var $container = $(this);
            var $slides = $container.find(".vc-content-slide");
            $slides.css("min-height", "");
            var height = $slides.map(function() {
                return $(this).outerHeight()
            }).get().reduce(function(a, b) {
                return Math.max(a, b)
            });
            $slides.css("min-height", height + "px")
        }
        $sliders.each(fixHeight);
        addAction(LAYOUT, function() {
            $sliders.each(fixHeight)
        })
    });
    addAction(INIT, function() {
        var $containers = $(".content-background-image__videos");
        Estarossa.scrollWatch($containers, function($el) {
            var failed = true;
            var src = $el.data("videoSrc");
            var $video = $el.find("video:visible");
            $el.find("video:hidden").remove();
            var url = $video.attr("class").indexOf("--mobile") !== -1 ? src.mobile : src.desktop;
            $video[0].addEventListener("play", function(e) {
                failed = false;
                $el.addClass("content-background-image__videos--playing");
                $video.removeClass("content-background-image__video--mobile content-background-image__video--desktop")
            });
            $video.find("source")[0].setAttribute("src", url);
            $video[0].load();
            setTimeout(function() {
                if (failed) {
                    Estarossa.doAction("refreshLazyLoad", $el.parent().removeClass("content-background-image--has-video"));
                    $el.remove()
                }
            }, 2e3)
        })
    })
})(jQuery);