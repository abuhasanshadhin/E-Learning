@extends('admin.master')

@section('title', 'Edit Section')

@section('content')

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="p-4 card shadow">

                <h4 class="text-center font-weight-light">Edit Section</h4><hr>

                <form method="POST" action="{{ route('admin.update-section') }}">
                    @csrf
                    @method('put')

                    <input type="hidden" name="id" value="{{ $section->id }}">

                    <div class="form-group">
                        <label for="course_id">Course</label>
                        <select name="course_id" id="course_id" class="form-control form-control-user">
                            <option value="">--Select One--</option>
                            @foreach ($courses as $course)
                                <option @if ($section->course_id == $course->id) selected  @endif 
                                value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('course_id')) 
                            <p class="text-danger">{{ $errors->first('course_id') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="title">Section title</label>
                        <input type="text" name="title" value="{{ $section->title }}" class="form-control form-control-user" id="title">
                        @if ($errors->has('title')) 
                            <p class="text-danger">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            <i class="fa fa-plus"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        CKEDITOR.replace('description')
    </script>
@endpush


