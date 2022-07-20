addAction(INIT, function() {
    var $rows = $('.content-row');
    function applyClass() {
        var $container = $(this);
        var columnGroups = Estarossa.groupByRow($container.find('> .content-column').removeClass('content-column--last'));
        if(columnGroups.length){
            var $last = columnGroups.pop();
            $last.addClass('content-column--last');
        }
    }
    $rows.each(applyClass);
    addAction(LAYOUT, function(widthHasChanged) {
        if(widthHasChanged){
            $rows.each(applyClass);
        }
    });
});
