
$('#project_id').on('change', function() {
    var project_id = $("#project_id").val();
    $("#pri_id").html('');
    fetchProjectPri();
    
});
function fetchProjectPri()
{
    var project_id = $("#project_id").val();
    showLoader();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: getProjectPri,
        type : "POST",
        data : {
            project_id: project_id,
        },
        success:function(data){
            hideLoader();
            if(data.length)
            {
                if($("#pri_id").attr("multiple"))
                {
                }
                else{
                    $('#pri_id').append('<option value="" selected="">Select PRI</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    $('#pri_id').append('<option value='+data[i].pri_id+' >'+data[i].pri_number+'</option>');
                }
            }
            
        }    
    });
}

