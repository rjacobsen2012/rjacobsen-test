/**
 * Created by rjacobsen on 9/3/16.
 */

;(function($){
    $(document).ready(function() {
        Loader.auto();
    });
}(jQuery));

/** Loader **/
var Loader = {
    show: function(){
        showLoader();
    },
    hide: function(){
        $(window).ready(function(){
            hideLoader();
        });
    },
    close: function(){
        hideLoader();
    },
    auto: function(){
        showLoader();
        $(window).ready(function(){
            hideLoader();
        });
    }
};

function showLoader()
{
    var $element = $('#loader-wrapper');

    if ($element.length && !$element.is(':visible')) {
        $element.show();
    }

    $element.show();
}

function hideLoader()
{
    var $element = $('#loader-wrapper');

    if ($element.length && $element.is(':visible')) {
        $element.fadeOut('slow');
    }
}
