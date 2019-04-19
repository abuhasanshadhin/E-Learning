@extends('admin.master')

@section('title', 'Edit Category')

@section('content')

    <div class="row">
        <div class="card col-lg-6 offset-md-3">
            <div class="p-4">

                <h4 class="text-center font-weight-light">Edit Category</h4><hr>

                <form method="POST" action="{{ route('admin.update-category') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <input type="hidden" name="id" value="{{ $category->id }}">

                    <div class="form-group">
                        <label for="title">Category Name</label>
                        <input type="text" name="title" value="{{ $category->title }}" class="form-control form-control-user" id="title">
                        @if ($errors->has('title')) 
                            <p class="text-danger">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image">Category Image</label>
                        <p><img src="{{ asset($category->image) }}" alt="..."></p>
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