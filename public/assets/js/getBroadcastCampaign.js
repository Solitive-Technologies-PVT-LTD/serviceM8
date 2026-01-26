
$('#project_id').on('change', function() {
    var project_id = $("#project_id").val();
    $('#compaign_id').html('');
    fetchUserCampaign();
});

function fetchUserCampaign(){
    var project_id = $("#project_id").val();
    showLoader();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: getCampaign,
        type : "POST",
        data : {
            project_id: project_id,
        },
        success:function(data){
        hideLoader();
            if(data.length)
            {
                if($("#compaign_id").attr("multiple"))
                {
                }
                else{
                    $('#compaign_id').append('<option value="" selected="">Select Campaign</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    $('#compaign_id').append('<option value='+data[i].id+' >'+data[i].broadcast_name+'</option>');
                }
            }
            
        }    
    });
}