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
            <form method="post" action="{{route('permission-save')}}" name="add-permission-form" id="add-permission-form" enctype="multipart/form-data"> 
                @csrf
                <div class="" id="error_messages"></div>
                <div class="card-body">
                
                    <div class="live-preview">
                            <!-- Base Example -->
                        <div class="row gy-4 "  >
                            <div class="col-lg-12 @if (old('add_new_module_checkbox') == 'on')  d-none @endif" id="select_module">
                                <div class="input-group">
                                    <label class="input-group-text" for="inputGroupSelect01">Options <span class="text-danger">*</span></label>
                                        <select class="form-select @error('module') is-invalid @enderror" id="inputGroupSelect01" name="module">
                                            <option value="" selected="">Choose...</option>
                                            @foreach($permissions as $permission)
                                                <option @if (old('module') == $permission->id)  selected @endif value="{{$permission->id}}">{{$permission->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('module')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                                </div> 
                            </div>
                            <div class="form-check" style="margin-left:14px" >
                                <input class="form-check-input" type="checkbox" id="add_new_module" name="add_new_module_checkbox"  onChange="toggleModule()" @if (old('add_new_module_checkbox') == 'on')  checked @endif>
                                <label class="form-check-label" for="add_new_module">
                                    Add a New Module
                                </label>
                            </div>
                        </div>
                        <div class="row gy-4 mt-3  @if (old('add_new_module_checkbox') == 'on')  d-block @else d-none @endif" id="new_module">
                            <div class="col-lg-12">
                                <div>
                                    <label for="new_module" class="form-label">Enter Module Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('new_module') is-invalid @enderror" value="{{ old('new_module') }}" name="new_module" id="new_module_value" placeholder="Enter Module Name">
                                    @error('new_module')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                       
                        <div class="row gy-4 mt-3">
                            <div class="col-lg-12 ">
                                <div>
                                    <label for="permission_name" class="form-label">Enter Permission Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('permission_name') is-invalid @enderror" value="{{ old('permission_name') }}" name="permission_name" id="permission_name" placeholder="Enter Permission Name">
                                    @error('permission_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                                </div>
                            </div>
                    </div>
                    <div class="text-end mb-1 mt-5">
                    <a href="{{route('permissions')}}">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                <i class="mdi mdi-cancel w-sm"></i> Cancel
                            </button>
                        </a>
                       <button type="button" class="btn btn-success w-sm submit_form">Create</button>
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
            if(add_new_module){
            var new_module =  $('#new_module_value').val();
            if(new_module == '' ){
            errors_array.push("Module name is required");
            }
            }else{
            var module =  $('#inputGroupSelect01').val();
            if(module == '' ){
            errors_array.push("Please select module name");
            }
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