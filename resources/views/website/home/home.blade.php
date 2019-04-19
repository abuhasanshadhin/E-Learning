@extends('website.master')

@section('title', 'Home')

@section('content')

    <!-- home page header with login form -->
    <div class="home-header mb-4" data-aos="zoom-in">

        <h1 data-aos="fade-right">Get The Best Free Online Courses</h1>

        <p class="col-md-8 offset-md-2 mb-5" data-aos="fade-left">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos et ex, molestias dolorum porro assumenda nihil quae. Voluptates labore ab at animi minima? Reprehenderit natus est possimus omnis ducimus minus impedit ratione, fuga optio fugiat adipisci sit sed expedita harum repellat consectetur quos! Quod ducimus, labore incidunt obcaecati quia eaque?
        </p>

        @if (Session::get('auth-message'))
            <p class="bg-danger p-2 text-light mt-4 col-md-6 offset-md-3">
              {{ Session::get('auth-message') }}
            </p>
        @endif

        @guest
            <form method="POST" action="{{ route('login') }}" class="mt-5">
              @csrf
              
              <div class="row">
                <div class="col-md-10 offset-md-1">
                  <div class="row">
                    <div class="col-md-5">
                      <input type="email" name="email" value="{{ old('email') }}" id="" class="input-custom" placeholder="E-mail">
                      @if ($errors->has('email'))
                          <p class="bg-danger p-2 text-light">{{ $errors->first('email') }}</p>
                      @endif
                    </div>
                    <div class="col-md-5">
                      <input type="password" name="password" id="" class="input-custom" placeholder="Password">
                      @if ($errors->has('password'))
                          <p class="bg-danger p-2 text-light">{{ $errors->first('password') }}</p>
                      @endif
                      <p class="text-left">
                        <a href="{{ route('password.request') }}" class="text-warning">Forgot Your Password?</a>
                      </p>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn-custom"> Login </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
        @else
            <p class="bg-success p-2 my-5 text-light col-6 offset-3">
              You are logged in!
            </p>
        @endguest
    </div>
    <!-- home page header end -->

    <!-- courses cards -->
    <div class="container">

      <h1 class="title-lg" data-aos="zoom-in">Featured Courses</h1>
      <p class="text-center text-muted col-md-8 offset-md-2" data-aos="zoom-in">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Itaque eos numquam distinctio asperiores odit aut voluptatem!
        Numquam magni fugiat harum natus vitae sint in perferendis illum accusamus expedita quis, 
        quos hic nostrum nihil! Tempore harum quisquam sit reprehenderit cumque ipsa!
      </p>

      <div class="row">

          @foreach ($courses as $course)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 p-3" data-aos="zoom-in">
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
          @endforeach

      </div>

      <div class="clearfix">
        <div class="float-right p-3">
          {{ $courses->links() }}
        </div>
      </div>

    </div>
    <!-- courses-cards-end -->

@endsection

@push('js')
    @include('website.includes.course-rating-js')
@endpush