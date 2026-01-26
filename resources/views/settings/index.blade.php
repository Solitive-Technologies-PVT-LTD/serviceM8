@extends('layouts.master')
@section('pagetitle') {{ $pagetitle }} @endsection
@section('css')
@include('layouts.datatable_css')
@endsection

@section('content')
@component('components.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'pagetitle' => $pagetitle, 'urls' => $urls])
@endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            @php
                $isSuperAdmin = isSuperAdmin();
                $user = Auth::user();
                @endphp
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 text-end ">
                        @if($user->can('setting-create') ||  $isSuperAdmin)      
                            <button id="add_setting" type="button" class="btn btn-info" onclick="addSetting()"> Add Setting</button>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-settings" class="table table-flush table-hover table-striped align-middle table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Type</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Create Settings </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form method="post" action="{{route('setting-save')}}" name="add-setting-form" id="add-setting-form" enctype="multipart/form-data"> 
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="modal-body"> 
                         <div class="mb-3">
                            <label for="key_value" class="form-label">Key Value</label>
                            <input type="text" id="key_value" name="key_value" class="form-control" placeholder="Enter key" required />
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" name="name" id="name" class="form-control" placeholder="Enter Name" required />
                        </div>

                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Type</label>
                            <select class="form-control" data-trigger  name="type" id="type">   
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="value" class="form-label">Value</label>
                            <input type="text" id="text_value" name="value" class="form-control" placeholder="Value"  />
                            <input type="file" id="img_value" name="value" class="form-control d-none mb-3" placeholder="Select Value"  />
                            <img class="rounded-circle header-profile-user d-none " id="settings_img"  />
                        </div>

                     
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success"  id="add-btn">Add Setting</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->
    
@endsection
@section('script')
@include('layouts.datatable_js')
    <script>
        function addSetting(){
            document.getElementById("add-setting-form").reset();
            $('#add-btn').text('Add Setting');
            $('#exampleModalLabel').text('Create Settings');
            $('#showModal').modal('show');
        }
         var YajraDataTable;
        $("#type").change(function () {
            if($(this).val() == "text")
            {
                 
                $("#img_value").addClass("d-none")
                $("#text_value").removeClass("d-none")
            }
            else if($(this).val() == "image")
            {  
                $("#img_value").removeClass("d-none")
                $("#text_value").addClass("d-none")
            }
        }); 
        let table = $('#datatable-settings');
        $(function() {
            var columns = [ 0,1,2,3 ];
                table.DataTable({
                processing: true,
                serverSide: true,
                stateSave: false,
                responsive: true,
                autoWidth:false,
                lengthMenu: [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
                aaSorting : [[0, 'desc']],
                pagingType: "full_numbers",
                pageLength: 50,
                dom: 'Blrtip',
                buttons: [{
                    extend: 'colvis'
                    }
                ],
                ajax: '{!! url('/settings/setting-ajax-data') !!}',
               
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'value', name: 'value' },
                    { data: 'type', name: 'type' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions', searchable: false, orderable:false }
                ]
            });
            $('#datatable-settings_length').addClass('float-end');
        });

        function getDateTime() 
        {
            var now     = new Date();
            var year    = now.getFullYear();
            var month   = now.getMonth()+1;
            var day     = now.getDate();
            var hour    = now.getHours();
            var minute  = now.getMinutes();
            var second  = now.getSeconds();
            if(month.toString().length == 1) {
                month = '0'+month;
            }
            if(day.toString().length == 1) {
                day = '0'+day;
            }
            if(hour.toString().length == 1) {
                hour = '0'+hour;
            }
            if(minute.toString().length == 1) {
                minute = '0'+minute;
            }
            if(second.toString().length == 1) {
                second = '0'+second;
            }
            var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;
            return dateTime;
        }
        function edit_action(settings_id){

            $('#add-btn').text('Update');
            $('#exampleModalLabel').text('Edit Settings');
           // $('#showModal').modal('show');
            
           //var setting_data =  $("#setting_data_"+settings).val();
           //alert(setting_data.key+setting_data_+"settings");
           $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
           $.ajax({
        url: "{{ route('get-settings-data') }}",
        type : "POST",
        data : {
            settings_id: settings_id,
        },
        success:function(settings){
           // alert("testing");
                //alert(settings.id);
                $('#showModal').modal('show');
                $('#key_value').val(settings.key);
                $('#name').val(settings.name);
                $('#type').val(settings.type);
                $('#id').val(settings.id);
                if(settings.type == "text")
                {
                $("#img_value").addClass("d-none")
                $("#text_value").removeClass("d-none")
                $("#text_value").val(settings.value);
                }
                else{
                $("#img_value").removeClass("d-none")
                $("#text_value").addClass("d-none")
                $('#settings_img').removeClass("d-none");
                $("#settings_img").attr('src',"{{asset('storage')}}/"+settings.value);c
                //$("#add-btn").text("Update");
                
                }
        }    
    });
      /*
        $('#key_value').val(settings.key);
        $('#name').val(settings.name);
        $('#type').val(settings.type);
        $('#id').val(settings.id);
        if(settings.type == "text")
        {
                $("#img_value").addClass("d-none")
                $("#text_value").removeClass("d-none")
                $("#text_value").val(settings.value);
            }
        else{
                $("#img_value").removeClass("d-none")
                $("#text_value").addClass("d-none")
                $('#settings_img').removeClass("d-none");
                $("#settings_img").attr('src',"{{asset('public/storage')}}/"+settings.value);
        }   
        */
    }
    $('.modal').on('hidden.bs.modal', function(e) {
        $('#settings_img').addClass("d-none");
    })
    </script>
@endsection