@extends('website.master')

@section('title', 'Course | '.ucfirst(str_slug($course->title)))

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 p-4">

                <h5 class="media" data-aos="fade-right">
                    <span><i class="fa fa-play-circle text-primary"></i></span>
                    <div class="media-body ml-2 c-heading">
                        {{ $course->title }}
                    </div>
                </h5> <hr>

                <div class="row">
                    <div class="col-md-5 py-3 pl-0 pr-0" data-aos="fade-right">
                        <img src="{{ asset($course->image) }}" class="w-100" alt="">
                    </div>
                    <div class="col-md-7 p-3 text-justify" data-aos="fade-left">
                        {!! $course->description !!}
                    </div>
                </div>
                <div class="accordion" id="accordionExample">

                    @forelse ($course->sections as $section)
                        <div class="mb-2" data-aos="fade-up">
                            <div class="arrordion-btn p-1" id="heading_{{ $section->id }}">
                                <span class="btn" data-toggle="collapse" data-target="#collapse_{{ $section->id }}"
                                    aria-expanded="true" aria-controls="collapse_{{ $section->id }}">
                                    {{ $section->title }}
                                </span>
                            </div>
                            <div id="collapse_{{ $section->id }}" class="collapse show" aria-labelledby="heading_{{ $section->id }}"
                                data-parent="#accordionExample">
                                <ul class="list-group p-1">

                                    @php($i = 1)

                                    @foreach ($section->lessons as $lesson)
                                        <li class="list-group-item">
                                            <a href="{{ route('website.lesson', [$lesson->id, str_slug($lesson->title)]) }}">
                                                <div class="media lesson">
                                                    <strong> {{ $i++ }} <i class="fa fa-play-circle text-warning"></i> </strong>
                                                    <div class="media-body ml-2">{{ $lesson->title }}</div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                    @empty
                        <h4 class="text-center text-primary">Coming soon</h4>
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>

@endsection