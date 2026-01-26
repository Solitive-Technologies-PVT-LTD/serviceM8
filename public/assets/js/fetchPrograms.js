$('#projects').on('change', function() {
    $('#program_id').html('');
    $("#skill_id").html('');
    $("#priority").html('');
    fetchPrograms();
});
$('#xyz').select2(
    {
        multiple:true,
    }
)
function fetchPrograms(){
    
    var project_id = $("#projects").val();
    if(typeof mirror_id !== 'undefined')
    {
       var mirror=1;
    }
    else{
        var mirror=0;
    }
    showLoader();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        url: programUrl,
        type : "POST",
        data : {
            project_id: project_id,
            mirror_id:mirror,
        },
        success:function(data){
         
            hideLoader();
                if($("#program_id").attr("multiple"))
                {
                }
                else{
                    $('#program_id').append('<option value="" selected="">Select Program</option>');
                }
            
                for(var i = 0; i < data.programs.length; i++) {
                    $('#program_id').append('<option value='+data.programs[i].id+' >'+data.programs[i].program_name+'</option>');
                    
                }
                if(mirror == 1 )
                {
                    $('#mirror_id').append('<option value="" selected="">Select Mirror</option>');
                    for(var i = 0; i < data.agents.length; i++) {
                        $('#mirror_id').append('<option value='+data.agents[i].id+' >'+data.agents[i].csr_extension+'</option>');
                    }
                }
            }
            
            
    });
}


$('#program_id').on('change', function() {
    $('#skill_id').html('');
    $("#priority").html('');
    fetchSkills();
});

function fetchSkills(){
    
    var program_id = $("#program_id").val();
    if(typeof mirror_id !== 'undefined')
    {
      var mirror= $("#mirror_id").val();
    }
    else{
        var mirror=null;
    }
    showLoader();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        url: skillsUrl,
        type : "POST",
        data : {
            program_id: program_id,
            mirror_id:mirror,
        },
        success:function(data){
            hideLoader();
           
                if($("#skill_id").attr("multiple"))
                {
                }
                else{
                    $('#skill_id').append('<option value="" selected="">Select Skill</option>');
                }
                $("#skill_id").val("").change();
                for(var i = 0; i < data.skills.length; i++) {
                    $('#skill_id').append('<option value='+data.skills[i].id+' >'+data.skills[i].skill_name+'</option>');
                }
                if(mirror)
                {
                    $('#skill_id').val(data.selected_skills).change();
                   
                        setPriorityValues(data.priorities);
                    
                }
        }    
    });
   
}

