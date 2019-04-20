@extends('admin.master')

@section('title', 'Edit Course')

@section('content')

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="p-4 card shadow">

                <h4 class="text-center font-weight-light">Edit Course</h4><hr>

                <form method="POST" action="{{ route('admin.update-course') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <input type="hidden" name="id" value="{{ $course->id }}">

                    <div class="form-group">
                        <label for="title">Course Name</label>
                        <input type="text" name="title" value="{{ $course->title }}" class="form-control form-control-user" id="title">
                        @if ($errors->has('title')) 
                            <p class="text-danger">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control form-control-user">
                            <option value="">--Select One--</option>
                            @foreach ($categories as $category)
                                <option @if ($course->category_id == $category->id) selected @endif
                                value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id')) 
                            <p class="text-danger">{{ $errors->first('category_id') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Course Description</label>
                        <textarea name="description" class="form-control" id="description">{{ $course->description }}</textarea>
                        @if ($errors->has('description')) 
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image">Course Image</label>
                        <p class="m-0 p-2">
                            <img src="{{ asset($course->image) }}" height="100" width="150" alt="...">
                        </p>
                        <input type="file" name="image" class="form-control-file" id="image">
                        @if ($errors->has('image')) 
                            <p class="text-danger">{{ $errors->first('image') }}</p>
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
