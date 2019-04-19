@extends('website.master')

@section('title', 'Change Password')

@section('content')

    <div class="container my-5">

        <h4 class="mb-3 text-center">Change Password</h4>

        <form method="POST" action="{{ route('user.change-password') }}">
            @csrf

            <div class="row">
                <div class="col-md-4 offset-md-4">

                    <div class="form-group">
                        @if (Session::get('message'))
                            <p class="alert alert-success text-center">{{ Session::get('message') }}</p>
                        @elseif (Session::get('error-message'))
                            <p class="alert alert-danger text-center">{{ Session::get('error-message') }}</p>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <input type="password" name="old_password" value="{{ old('old_password') }}" id="" placeholder="Your old password" class="form-control" autofocus>
                        @if ($errors->has('old_password'))
                            <span class="text-danger">{{ str_replace('_', ' ', $errors->first('old_password')) }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="new_password" value="{{ old('new_password') }}" id="" placeholder="Your new password" class="form-control">
                        @if ($errors->has('new_password'))
                            <span class="text-danger">{{ str_replace('_', ' ', $errors->first('new_password')) }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_new_password" id="" placeholder="Your confirm new password" class="form-control">
                        @if ($errors->has('confirm_new_password'))
                            <span class="text-danger">{{ str_replace('_', ' ', $errors->first('confirm_new_password')) }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block"> Change </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    
@endsection