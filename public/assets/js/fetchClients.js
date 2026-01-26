$('#client_id').on('change', function() {
    var client_id = $("#client_id").val();
    //if(client_id !=''){
    $('#project_id').html('');
    fetchProjects(client_id);
    //}else{
        //$('#client_id').html('');
        //$("#client_id option[value='']").removeAttr("selected");
   // }
});
function fetchProjects(client_id){
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
           console.log(data);
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
    //$('#program_id').html('');
    //fetchPrograms();
});
function fetchPrograms(){
    var project_id = $("#project_id").val();
    showLoader();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        url: getProgramssUrl,
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
                    $('#program_id').append('<option value="" selected="">Select program</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    $('#program_id').append('<option value='+data[i].id+' >'+data[i].program_name+'</option>');
                }
            }
            
        }    
    });
}

$('#user_type').on('change', function(ev) {
    $('#project_id').html('');
    var user_type = $("#user_type").val();
    if(user_type !=''){
   //var check_admin_id = findAdminIdInArray( 1 , roles);
   if(user_type == 2){
    $('#client_id').select2({
        placeholder: 'select client',
        multiple:true,
    });
   }else{
    $('#client_id').select2({
        placeholder: 'select client',
        multiple:false
    });
   }
   //$("#client_id option[value='']").removeAttr("selected");
   ev.preventDefault();
}
});

function findAdminIdInArray(value,arr){
    var result = 0;
   
    for(var i=0; i<arr.length; i++){
      var name = arr[i];
      if(name == value){
        result = 1;
        break;
      }
    }
    return result;
  }