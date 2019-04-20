@extends('admin.master')

@section('title', 'Edit Lesson')

@section('content')

<div class="row">
<div class="col-md-10 offset-md-1">
    <div class="p-4 card shadow">

        <h4 class="text-center font-weight-light">Edit Lesson</h4><hr>

        <form method="POST" action="{{ route('admin.update-lesson') }}">
            @csrf
            @method('put')

            <input type="hidden" name="id" value="{{ $lesson->id }}">

            <div class="form-group">
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id" class="form-control form-control-user">
                    <option value="">--Select One--</option>
                    @foreach ($courses as $course)
                        <option @if ($course->id == $lesson->course_id) selected @endif 
                        value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
                @if ($errors->has('course_id')) 
                    <p class="text-danger">{{ $errors->first('course_id') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="section_id">Section</label>
                <select name="section_id" id="section_id" class="form-control form-control-user">
                    <option value="">--Select One--</option>
                </select>
                @if ($errors->has('section_id')) 
                    <p class="text-danger">{{ $errors->first('section_id') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="title">Lesson title</label>
                <input type="text" name="title" value="{{ $lesson->title }}" class="form-control form-control-user" id="title">
                @if ($errors->has('title')) 
                    <p class="text-danger">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ $lesson->description }}</textarea>
                @if ($errors->has('description')) 
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="video_url">Video URL</label>
                <textarea name="video_url" class="form-control" id="video_url">{{ $lesson->video_url }}</textarea>
                @if ($errors->has('video_url')) 
                    <p class="text-danger">{{ $errors->first('video_url') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="source_code_url">Source Code URL</label>
                <textarea name="source_code_url" class="form-control" id="source_code_url">{{ $lesson->source_code_url }}</textarea>
                @if ($errors->has('source_code_url')) 
                    <p class="text-danger">{{ $errors->first('source_code_url') }}</p>
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

        sectionsByCourse();

        $('#course_id').change(function() {
            sectionsByCourse();
        });

        function sectionsByCourse() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('admin.sections-by-course-id') }}",
                method: "POST",
                data: {course_id: $('#course_id').val(), _token: _token},
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('#section_id').html(data);
                        document.getElementById('section_id').value = "{{ $lesson->section_id }}";
                    }
                }
            });
        }

        var url = '{{ url('/') }}';
        var options = {
            filebrowserImageBrowseUrl: url+'/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: url+'/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: url+'/laravel-filemanager?type=Files',
            filebrowserUploadUrl: url+'/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('description', options);
        
    </script>
@endpush
