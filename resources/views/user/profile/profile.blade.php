@extends('website.master')

@section('title', 'Register')

@section('content')

<div class="container my-4">

    <div class="row">
        <div class="col-md-8 offset-md-2">

            @if (!empty(Session::get('message')))
                <p class="text-center alert alert-success">
                    {{ Session::get('message') }}
                </p>
            @endif
            
            <p class="text-center">
                @if (!empty($profile->photo))
                    <img src="{{ asset($profile->photo) }}" class="w-25 img-thumbnail" alt="...">
                @else
                    <img src="{{ asset('images/default.jpg') }}" class="w-25 img-thumbnail" alt="...">
                @endif
            </p>

            <div class="text-center">
                <button id="user-profile-edit-btn" class="btn btn-sm btn-primary"> 
                    <i class="fa fa-user-edit"></i> Edit
                </button>
                <button id="user-profile-info-btn" class="btn btn-sm btn-primary"> 
                    <i class="fa fa-user"></i> Info
                </button>
            </div>

            <div class="table-responsive p-4" id="user-profile-info">
                <table class="table table-bordered profile">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $profile->dob }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $profile->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $profile->address }}</td>
                    </tr>
                    <tr>
                        <th>Institute</th>
                        <td>{{ $profile->institute }}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{ $profile->subject }}</td>
                    </tr>
                    <tr>
                        <th>Join Date</th>
                        <td>{{ $profile->created_at->format('F d, Y h:i:s A') }}</td>
                    </tr>
                </table>
            </div>

        </div>
    </div><br>


    {{--  Update form  --}}
    <form method="POST" action="{{ route('user.profile-update') }}" id="user-profile-edit-form" enctype="multipart/form-data">
        @csrf

        <div class="row bg-light">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-6 p-3">
                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="file" name="photo" id="" class="form-control" autofocus>
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
                    </div>
                    <div class="col-md-6 p-3">
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
                    </div>
                </div>

                <div class="col-md-6 offset-md-3 mt-1">
                    <button type="submit" class="btn btn-primary btn-block py-2"> UPDATE </button>
                </div><br>
            </div>
        </div>

    </form>

</div>
    
@endsection

@push('js')
    <script>

        $('#user-profile-edit-form').hide();
        $('#user-profile-info-btn').hide();

        $('#user-profile-edit-btn').click(function () {
            $('#user-profile-edit-form').show();
            $('#user-profile-info-btn').show();
            $('#user-profile-info').hide();
            $('#user-profile-edit-btn').hide();
        });

        $('#user-profile-info-btn').click(function () {
            $('#user-profile-info').show();
            $('#user-profile-edit-btn').show();
            $('#user-profile-edit-form').hide();
            $('#user-profile-info-btn').hide();
        });
        
    </script>
@endpush