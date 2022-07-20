addAction(INIT, function () {
    var $containers = $('.content-background-image__videos');
    Estarossa.scrollWatch($containers, function ($el) {
        var failed = true;
        var src = $el.data('videoSrc');
        var $video = $el.find('video:visible');
        $el.find('video:hidden').remove();
        var url = $video.attr('class').indexOf('--mobile') !== -1 ? src.mobile : src.desktop;
        $video[0].addEventListener('play', function (e) {
            failed = false;
            $el.addClass('content-background-image__videos--playing');
            $video.removeClass('content-background-image__video--mobile content-background-image__video--desktop');
        });
        $video.find('source')[0].setAttribute('src', url);

        $video[0].load();
        setTimeout(function () {
            if (failed) {
                Estarossa.doAction('refreshLazyLoad', $el.parent().removeClass('content-background-image--has-video'));
                $el.remove();
            }
        }, 2000);
    });
});
