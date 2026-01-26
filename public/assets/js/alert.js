function showLoader(message = ''){
    if(message != ''){
        $(".loaderWrapper .text-below-loader").html(message);
    }
    else
    {
        $(".loaderWrapper .text-below-loader").html('');
    }

    $(".loaderWrapper").removeClass('d-none');
}

function hideLoader(){
    $(".loaderWrapper").addClass('d-none');
    $(".loaderWrapper .text-below-loader").html('');
}

function ringBell() {
    var lessthan20Sec = $('.lessThan20Sec').length;
    if (lessthan20Sec > 0) {
        $("#playsound").trigger("play");
        //$("#playsound").play();
    }
}