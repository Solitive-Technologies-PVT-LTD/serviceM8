@extends('layouts.master')
@section('pagetitle') {{ $pagetitle }} @endsection
@section('css')
@include('layouts.datatable_css')
@endsection

@section('content')
@component('components.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'pagetitle' => $pagetitle, 'urls' => $urls])
@endcomponent
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Roles Management</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            @php
                            $total = count($breadcrumbs);
                            $active = $total-1;
                            @endphp
                            @foreach ($breadcrumbs as $key => $item)
                                @if ($key == $active)
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="{{ url($urls[$key]) }}">{{$item}}</a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item">
                                        <a href="{{ url($urls[$key]) }}">{{$item}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0"></h3>
                    <p class="text-sm mb-0"></p>
                </div>
                <div class="card-body">
                    <form class="needs-validation"  novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-control-label" for="role">Role</label>
                                <input type="text" class="form-control" id="role"  name="role" placeholder="Role" value="{{$role->name}}" required>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-control-label" for="permission">Permissions</label>
                                @foreach ($rolePermissions as $permission)
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="permission-{{$permission->id}}" name="permission[]" type="checkbox" value="{{$permission->id}}" checked>
                                            <label class="custom-control-label" for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                        </div>
                                    </div>
                                @endforeach
                                @error('permission')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
