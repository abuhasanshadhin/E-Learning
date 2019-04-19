@extends('admin.master')

@section('title', 'Courses')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h5 class="m-0 font-weight-light">Course List</h5>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Instructor</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            @php($i = 1)

            @foreach ($courses as $course)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->category->title }}</td>
                    <td><img src="{{ asset($course->image) }}" height="50" alt="..."></td>
                    <td>{{ $course->instructor->name }}</td>
                    <td>
                        @if ($course->is_approved == 1) 
                            <span class="btn-sm bg-success text-light">Approved</span> 
                        @else
                            <a href="{{ route('admin.approve-course', $course->id) }}" class="btn btn-warning btn-sm">Approve</a>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.edit-course', $course->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fa fa-edit"></i> </a>
                            <form action="{{ route('admin.delete-course') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $course->id }}">
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