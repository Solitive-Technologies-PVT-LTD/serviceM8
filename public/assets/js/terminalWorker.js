function timeToSec(strTime) {
    var a = strTime.split(':'); // split it at the colons
    var seconds = parseInt(a[0], 10) * 3600 + parseInt(a[1], 10) * 60 + parseInt(a[2], 10);
    return seconds;
}

function secToTime(second) {
    var sec_num = parseInt(second, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+':'+minutes+':'+seconds;
}

var lastUpdateElapsedTime = Math.floor(Date.now() / 1000);

function elapsed_timer (){
    $(".cls_elapsed_time").each(
        function(index) {
            let currentTime = Math.floor(Date.now() / 1000);
            let seconds = timeToSec($(this).html());
            seconds = seconds + currentTime - lastUpdateElapsedTime;
            if(seconds < 30){
                $(this).html(secToTime(seconds));
                ringBell();
            }
            else{
                $(this).html(secToTime(seconds));
            }
        }
    );
    lastUpdateElapsedTime = Math.floor(Date.now() / 1000);
}

if (typeof(Worker) !== "undefined") {
    if (typeof(workerInit) == "undefined") {
        workerInit = new Worker(workerFile);
    }
    workerInit.onmessage = function(event) {
        elapsed_timer();
        ajaxTimer = ajaxTimer+4;
        if(ajaxTimer >= 32)
        {
            table.DataTable().ajax.reload();
            ajaxTimer = 0;
        }
    };
}