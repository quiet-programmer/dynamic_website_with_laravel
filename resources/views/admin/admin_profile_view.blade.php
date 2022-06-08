@extends('admin.admin_master')

@section('comtent')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card"> <br> <br>
                    <center>
                        @if($adminData->profile_image)
                        <img src="{{ asset('upload/profile_images/'. $adminData->profile_image) }}" class="rounded-circle avatar-xl" alt="User Profile Image">
                        @else
                        <img src="/backend/assets/images/no_image.jpg" class="rounded-circle avatar-xl" alt="User Profile Image">
                        @endif
                    </center>
                    <div class="card-body">
                        <h5 class="card-title">Name: {{ $adminData->name }}</h5>
                        <hr>
                        <h5 class="card-title">Username: {{ $adminData->username }}</h5>
                        <hr>
                        <h5 class="card-title">Email: {{ $adminData->email }}</h5>
                        <hr>
                        <a class="btn btn-info btn-rounded waves-effect waves-light" href="{{ route('admin.edit') }}">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection