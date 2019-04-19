@extends('admin.master')

@section('title', 'User Details')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4 col-md-8 offset-md-2">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-light">User Details</h5>
    </div>
    <div class="card-body">
        <p class="text-center">
            <img src="{{ asset(optional($user->profile)->photo) }}" class="img-thumbnail" alt="...">
        </p>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Registered as</th>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ optional($user->profile)->phone }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ optional($user->profile)->dob }}</td>
                </tr>
                <tr>
                    <th>Institute</th>
                    <td>{{ optional($user->profile)->institute }}</td>
                </tr>
                <tr>
                    <th>Subject</th>
                    <td>{{ optional($user->profile)->subject }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ optional($user->profile)->address }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection