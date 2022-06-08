@extends('admin.admin_master')
@section('comtent')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit Profile</h4>
                        {{-- <p class="card-title-desc">Here are examples of <code
                                class="highlighter-rouge">.form-control</code> applied to each
                            textual HTML5 <code class="highlighter-rouge">&lt;input&gt;</code> <code
                                class="highlighter-rouge">type</code>.</p> --}}
                        <form action="{{ route('store.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" class="form-control" type="text" placeholder="Name"
                                        value="{{ old('name', optional($adminData ?? null)->name) }}">
                                </div>
                            </div>

                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-search-input" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input name="username" class="form-control" type="search" placeholder="How do I shoot web"
                                    value="{{ old('username', optional($adminData ?? null)->username) }}">
                                </div>
                            </div>

                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input name="email" class="form-control" type="email" placeholder="bootstrap@example.com"
                                    value="{{ old('email', optional($adminData ?? null)->email) }}">
                                </div>
                            </div>

                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-email-input" class="col-sm-2 col-form-label">Profile Image</label>
                                <div class="col-sm-10">
                                    <input id="image" name="profile_image" class="form-control" type="file"
                                    value="{{ old('profile_image', optional($adminData ?? null)->profile_image) }}">
                                </div>
                            </div>

                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-email-input" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg"  src="{{ (!empty($adminData->profile_image) ? asset('upload/profile_images/'. $adminData->profile_image) : '/backend/assets/images/no_image.jpg' ) }}" alt="Profile Image">
                                </div>
                            </div>

                            <button class="btn btn-info btn-rounded waves-effect waves-light" type="submit">Update Profile</button>

                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection