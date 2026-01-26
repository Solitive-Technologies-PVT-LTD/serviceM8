@extends('layouts.master')
@section('pagetitle') {{ $pagetitle }} @endsection
@section('css')
@include('layouts.datatable_css')
@endsection

@section('content')
@component('components.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'pagetitle' => $pagetitle, 'urls' => $urls])
@endcomponent
<div class="row bg-white">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit  Menu Item :<strong>{{ $menu->title }}</strong> </h4>

            </div><!-- end card header -->
            <form method="post" action="{{ route('menus.update', $menu->id) }}"   enctype="multipart/form-data"> 
            {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="card-body">

                    <div class="live-preview">
                    <div class="row gy-4" >
                            <div class="col-lg-9 pt-2">
                                <label for="title"  class="form-label">Title <span class="text-danger">*</span></label>
                                <input placeholder="Enter Title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $menu->title) }}"/>
                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                    </div>
                    <div class="row gy-4" >
                            <div class="col-lg-9  pt-2">
                                <label for="display_name" class="form-label">Display Name <span class="text-danger">*</span></label>
                                <input placeholder="Enter Display Name" id="display_name" type="text" class="form-control @error('display_name') is-invalid @enderror" name="display_name"  value="{{ old('display_name', $menu->display_name) }}"/>
                                @error('display_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                    </div>
                    <div class="row gy-4" >
                            <div class="col-lg-9  pt-2" >
                                    <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                                    <select id="icon" class="select2 form-control @error('icon') is-invalid @enderror icons_select2" name="icon">
                                        <option value="">Select</option>
                                        @foreach($icons as $icon)
                                            <option value="{{ $icon->name }}" data-icon="mdi-{{ $icon->name }}" @if( $icon->name == $menu->icon ) selected @endif> {{ ucwords(str_replace("-", " ", $icon->name)) }}  
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('icon')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                    </div>
                    <div class="row gy-4" >
                            <div class="col-lg-9  pt-2" >
                                    <label for="parent_id" class="form-label">Parent Menu </label>
                                    <select id="parent_id" class="select2 form-control @error('parent_id') is-invalid @enderror" name="parent_id">
                                        <option value="0"> Select No Parent</option>
                                        @foreach($all_menus as $menu_item)
                                            <option value="{{ $menu_item->id }}" @if(old('parent_id', $menu->parent_id) == $menu_item->id) selected @endif data-icon="fa-{{ $menu_item->icon }}">{{ $menu_item->title }} </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                    </div>
                    <div class="row gy-4" >
                            <div class="col-lg-9  pt-2" >
                                <label for="route_name" class="form-label">Route Name <span class="text-danger">*</span></label>
                                <select id="route_name" class="select2 form-control @error('route_name') is-invalid @enderror" name="route_name">
                                    <option value="">Select</option>
                                    <option value="#" @if(old('route_name', $menu->route_name) == '#') selected @endif># [Not Applicable]</option>
                                    @foreach($all_routes as $route)
                                        @if($route->getName() != "")
                                            <option value="{{ $route->getName() }}" @if(old('route_name', $menu->route_name) == $route->getName()) selected @endif>{{ $route->getName() }} [{{ $route->uri() }}]</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('route_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                    </div>
                    <div class="row gy-4" >
                            <div class="col-lg-9  pt-2" >
                                <label for="permission" class="form-label">Permission </label>
                                <select id="permission" class="select2 form-control @error('permission') is-invalid @enderror" name="permission">
                                    <option value="">Select</option>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}" @if(old('permission', $menu->permission) == $permission->id) selected @endif>{{ $permission->name }} [{{ $permission->id }}]</option>
                                    @endforeach
                                </select>
                                @error('permission')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                    </div>
                    <div class="row gy-4 " >
                            <div class="col-lg-9  pt-2" >
                            <label for="active" class="form-label">Active <span class="text-danger">*</span></label>
                                <select id="active" class="select2 form-control @error('active') is-invalid @enderror" name="active">
                                    <option value="">Select</option>
                                    <option value="0" @if(old('active', $menu->active) == 0) selected @endif>No</option>
                                    <option value="1" @if(old('active', $menu->active) == 1) selected @endif>Yes</option>
                                </select>
                                @error('active')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                    </div>
                    <div class="row gy-4 " >
                            <div class="col-lg-9  pt-2" >
                                <label for="description" class="form-label">Description </label>


                                <textarea placeholder="Enter Description" id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"> {{ old('description', $menu->description) }}</textarea>
                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="mb-1 mt-5">
                    <a href="{{route('menus.index')}}">
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
    <div class="col-md-6 ">
        <div class="card vh-100" >
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Manage Menu Sequence </h4>

            </div>
            <div class="p-3">
                @include('menus.manage')
            </div>
        </div>
    </div>
        
</div>

@endsection
