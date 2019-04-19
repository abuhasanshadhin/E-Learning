@extends('instructor.master')

@section('title', 'Sections')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h5 class="m-0 font-weight-light">Section List</h5>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Title</th>
                    <th>Course</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            @php($i = 1)

            @foreach ($sections as $section)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $section->title }}</td>
                    <td>{{ $section->course->title }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('instructor.edit-section', $section->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fa fa-edit"></i> </a>
                            <form action="{{ route('instructor.delete-section') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $section->id }}">
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