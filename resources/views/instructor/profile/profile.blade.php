@extends('instructor.master')

@section('title', 'Instructor Profile')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4 col-md-8 offset-md-2">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-light">Your Profile</h5>
    </div>
    <div class="card-body">
        <p class="text-center">
            <img src="{{ asset(optional($user->profile)->photo) }}" class="img-thumbnail" alt="...">
        </p>
        <form method="POST" action="{{ route('user.profile-update') }}" id="user-profile-edit-form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="">Photo</label>
                <input type="file" name="photo" id="" class="form-control-file">
                @if ($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" id="" class="form-control">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Date of Birth</label>
                <input type="text" name="dob" value="{{ $profile->dob }}" id="" placeholder="yyyy/mm/dd" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" value="{{ $profile->phone }}" id="" class="form-control">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Institute</label>
                <input type="text" name="institute" value="{{ $profile->institute }}" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Subject</label>
                <input type="text" name="subject" value="{{ $profile->subject }}" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <textarea name="address" id="" class="form-control" rows="4">{{ $profile->address }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block py-2"> UPDATE </button>
            </div>
        </form>

    </div>
</div>

@endsection