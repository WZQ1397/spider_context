function sleep(numberMillis) {
    var now = new Date();
    var exitTime = now.getTime() + numberMillis;
    while (true) {
        now = new Date();
        if (now.getTime() > exitTime)
            return;
    }
}

/*
var _t;
window.onbeforeunload = function()
{
    setTimeout(function(){_t = setTimeout(onunloadcancel, 0)}, 0);
    return "真的离开?";
}
window.onunloadcancel = function()
{
    clearTimeout(_t);
}
*/

function display(speed) {

    $('.progressbar').each(function () {
        var t = $(this),
            dataperc = t.attr('data-perc'),
            barperc = Math.round(dataperc * 5.56);
        t.find('.bar').animate({
            width: barperc
        }, dataperc * speed);
        t.find('.label').append('<div class="perc"></div>');

        function perc() {
            var flag = 1;
            var length = t.find('.bar').css('width'),
                perc = Math.round(parseInt(length) / 5.56),
                labelpos = (parseInt(length) - 2);
            t.find('.label').css('left', labelpos);
            t.find('.perc').text(perc + '%');
            if(perc>=100 && flag){flag=0;
        alert("采集完成");clearInterval(id);}
        }
        perc();
        var id = setInterval(perc, 10);
    });
    document.getElementById("point").innerHTML = "开始采集";
    var text = document.getElementById('point2');
    var str = '.............';
    var arr = [];
    for (var i = 0; i < str.length; i++) {
        arr.push(str[i])
    }
    var text1 = '';
    var num = 0;
    var timer = setInterval(function () {
        if (num < arr.length) {
            text1 += arr[num];
            text.innerHTML = text1
            num++;
        } else {
            clearInterval(timer)
        }
    }, 500)
}

function block() {
    document.getElementById('btn1').onclick = function () {
        this.disabled = true;
        setTimeout(function () {
            document.getElementById('btn1').disabled = false;
        }, 30000);
    }
} 