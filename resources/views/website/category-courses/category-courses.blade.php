@extends('website.master')

@section('title', 'Category Courses')

@section('content')

    <div class="container my-4">

      <h4 class="text-center p-2">
        Category : 
        <span class="font-weight-light pb-1">{{ $course_name }}</span>
      </h4><hr>

      <div class="row">

        @forelse ($courses as $course)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 p-3" style="display: table-cell">
              <div class="card h-100">
                <a href="{{ route('website.course', [$course->id, str_slug($course->title)]) }}">
                  <div class="start-course-button">Start Course</div>
                </a>
                <img src="{{ asset($course->image) }}" height="200" class="card-img-top" alt="...">
                <div class="card-body course">
                  <h5 class="media-heding text-center">{{ $course->title }}</h5>
                  <span class="text-justify">
                    {!! text_short($course->description, 100).'</p>' !!}
                  </span>
                </div>
                <div class="p-1 border">
                  <ul class="list-inline m-0 ml-2">

                    @php($color='')

                    @php($ratings = round($course->ratings->avg('rate')))

                    @for ($i = 1; $i <= 5; $i++)
                      @if ($i <= $ratings)
                        @php($color = 'text-warning')
                      @else
                        @php($color = 'text-dark')
                      @endif
                      <li class="list-inline-item" title="{{ 'Rating : '.$i }}">
                        @if (Auth::check())
                            <a href="{{ route('website.rating', [$course->id, $i]) }}" class="rating {{ $color }} d-block" id="{{ $course->id.'-'.$i }}" data-cid="{{ $course->id }}" data-index="{{ $i }}" data-ratings={{ $ratings }}>
                              <i class="fa fa-star"></i>
                            </a>
                        @else
                            <i class="fa fa-star {{ $color }}" onclick="alert('Please Login/Register first')"></i>
                        @endif
                      </li>
                    @endfor
                  </ul>
                </div>
              </div>
            </div>
        @empty
            <div class="col-12 text-center mt-5">
                <span class="text-danger">Courses not found</span>
            </div>
        @endforelse

      </div>

      <div class="clearfix">
        <div class="float-right p-3">
          {{ $courses->links() }}
        </div>
      </div>

    </div>

@endsection

@push('js')
    @include('website.includes.course-rating-js')
@endpush