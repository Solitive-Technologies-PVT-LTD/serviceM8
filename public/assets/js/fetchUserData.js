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

function fetchUserSkills(){
    var program_id = $("#program_id").val();
    showLoader();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: getSkillsUrl,
        type : "POST",
        data : {
            program_id: program_id,
        },
        success:function(data){
            hideLoader();
            if(data.length)
            {
                if($("#skills").attr("multiple"))
                {
                }
                else{
                    $('#skills').append('<option value="" selected="">Select skill</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    $('#skills').append('<option value='+data[i].id+' >'+data[i].skill_name+'</option>');
                }
            }
            
        }    
    });
}

$('#pri').on('change', function() {
    var pri = $("#pri").val();
    $('#did_id').html('');
    if(pri != ''){
        fetchPriDid();
    }
});

function fetchPriDid()
{
    var pri_id = $("#pri").val();
    showLoader();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: fetchPriDID,
        type : "POST",
        data : {
            pri_id: pri_id,
        },
        success:function(data){
            hideLoader();
            if(data.length)
            {
                if($("#did_id").attr("multiple"))
                {
                }
                else{
                    $('#did_id').append('<option value="" selected="">Select Did</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    $('#did_id').append('<option value='+data[i].id+' >'+data[i].id+'</option>');
                }
            }
            
        }    
    });
}

