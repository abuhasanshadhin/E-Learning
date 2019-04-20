@extends('admin.master')

@section('title', 'Lessons')

@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-light">Lesson List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Title</th>
                        <th>Section</th>
                        <th>Course</th>
                        <th>Instructor</th>
                        <th>View Time</th>
                        <th>Likes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @php($i = 1)

                    @foreach ($lessons as $lesson)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $lesson->title }}</td>
                            <td>{{ $lesson->section->title }}</td>
                            <td>{{ $lesson->course->title }}</td>
                            <td>{{ $lesson->instructor->name }}</td>
                            <td>{{ $lesson->views->count() }}</td>
                            <td>{{ $lesson->likes->count() }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.edit-lesson', $lesson->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fa fa-edit"></i> </a>
                                    <form action="{{ route('admin.delete-lesson') }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{ $lesson->id }}">
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