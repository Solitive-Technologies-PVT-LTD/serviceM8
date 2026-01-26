var service_id=$("#service").val();
var level=1;
var nature_id=0;
//Change Nature level 1 as service change
//getNatures_ajax(service_id,level,nature_id,"ticket_nature_l1");
$('#service').on('change', function() {
    service_id=$("#service").val();
    $('#ticket_nature_l1').html('');
    getNatures_ajax(service_id,level,nature_id,"ticket_nature_l1");
});
//Change Nature level 2 as level 1 change
$('#ticket_nature_l1').on('change', function() {
    $('#ticket_nature_l2').html('');
    service_id=$("#service").val();
    level=2;
    nature_id=$(this).val();
    getNatures_ajax(service_id,level,nature_id,"ticket_nature_l2");
});
//Change Nature level 3 as level 2 change
$('#ticket_nature_l2').on('change', function() {
    $('#ticket_nature_l3').html('');
    service_id=$("#service").val();
    level=3;
    nature_id=$(this).val();
    getNatures_ajax(service_id,level,nature_id,"ticket_nature_l3");
});
function getNatures_ajax(service_id,level,nature_id,nature_dropdown_id){
    showLoader();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        url: natures_level,
        type : "POST",
        data : {
            ticket_nature: nature_id,
            service_id:service_id,
            level:level
        },
        success:function(data){
            hideLoader();
            if(data.length)
            {
                //$('#'+nature_dropdown_id).append('<option value="">Select Ticket Nature</option>');
                for(var i = 0; i < data.length; i++) {
                    $('#'+nature_dropdown_id).append('<option value='+data[i].id+' >'+data[i].category_name+'</option>');
                }
            }
            else{
                //$('#'+nature_dropdown_id).append(' <option value="" selected="">Select Ticket Nature</option>');
            }
        }    
    });
}