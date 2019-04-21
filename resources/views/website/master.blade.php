<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/bootstrap/bootstrap.css">
    <!-- Owl carousel CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/font-awesome/all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title> @yield('title', 'Web Uni') </title>
  </head>
  <body>

    <!-- Page Preloder -->
    <div id="preloder">
      <div class="loader"></div>
    </div>
    
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg sticky navbar-dark nav-bg">
      <div class="container py-1">
        <a class="navbar-brand" href="{{ route('website.home') }}">
          <h3>WEB UNI</h3>
        </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item {{ (Request::route()->getName() == 'website.home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('website.home') }}">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item" id="category-nav-link">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent"
                  aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                  Categories
                </a>
              </li>
              <li class="nav-item {{ (Request::route()->getName() == 'website.about') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('website.about') }}">About</a>
              </li>
              <li class="nav-item {{ (Request::route()->getName() == 'website.contact') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('website.contact') }}">Contact</a>
              </li>
              @guest
                  @if (Route::has('register'))
                      <li class="nav-item {{ (Request::route()->getName() == 'register') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('register') }}"> Register </a>
                      </li>
                  @endif
              @else
                  <li class="nav-item active dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                          @if (Auth::user()->role == 'student')
                            <a class="dropdown-item" href="{{ route('user.profile') }}"> 
                              <i class="fa fa-user"></i> Profile 
                            </a>
                            <a class="dropdown-item" href="{{ route('user.change-password') }}"> 
                              <i class="fa fa-user-lock"></i> Change Password 
                            </a>
                          @endif

                          <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                              <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>

                      </div>
                  </li>
              @endguest
            </ul>
          </div>
      </div>
    </nav>
    <!-- navbar-end -->

    <!-- All categories -->
    <div class="pos-f-t">
      <div class="container">
        <div class="collapse" id="navbarToggleExternalContent">
          <div class="row p-2">
            
            @forelse ($categories as $category)
                <div class="col-md-3 my-2">
                    <a href="{{ route('website.courses-by-category', [$category->id, str_slug($category->title)]) }}" class="category-item">
                      <img src="{{ asset($category->image) }}" class="w-100" alt="...">
                      <div class="card-body">
                        {{ $category->title }}
                      </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                  <h5 class="text-center">
                    No categories found
                  </h5>
                </div>
            @endforelse
            
          </div>
        </div>
      </div>
    </div>
    <!-- All-categories-end -->

    
    {{-- content --}}
    @yield('content')


    <!-- join our community -->
    <div class="container my-3" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
      <h1 class="title-lg">Join Our Community Now!</h1>
      <p class="text-center text-muted col-md-10 offset-md-1">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        Itaque eos numquam distinctio asperiores odit aut voluptatem!
        Numquam magni fugiat harum natus vitae sint in perferendis.
      </p>
      <p class="text-center mt-4">
        <a href="{{ route('register') }}" class="btn-custom">Register Now</a>
      </p>
    </div>
    <!-- join our community end -->


    <!-- Big footer -->
    <div class="container-fluid mt-5 big-footer" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000">
      <div class="row mt-4">
        <div class="col-md-4 big-footer-item">
          <h4>Contact Info</h4>
          <ul>
            <li>1481 Creekside Lane Avila Beach, CA 931</li>
            <li>+53 345 7953 32453</li>
            <li>yourmail@gmail.com</li>
          </ul>
        </div>
        <div class="col-md-4 big-footer-item">
          <h4>WEB UNI</h4>
          <ul>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">News</a></li>
          </ul>
        </div>
        <div class="col-md-4 big-footer-item" id="news-letter">
          <h4>Newsletter</h4>
          <form action="{{ route('website.news-letter-subscribe') }}" method="post" class="ml-4 pr-5">
            @csrf
            
            <div class="form-group">
              <input type="email" name="email" id="" class="form-control p-3" placeholder="E-mail">
              @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group">
              <input type="submit" value="Subscribe" class="btn-custom">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Big footer end -->


    <!-- footer -->
    <div class="container-fluid footer">
      <p class="text-center m-0">Copyright &copy; WebUni - 2019</p>
    </div>
    <!-- footer end -->

    @if(Session::get('error'))
        <script>alert('{{ Session::get("error") }}')</script>
    @endif

    <!-- JavaScript -->
    <script type="text/javascript" src="{{ asset('assets') }}/jquery/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/bootstrap/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/owl-carousel/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
      AOS.init({
        duration: 2000,
      });
    </script>

    <script>
      $(function() {
        // Preloder
        $(".loader").fadeOut();
        $("#preloder").delay(400).fadeOut("slow");
      });

      $('#category-nav-link').click(function() {
        $('#category-nav-link').toggleClass('active');
      });
    </script>

    @stack('js')

  </body>
</html>