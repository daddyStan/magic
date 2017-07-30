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

    setTimeout(function () {
        $("#popup").toggle(500);
        if(cook!==undefined) {
            document.body.scrollTop = cook;
        }
    },3000);

}

function del (value) {
    $.ajax({
        type: "POST",
        url: '/admin/otzivdelete',
        data: {delete:value.name},
        success: function(data){
            if(data){
                value.value = "Удалено";
                setTimeout(function(){location.reload()},1000);
            }
        }
    });
}

function up(el) {
    var id = el.id.replace(/[\D]+/,"");
    $.ajax({
        type: "POST",
        url: '/admin/otzivorderup',
        data: {id:id},
        success: function(data){
            setTimeout(function(){location.reload()},1000);
            console.log(data);
        }
    });
}

function down(el) {
    var id = el.id.replace(/[\D]+/,"");
    $.ajax({
        type: "POST",
        url: '/admin/otzivorderdown',
        data: {id:id},
        success: function(data){
            setTimeout(function(){location.reload()},1000);
            console.log(data);
        }
    });
}

function upU(el) {
    var id = el.id.replace(/[\D]+/,"");
    $.ajax({
        type: "POST",
        url: '/admin/uslugiorderu',
        data: {id:id},
        success: function(data){
            setTimeout(function(){location.reload()},1000);
            console.log(data);
        }
    });
}

function downU(el) {
    var id = el.id.replace(/[\D]+/,"");
    $.ajax({
        type: "POST",
        url: '/admin/uslugiorderd',
        data: {id:id},
        success: function(data){
            setTimeout(function(){location.reload()},1000);
            console.log(data);
        }
    });
}

function upO(el) {
    var id = el.id.replace(/[\D]+/,"");
    $.ajax({
        type: "POST",
        url: '/admin/otzivorderu',
        data: {id:id},
        success: function(data){
            setTimeout(function(){location.reload()},1000);
            console.log(data);
        }
    });
}

function downO(el) {
    var id = el.id.replace(/[\D]+/,"");
    $.ajax({
        type: "POST",
        url: '/admin/otzivorderd',
        data: {id:id},
        success: function(data){
            setTimeout(function(){location.reload()},1000);
            console.log(data);
        }
    });
}

function ups(el) {
    var id = el.id.replace(/[\D]+/,"");
    $.ajax({
        type: "POST",
        url: '/admin/sliderup',
        data: {id:id},
        success: function(data){
            setTimeout(function(){location.reload()},1000);
            console.log(data);
        }
    });
}

function downs(el) {
    var id = el.id.replace(/[\D]+/,"");
    $.ajax({
        type: "POST",
        url: '/admin/sliderdown',
        data: {id:id},
        success: function(data){
            setTimeout(function(){location.reload()},1000);
            console.log(data);
        }
    });
}

function site(el) {
    $("#popup").toggle(500);
    $.ajax({
        type: "POST",
        url: '/admin/config/siteon',
        data: {status:el.checked},
        success: function(data){
            console.log(data);
            if(data=='false') {
                el.checked = false;
            }
        }
    });
    $("#popup").toggle(500);
}