
<script src="<?php echo e(url('/assets/libs/bootstrap/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/node-waves/node-waves.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/feather-icons/feather-icons.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/pages/plugins/lord-icon-2.1.0.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/plugins.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/select/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/circle-progress.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/alert.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/jquery.validate.js')); ?>"></script>
<!-- echarts init -->
<script src="<?php echo e(url('/assets/js/app.min.js')); ?>"></script>

<script src="<?php echo e(url('/assets/js/jquery.dataTables.min.js')); ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo e(url('/assets/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
<!-- toastr plugin -->
<script src="<?php echo e(url('/assets/libs/toastr/build/toastr.min.js')); ?>"></script>
<!-- Custom Js -->
<script src="<?php echo e(url('/assets/js/customs/dashboard.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/loadingoverlay.min.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldContent('script-bottom'); ?>
<script>
    //On Dom ready
    $(document).ready(function () {
        //For Dashboard Agents in Queue Table
        //Close Customizer on page Load
       

    //Onclick of Buttons of Agent Queue Table 

    //notifications get by ajax
    

    

    function alertMessage(type, message) {
        const Toast = Swal.mixin({
            //toast: true,
            position: 'top-end',
            showConfirmButton: false,
            //showCancelButton: true,
            //cancelButtonClass: "swal2-close",
            //cancelButtonText:'<span aria-hidden="true">×</span>',
            //cancelButtonColor: 'rgb(222 53 53)',
            //cancelButtonColor: "#ff3d60",
            timer: 3000
        });
        
        Toast.fire({
            icon: type,
            type: type,
            title: type,
            text: message
        });
    }

    //Select 2 inital
    $('.select2').select2({
        //theme: "bootstrap",
        //width: "100%",
        allowHtml: true,
        placeholder: "Select value",
        
    });

    //Select All Unselect Select2
    function allCheckUncheck(checkbox_id , select_id){
        
        if($("#"+checkbox_id).is(':checked')){
            $("#"+select_id+" option").prop("selected","selected");
            $("#"+select_id).trigger("change");
        }else{
            $("#"+select_id).val('').trigger("change");
        }
    }

    //Check all selected or not

    function checkAllSelected(checkbox_id , select_id){
        var option_length = $('#'+select_id +" option").length;
        var selected_length = $('#'+select_id +" :selected").length;;
        if(option_length > selected_length){
            $("#"+checkbox_id).prop("checked", false);
        }else if(option_length == selected_length){
            $("#"+checkbox_id).prop("checked", true);
        }
    }

    function format(icon) {
    var originalOption = icon.element;
    return $('<span><i style="font-size:16px;" class="mdi ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
    }
    $('.icons_select2').select2({
        width: "100%",
        templateSelection: format,
        templateResult: format
    });
   
    

        function collapse_div(resize_div_id , div_along_id){
            if($("#"+resize_div_id).hasClass('col-md-8')){
                $("#"+resize_div_id).removeClass('col-md-8');
                $("#"+resize_div_id).addClass('col-md-12');
                $("#"+div_along_id).addClass('d-none');
            }
            else if($("#"+resize_div_id).hasClass('col-md-7')){
                $("#"+resize_div_id).removeClass('col-md-7');
                $("#"+resize_div_id).addClass('col-md-12');
                $("#"+div_along_id).removeClass('col-md-5');
                $("#"+div_along_id).addClass('col-md-4');
                $("#"+div_along_id).addClass('d-none');
            }
            else if($("#"+resize_div_id).hasClass('col-md-12')){
                $("#"+resize_div_id).removeClass('col-md-12');
                $("#"+resize_div_id).addClass('col-md-8');
                $("#"+div_along_id).removeClass('d-none');
            }
        }

        function resize_div(resize_div_id , div_along_id){
            if($("#"+resize_div_id).hasClass('col-md-4')){
                $("#"+div_along_id).removeClass('col-md-8');
                $("#"+div_along_id).addClass('col-md-7');
                $("#"+resize_div_id).removeClass('col-md-4');
                $("#"+resize_div_id).addClass('col-md-5');
            }
            else if($("#"+resize_div_id).hasClass('col-md-5')){
                $("#"+div_along_id).removeClass('col-md-7');
                $("#"+div_along_id).addClass('col-md-8');
                $("#"+resize_div_id).removeClass('col-md-5');
                $("#"+resize_div_id).addClass('col-md-4');
            }
        }
    });
    function delete_record( record_id) {
            var delete_url = $('#delete_url_'+record_id).val();
            Swal.fire({
                title: "Are you sure to want to delete this record?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonClass: "btn btn-success w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: "Yes, delete it!",
                buttonsStyling: !1,
                showCloseButton: !0
            }).then(function(t) {
                if(t.value)
                {
                    //$('form#'+form_id).submit();
                    $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        url: delete_url,
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            id : record_id
                        },
                        success: function(result) {
                            const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                            });
                            Toast.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'success',
                            text: 'Record Deleted Successfully'
                            });
                            location.reload();
                            },
                            error: function(error) {
                            const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                            });
                            Toast.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'error',
                            text: 'Record Not Deleted'
                            });
                            }
                            });
                }
            });
        }
</script>
<?php /**PATH C:\laragon\www\serviceM8\resources\views/layouts/vendor-scripts.blade.php ENDPATH**/ ?>