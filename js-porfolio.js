//filter
var $str = jQuery.noConflict();

$str(document).ready(function() {
    $str('.filter-wrapper li').click(function () {
        var itemsPortfolio = $str('.portfolio-item');
        $str(this).siblings().removeClass('selected');
        $str(this).addClass('selected');

        var filter = $str(this).attr('data-attr').toLowerCase();

        itemsPortfolio.hide();

        var count = 1;
        itemsPortfolio.each(function () {
            var itemsPortfolioAttr = $str(this).attr('data-attr').toLowerCase();
            if (itemsPortfolioAttr == filter && (filter != 'all')) {
                if ((count % 2) == 0) {
                    $str(this).removeClass('odd').addClass('even');
                } else {
                    $str(this).removeClass('even').addClass('odd');
                }
                $str(this).show();
                count++;
            } else if (filter == 'all') {
                if ((count % 2) == 0) {
                    $str(this).removeClass('odd').addClass('even');
                } else {
                    $str(this).removeClass('even').addClass('odd');
                }
                $str(this).show();
                count++;
            }
            ;
        });
        count = 1;
    });
});