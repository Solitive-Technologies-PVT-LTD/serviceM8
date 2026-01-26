$('#province_id').on('change', function() {
    $('#district_id').html('');
    fetchDistricts();
});
function fetchDistricts(){
    
    var province_id = $("#province_id").val();
    showLoader();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        url: baseURL,
        type : "POST",
        data : {
           province_id: province_id,
        },
        success:function(data){
            hideLoader();
            if(data.length)
            {
                if($("#district_id").attr("multiple"))
                {
                }
                else{
                    $('#district_id').append('<option value="" selected="">Select district</option>');
                }
                for(var i = 0; i < data.length; i++) {
                    $('#district_id').append('<option value='+data[i].id+' >'+data[i].district_name+'</option>');
                }
            }
            
        }    
    });
}

$('#province').on('change', function() {
    $('#district').html('');
    fetchDistrictsName();
});

function fetchDistrictsName(){
    var province = $("#province").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: baseURL,
        type : "POST",
        data : {
            province: province,
        },
        success:function(data){
            for(var i = 0; i < data.length; i++) {
                $('#district').append('<option value='+data[i].district_name+' >'+data[i].district_name+'</option>');
            }
        }    
    });
}

// function successContactAssignment( response ){
//     var message = response.message;
//     var data = response.data;
//     if(response.success){
    
//     }else{
//         //alertMessageFunction('Validation', message  ,  'error');
//     }
