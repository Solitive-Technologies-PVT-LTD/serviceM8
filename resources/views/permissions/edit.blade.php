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
            <form method="post" action="{{route('permission-update')}}" name="add-permission-form" id="add-permission-form" enctype="multipart/form-data"> 
                @csrf
                <input type="hidden" value="{{$permission->id}}" name="id" >
                <div class="card-body">
                <div class="" id="error_messages"></div>
                    <div class="live-preview">
                        @if($permission->parent_id != 0)   
                            <div class="row gy-4">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect01">Options <span class="text-danger">*</span></label>
                                            <select class="form-select @error('module') is-invalid @enderror" id="inputGroupSelect01" name="module">
                                                <option value="" >Select Module</option>
                                                @foreach($permissions as $data)
                                                    <option value="{{$data->id}}" @if($permission->parent_id == $data->id) selected=""  @endif >{{$data->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('module')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                                    </div> 
                                </div>
                            </div>
                        @endif
                        <div class="row gy-4 mt-3">
                            <div class="col-lg-12 ">
                                <div>
                                    <label for="permission_name" class="form-label">Enter Permission Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('permission_name') is-invalid @enderror" name="permission_name" id="permission_name" value="{{old('permission_name', $permission->name)}}" placeholder="Enter Permission Name">
                                    @error('permission_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mb-1 mt-5">
                    <a href="{{route('permissions')}}">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                <i class="mdi mdi-cancel w-sm"></i> Cancel
                            </button>
                        </a>
                       <button type="button" class="btn btn-success w-sm submit_form">Update</button>
                    </div>
                </div>  
                
            </form>  
        </div>       
    </div>                               
</div>
@endsection

@section('script')
    <script>
        function toggleModule()
        {
            if($('#add_new_module').is(":checked"))
            {
                $('#new_module').removeClass('d-none')
                $('#select_module').addClass('d-none')
            }
            else{
                $('#new_module').addClass('d-none')
                $('#select_module').removeClass('d-none')

            }
        }
        var errors_array = [];
      
        function formValidation(){
            $("#error_messages").empty();
            errors_array = [];
            var add_new_module = $('#add_new_module').is(":checked");
            var module =  $('#inputGroupSelect01').val();
            if(module == '' ){
            errors_array.push("Please select module name");
            }
            permission_name =  $('#permission_name').val();
            if(permission_name == '' ){
            errors_array.push("Permission name is required");
            }

            if (errors_array.length > 0) 
            {  
                errors_array.forEach(myFunction);
                function myFunction(value, index, array) 
                {
                    $("#error_messages").append("<div class='alert alert-danger' >"+value+" </div>");
                }
            $(window).scrollTop(0);
                    return false;       
            }else{
                return true;
            }
        }
        $(".submit_form").on('click', function(event){
            var formValidationCheck  = formValidation();
            if(formValidationCheck){
                $("#add-permission-form").submit();
            }
        });
    </script>
@endsection