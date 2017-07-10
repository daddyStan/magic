/**
 * Created by Koshpaev SV on 10.07.2017.
 */
window.onload = function () {
    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    var cook = getCookie('scroll');
    window.onscroll = function() {
        var scrolled = window.pageYOffset || document.documentElement.scrollTop;
        document.cookie = "scroll=" + scrolled;
        cook = getCookie('scroll');
    }

    if(cook!==undefined) {
        document.body.scrollTop = cook;
    }
}