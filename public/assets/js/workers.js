var i = 0;

function timedCount() {
    //i = i + 1;
    postMessage(true);
    setTimeout("timedCount()",4000);
}

timedCount();