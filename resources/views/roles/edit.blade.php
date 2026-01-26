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
            <form method="post" action="{{route('role-update')}}" name="add-setting-form" id="add-setting-form" enctype="multipart/form-data"> 
                @csrf
                <input type="hidden" name="id" value="{{$role->id}}">
                <div class="card-body">
                
                    <div class="live-preview">
                            <!-- Base Example -->
                        <div class="row gy-4 mt-3">
                            <div class="col-lg-12 ">
                                <div>
                                    <label for="role_name" class="form-label">Enter Role Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('role_name') is-invalid @enderror" name="role_name" id="role_name" placeholder="Enter Role Name" value="{{ old('role_name', $role->name) }}">
                                    @error('role_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row gy-4 mt-2">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('selected_permissions') ? ' has-error' : '' }} required-field">
                                    <label for="description" class="col-md-2 control-label">Permissions</label>

                                    <div class="col-md-10">
                                        <input type="hidden" id="selected_permissions" name="selected_permissions">
                                        <div id="permissions">
                                            <ul>
                                                @foreach($permissions as $permission)
                                                    @if($permission->children()->count() > 0)
                                                        <li id="{{ $permission->id }}">{{ $permission->name }}
                                                            <ul>
                                                                @foreach($permission->children as $sub_permission)
                                                                {{--  <li @if(in_array($sub_permission->id, old('selected_permissions', Arr::pluck($role->permissions->toArray(), 'id')))) data-jstree='{"selected":true}' @endif id="{{ $sub_permission->id }}">{{ $sub_permission->name }} </li> --}}
                                                                <li @if(in_array($sub_permission->id, Arr::pluck($role->permissions->toArray(), 'id'))) data-jstree='{"selected":true}' @endif id="{{ $sub_permission->id }}">{{ $sub_permission->name }} </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @else
                                                    {{-- <li @if(in_array($permission->id, old('selected_permissions', Arr::pluck($role->permissions->toArray(), 'id')))) data-jstree='{"selected":true}' @endif id="{{ $permission->id }}">{{ $permission->name }} </li>  --}}
                                                        <li @if(in_array($permission->id, Arr::pluck($role->permissions->toArray(), 'id'))) data-jstree='{"selected":true}' @endif id="{{ $permission->id }}">{{ $permission->name }} </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mb-1 mt-5">
                    <a href="{{route('roles')}}">
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
    <link rel="stylesheet" href="{{ asset('/assets/libs/jstree/dist/themes/default/style.min.css') }}" />
    <script src="{{ asset('/assets/libs/jstree/dist/jstree.min.js') }}"></script>
    <script>
           $(function () {
           
            $('#permissions').jstree({
                'plugins': ["checkbox"],
                "core": {
                    "themes": {
                        "icons": false
                    }
                }
            })
                .on('changed.jstree', function (e, data) {
                    var i, j, r = [];
                    for(i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).id);
                    }
                    $('#selected_permissions').val(r);
                })
        });
    </script>
@endsection

