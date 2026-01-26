$('#client_id').on('change', function() {
    var client_id = $("#client_id").val();
    $('#project_id').html('');
    if(client_id != ''){
        fetchUserProjects();
    }
});

function fetchUserProjects(){
    var client_id = $("#client_id").val();
    showLoader();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: getProjectsUrl,
        type : "POST",
        data : {
            client_id: client_id,
        },
        success:function(data){
            hideLoader();
            if(data.length)
            {
                if($("#project_id").attr("multiple"))
                {
                }
                else{
                    $('#project_id').append('<option value="" selected="">Select project</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    $('#project_id').append('<option value='+data[i].id+' >'+data[i].project_name+'</option>');
                }
            }
            
        }    
    });
}

$('#project_id').on('change', function() {
    var project_id = $("#project_id").val();
    var module_name = $("#module_name").val();
    if(project_id !=''){
        if(module_name != "projects"){
            $('#program_id').html('');
            fetchUserPrograms();
            }
    }
    
});
function fetchUserPrograms(){
    var project_id = $("#project_id").val();
    var location_id=$("location_id").val();
    showLoader();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: getProgramsUrl,
        type : "POST",
        data : {
            project_id: project_id,
            location_id:location_id,
        },
        success:function(data){
        hideLoader();
            if(data.length)
            {
                if($("#program_id").attr("multiple"))
                {
                }
                else{
                    $('#program_id').append('<option value="" selected="">Select project</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    $('#program_id').append('<option value='+data[i].id+' >'+data[i].program_name+'</option>');
                }
            }
            
        }    
    });
}

$('#program_id').on('change', function() {
    var module_name = $("#module_name").val();
    if(module_name != "programs"){
        
        $('#skills').html('');
        
        fetchUserSkills();
    }
});

$('#skills').on('change', function() {
    $('#agents').html('');
     fetchUserSkills();
});

$('#location_id').on('change',function()
{
    var program_id = $("#program_id").val();
    if(program_id != null)
    {
        
        $('#agents').html('');
        fetchUserSkills();
    }   
    
})

function fetchUserSkills(){
    var program_id = $("#program_id").val();
    var location=$("#location_id").val();
    var skills=$("#skills").val();
    var project_id=$("#project_id").val();
    showLoader();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: get_agent_skills_url,
        type : "POST",
        data : {
            program_id: program_id,
            location:location,
            skills:skills,
            project_id:project_id,
        },
        success:function(data){
            hideLoader();
            if(data != null )
            {
                if(data.skill_data != null)
                {
                    $('#skills').html('');
                    if($("#skills").attr("multiple"))
                    {
                    }
                    else{
                        $('#skills').append('<option value="" selected="">Select skill</option>');
                    }
                    for(var i = 0; i < data.skill_data.length; i++) {
                        $('#skills').append('<option value='+data.skill_data[i].id+' >'+data.skill_data[i].skill_name+'</option>');
                    }
                }
                if(data.agent_data != null)
                {
                    if($("#agents").attr("multiple"))
                    {
                    }
                    else{
                        $('#agents').append('<option value="" selected="">Select Csr</option>');
                    }
                    for(var i = 0; i < data.agent_data.length; i++) {
                        
                        $('#agents').append('<option value='+data.agent_data[i].csr_extension+' >'+data.agent_data[i].csr_name+' ('+data.agent_data[i].csr_extension+') </option>');
                    }
                }
            }
            
        }    
    });
}