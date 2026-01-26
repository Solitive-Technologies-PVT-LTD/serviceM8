$('#skills').on('change', function() {
        $('#agents').html('');
        fetchSkillAgents();
});
function fetchSkillAgents()
{
    var skills = $("#skills").val();
    showLoader();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: getSkillAgents,
        type : "POST",
        data : {
            skills: skills,
        },
        success:function(data){
            hideLoader();
            if(data.length)
            {
                if($("#agents").attr("multiple"))
                {
                }
                else{
                    $('#agents').append('<option value="" selected="">Select Csr</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    var agents=$('#agents').val();
                    console.log(agents);
                    $('#agents').append('<option value='+data[i].csr_extension+' >'+data[i].csr_name+' ('+data[i].csr_extension+') </option>');
                }
            }
            
        }    
    });
}