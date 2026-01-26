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
            <form method="post" action="{{route('users-update')}}" name="add-setting-form" id="add-setting-form" enctype="multipart/form-data"> 
                @csrf
                <input type="hidden" value="{{$user->id}}" name="id" >
                <div class="card-body">
                
                    <div class="live-preview">
                        <div class="row gy-4 mt-1">
                            <div class="col-lg-6 ">
                                <div>
                                <label for="username" class="form-label">Name <span class="text-danger">*</span></label>
                                <input placeholder="Enter Name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name',$user->name) }}"/>
                               @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div>
                                    <label for="email" class="form-label">Email </label>
                                    <input placeholder="Enter Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}"
                                    />
                                    @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row gy-4 mt-1">
                            <div class="col-lg-6 ">
                                <div>
                                    <label for="contact" class="form-label">Contact Number </label>
                                    <input placeholder="Enter Contact Number"  type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="contact"  class="form-control @error('contact') is-invalid @enderror" name="contact"
                                    value="{{ old('contact',$user->contact) }}" />
                                    @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div>
                                    <label for="roles" class="form-label">Roles <span class="text-danger">*</span></label>
                                   
                                    <select class="form-control select2 @error('roles') is-invalid @enderror" id="roles" name="roles[]" multiple="multiple"> 
                                    @foreach($roles as $role)
                                            
                                            <option value="{{ $role->id }}" @if(in_array($role->id, old('roles', Arr::pluck($user->roles->toArray(), 'id')))) selected @endif>{{ $role->name }}</option></option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row gy-4 mt-1">
                            <div class="col-lg-6 ">
                                <div>
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
                                    @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div>
                                    <label for="password-confirm" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input placeholder="Enter Confirm Password" id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                    @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mb-1 mt-5">
                        <a href="{{route('users')}}">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                <i class="mdi mdi-cancel w-sm"></i> Cancel
                            </button>
                        </a>
                       <button type="submit" class="btn btn-success w-sm">Update</button>
                    </div>
                </div>  
                
            </form>  
        </div>       
    </div>                               
</div>


@endsection
@section('script')

<script>
$(document).ready(function() {
      $('.select2').select2();

});

</script>
@endsection