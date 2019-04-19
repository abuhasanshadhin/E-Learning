@extends('website.master')

@section('title', 'Register')

@section('content')

    <div class="container my-5" data-aos="fade-up">

        <h3 class="title-lg mb-3 font-weight-light">Sign up</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <input type="text" name="name" value="{{ old('name') }}" id="" placeholder="Your name" class="input-custom" autofocus>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" value="{{ old('email') }}" id="" placeholder="Your E-mail" class="input-custom">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="" placeholder="Password" class="input-custom">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="" placeholder="Confirm Password" class="input-custom">
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="form-group my-checkbox">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="role" value="instructor" class="custom-control-input" id="role">
                            <label class="custom-control-label" for="role">Became an Instructor</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-custom"> Sign up </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    
@endsection