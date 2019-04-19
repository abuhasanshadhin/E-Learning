@extends('website.master')

@section('title', 'Contact')

@section('content')

    <div class="container my-5">
        
        <form action="{{ route('website.send-contact-message') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <h3 class="title-lg mb-3">Get in Touch</h3>

                    @if (Session::get('message'))
                        <p class="alert alert-success text-center">
                            {{ Session::get('message') }}
                        </p>
                    @endif

                    <div class="form-group">
                        <input type="text" name="name" id="" placeholder="Your name" class="input-custom" autofocus>
                        @if ($errors->has('name')) 
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="" placeholder="Your E-mail" class="input-custom">
                        @if ($errors->has('email')) 
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" id="" placeholder="Your Phone" class="input-custom">
                        @if ($errors->has('phone')) 
                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <textarea name="message" id="" rows="4" placeholder="Your message write here" class="input-custom"></textarea>
                        @if ($errors->has('message')) 
                            <small class="text-danger">{{ $errors->first('message') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-custom">Send Message</button>
                    </div>
                </div>
                <div class="col-md-4 offset-md-2" data-aos="fade-left">

                    <h1 class="mb-3 font-weight-light">Contact Info</h1>

                    <p class="text-muted">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Doloremque obcaecati illum magni repudiandae in debitis
                        quas autem illo amet velit.
                    </p>

                    <h5 class="mt-5">Direct Line</h5>
                    <h2>+53 345 7953 32453</h2><hr>

                    <ul class="mt-5">
                        <li>1481 Creekside Lane Avila Beach, CA 931</li>
                        <li>+53 345 7953 32453</li>
                        <li>yourmail@gmail.com</li>
                    </ul>

                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-dribbble"></i></a>
                        <a href="#"><i class="fab fa-behance"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>

                </div>
            </div>
        </form>

    </div>

    <div class="container mb-5" data-aos="zoom-out-right">
        <iframe class="w-100" style="min-height: 300px" src="https://maps.google.com/maps?q=mirpur%2010&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                scrolling="no" marginheight="0" marginwidth="0">
        </iframe>
    </div>
    
@endsection