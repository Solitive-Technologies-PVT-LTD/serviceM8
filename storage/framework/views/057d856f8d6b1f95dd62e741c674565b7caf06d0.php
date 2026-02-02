<?php $__env->startSection('pagetitle'); ?> <?php echo e($pagetitle); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'pagetitle' => $pagetitle, 'urls' => $urls]); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row pb-1">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                <div class="flex-grow-1">
                                    
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="hstack text-nowrap gap-2">
                                        
                                        <h5 class="mt-2"><i class="ri-filter-2-line me-1 align-bottom"></i> Filters : </h5>
                                        <div class="col-sm-auto">
                                            <input type="text" id="start_date" name="start_date" value="<?php echo e(date('d-m-Y').' 00:00'); ?>"  class="form-control flatpickr-input" >
                                        </div>
                                        <div class="col-sm-auto">
                                        <input type="text" id="end_date" name="end_date" value="<?php echo e(date('d-m-Y').' 23:59'); ?>"  class="form-control flatpickr-input" >
                                        </div>
                                        <button class="btn btn-info submit" id="view_report"> <i class="ri-refresh-line me-1 align-bottom"></i> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div id="dashboard_data"></div>
           

        </div> <!-- end .h-100-->

    </div> <!-- end col -->

   
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<link rel="stylesheet" href="<?php echo e(asset('/assets/libs/flatpickr/flatpickr.min.css')); ?>">
<script src="<?php echo e(asset('/assets/libs/flatpickr/flatpickr.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/libs/echarts/echarts.min.js')); ?>"></script>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
    window.onload = function(){ 
        $(".flatpickr-input").flatpickr({
                    maxDate: "today",
                   // minDate: new Date().fp_incr(14), // 14 days from now
                    enableTime: true,
                    dateFormat: "d-m-Y H:i",
        });
    }
   
    function ajaxCall()
    {
        showLoader();
      
            $.ajax({

            type:'POST',
            url:"<?php echo e(route('dashboard-data')); ?>",
               
            data: { _token: '<?php echo e(csrf_token()); ?>',start_date:$('#start_date').val(),
                    end_date:$('#end_date').val()},
            
            success:function(data){
           
            document.getElementById('dashboard_data').innerHTML=data.html;
            createPieGraph(data.data);
            createDonutGraph(data.data);
            crateLineChart(data.data);
            hideLoader();
            }

        });
    }

    function crateLineChart(data)
    {
        var chartDom = document.getElementById('graph-by-offices');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
            type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
            type: 'category',
            data: data["office_arr"],
            axisTick: {
                alignWithLabel: true
            }
            }
        ],
        yAxis: [
            {
            type: 'value'
            }
        ],
        series: [
            {
            name: 'No Of Recieveables',
            type: 'bar',
            barWidth: '60%',
            data: data["count_arr"]
            }
        ]
        };

        option && myChart.setOption(option);
    }

    function createDonutGraph(data)
    {
        var chart_data=[{"name":"Un Confirmed" , "value":data['unconfirmed_count']},{"name":"Un Verified" , "value":data['unverified_count']}];
        var chartDom = document.getElementById('graph-by-location');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
           
        title: {
            left: 'center'
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
          
        },
        series: [
            {
            name: 'Rejected Reciveables',
            type: 'pie',
            radius: ['40%', '50%'],
            data: chart_data,
            emphasis: {
                itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
            }
        ]
        };

        option && myChart.setOption(option);


    }

    function createPieGraph(data)
    {
        var chart_data=[{"name":"Open" , "value":data['open']},{"name":"Verified" , "value":data['verified_count']},{"name":"Confirmed" , "value":data['confirmed_count']}   ];
        var chartDom = document.getElementById('sales-by-locations');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
           
        title: {
            left: 'center'
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
          
        },
        series: [
            {
            name: 'Reciveables',
            type: 'pie',
            radius: '50%',
            data: chart_data,
            emphasis: {
                itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
            }
        ]
        };

        option && myChart.setOption(option);


    }
    $("#view_report").click(function(){
                
                var start_date  = $('#start_date').val();
                start_date =  moment(start_date, 'DD-MM-YYYY HH:mm');
                start_date = start_date.format('YYYY-MM-DD HH:mm');
                var end_date    = $('#end_date').val();
                end_date =  moment(end_date, 'DD-MM-YYYY HH:mm');
                end_date = end_date.format('YYYY-MM-DD HH:mm');
                var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
                var firstDate = new Date(start_date);
                var secondDate = new Date(end_date);
    
                var diffDays = Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay));
                var exct_diff = Math.ceil(diffDays);
                if (exct_diff > 7) {
                   
                            Toast.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Warning',
                            text: 'You can not Export more then 7 days of data.'
                            });
                  
                    return false;
                }
                if(start_date == '' )
                {
                    Toast.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Warning',
                            text: 'Please enter Start Date.'
                            });
                  
                   
                    return false;
                }
                if(end_date == '' )
                {
                    Toast.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Warning',
                            text: 'Please enter End Date.'
                            });
                    return false;
                }
                $('#view_report').LoadingOverlay("show");
                ajaxCall();
                $('#view_report').LoadingOverlay("hide");
            });
    setTimeout(function () { 
        ajaxCall();
    }, 60 * 1000);

   
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/dashboard/index.blade.php ENDPATH**/ ?>