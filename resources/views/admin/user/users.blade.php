@extends('admin.master')

@section('title', 'Users')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h5 class="m-0 font-weight-light">User List</h5>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            @php($i = 1)

            @foreach ($users as $user)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td><img src="{{ asset(optional($user->profile)->photo) }}" height="50" alt="..."></td>
                    <td>
                        @if ($user->is_approved == 1 && $user->role == 'instructor')
                            <span class="btn-sm bg-success text-light">Approved</span>
                        @elseif ($user->is_approved == 0 && $user->role == 'instructor')
                            <a href="{{ route('admin.user-approve', $user->id) }}" class="btn btn-warning btn-sm">Approve</a>
                        @else
                            <span class="btn-sm bg-success text-light">N/A</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.user-details', $user->id) }}" class="btn btn-sm btn-info mr-1">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.user-delete') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"> 
                                    <i class="fa fa-trash-alt"></i> 
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
</div>

@endsection