<div class="row">
    <div class="col">

        <div class="h-100">
          
            <!--end row-->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-danger fs-14 mb-0">
                                       
                                        {{$data['total_percentage']}}%
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold text-danger ff-secondary mb-4">{{$data["total"]}} 
                                    </h4>
                                   
                                </div>
                                
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger rounded fs-3">
                                        <i class="mdi mdi-arrow-expand-all"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between ">
                                <div>
                                    <h4 class="fs-22 fw-semibold text-danger ff-secondary">{{$data['total_amount']}}
                                    </h4>
                                   
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Open </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-warning fs-14 mb-0">
                                      
                                        {{$data['open_percentage']}}%
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold text-warning ff-secondary mb-4"><span
                                            class="counter-value" data-target="36894">{{$data["open"]}}</span></h4>
                                   
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning rounded fs-3">
                                      <i class="mdi mdi-ballot"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between ">
                                <div>
                                    <h4 class="fs-22 fw-semibold text-warning ff-secondary">{{$data['open_amount']}}
                                    </h4>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Verified </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-info fs-14 mb-0">
                                       
                                        {{$data['verified_percentage']}}%
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold text-info ff-secondary mb-4">{{$data['verified_count']}}
                                    </h4>
                                  
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info rounded fs-3">
                                        <i class="bx bx-user-circle"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between ">
                                <div>
                                    <h4 class="fs-22 fw-semibold text-info ff-secondary">{{$data['verified_amount']}}
                                    </h4>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                       Confirmed</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        {{$data['confirmed_percentage']}}%
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold text-success ff-secondary mb-4">{{$data['confirmed_count']}}
                                    </h4>
                                  
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success rounded fs-3">
                                        <i class="mdi mdi-shield-lock-open"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between ">
                                <div>
                                    <h4 class="fs-22 fw-semibold text-success ff-secondary">{{$data['confirmed_amount']}}
                                    </h4>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            <div class="row">
                <div class="col-xl-6">
                    <!-- card -->
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">StatusWise Graph</h4>
                            
                        </div><!-- end card header -->

                        <!-- card body -->
                        <div class="card-body">
                            <div id="graph-by-location"
                                data-colors='["--vz-light", "--vz-success", "--vz-primary"]'
                                style="height: 500px" dir="ltr"></div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-6">
                    <!-- card -->
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Status Wise Graph</h4>
                            
                        </div><!-- end card header -->

                        <!-- card body -->
                        <div class="card-body">
                            <div id="sales-by-locations"
                                data-colors='["--vz-light", "--vz-success", "--vz-primary"]'
                                style="height: 500px" dir="ltr"></div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <!-- card -->
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Offices Wise Data</h4>
                            
                        </div><!-- end card header -->

                        <!-- card body -->
                        <div class="card-body">
                            <div id="graph-by-offices"
                                data-colors='["--vz-light", "--vz-success", "--vz-primary"]'
                                style="height: 500px" dir="ltr"></div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div><!-- end col -->

                
                <!-- end col -->
            </div>

 <!-- end col -->
</div>
