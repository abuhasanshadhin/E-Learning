@extends('website.master')

@section('title', 'Lesson | '.ucfirst(str_slug($single_lesson->title)))

@section('content')

<div class="container my-4">
<div class="row">

    <div class="col-md-5 p-3" data-aos="fade-right">

        <div class="accordion" id="accordionExample">
            
            @foreach ($course->sections as $section)
                <div class="mb-2">
                    <div class="arrordion-btn p-1" id="heading_{{ $section->id }}">
                        <span class="btn" data-toggle="collapse" data-target="#collapse_{{ $section->id }}"
                            aria-expanded="true" aria-controls="collapse_{{ $section->id }}">
                            {{ $section->title }}
                        </span>
                    </div>
                    <div id="collapse_{{ $section->id }}" class="collapse {{ ($section_id == $section->id) ? 'show' : '' }}" aria-labelledby="heading_{{ $section->id }}"
                        data-parent="#accordionExample">
                        <ul class="list-group p-1">

                            @php($i = 1)

                            @foreach ($section->lessons as $lesson)
                                <li class="list-group-item {{ ($single_lesson->id == $lesson->id) ? 'lesson_active' : '' }}">
                                    <a href="{{ route('website.lesson', [$lesson->id, str_slug($lesson->title)]) }}">
                                        <div class="media lesson">
                                            <span> 
                                                {{ $i++ }} 
                                                @if ($single_lesson->id == $lesson->id)
                                                    <i class="fa fa-pause-circle text-success"></i>
                                                @else
                                                    <i class="fa fa-play-circle text-warning"></i>
                                                @endif
                                            </span>
                                            <div class="media-body ml-2">{{ $lesson->title }}</div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                <img src="{{ asset($course->image) }}" class="w-100" alt="">
            </div>

        </div>
    </div>

    <div class="col-md-7 p-3" data-aos="fade-left">

        <h5 class="mb-3 media">
            <span><i class="fa fa-pause-circle text-primary"></i></span> 
            <div class="media-body ml-2 c-heading">
                {{ $single_lesson->title }}
            </div>
        </h5><hr>

        @if (filter_var($single_lesson->video_url, FILTER_VALIDATE_URL))
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="{{ $single_lesson->video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        @else
            <img src="{{ asset('images/unavailable.jpg') }}" class="w-100" alt="">
        @endif
        
        <div class="clearfix my-2">
            @if ($previous != null)
                <a href="{{ route('website.lesson', [$previous->id, str_slug($previous->title)]) }}" class="btn btn-success btn-sm">
                    <i class="fa fa-arrow-left"></i> Previous
                </a>
            @endif
            @if ($next != null)
                <a href="{{ route('website.lesson', [$next->id, str_slug($next->title)]) }}" class="float-right btn btn-success btn-sm">
                    Next <i class="fa fa-arrow-right"></i>
                </a>
            @endif
        </div>

        <div class="text-justify p-3 mt-2 bg-light">
            {!! $single_lesson->description !!}
            {{ $single_lesson->source_code_url }}
        </div>

        <div class="comments">

            <h5 class="border-bottom pb-1 my-4 c-heading">

                {{-- Like --}}
                <a href="{{ route('website.add-like', $single_lesson->id) }}">
                    <i class="fa fa-thumbs-up"></i> {{ $total_likes }} &#8226; 
                    <span data-toggle="likers" data-placement="bottom" data-html="true" title="{{ $likers }}">
                        {{ ($is_liked) ? 'Unlike' : 'Like' }}
                    </span>
                </a>

                {{-- Comment --}}
                <span class="ml-2 mr-2">&#8226;</span> 
                <span class="text-muted">
                    <i class="fa fa-comment"></i> {{ $single_lesson->comments->count() }} Comments
                </span>

                {{-- View --}}
                <span class="ml-2 mr-2">&#8226;</span> 
                <span class="text-secondary">
                    <i class="fa fa-eye"></i> {{ $single_lesson->views->count() }} Views
                </span>

            </h5>

            <div class="media mb-4">

                @if (isset($user->profile->photo))
                    <img class="mr-3 rounded" src="{{ asset(optional($user->profile)->photo) }}" height="44"
                    width="44" alt="....">
                @else
                    <img class="mr-3 rounded" src="{{ asset('images/default.jpg') }}" height="44"
                    width="44" alt="....">
                @endif
                
                <div class="media-body">
                    @if ($errors->has('comment'))
                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                    @endif
                    {{-- comment form --}}
                    <form action="{{ route('website.comment') }}" method="post">
                        @csrf
                        <input type="hidden" name="lesson_id" value="{{ $single_lesson->id }}">
                        <textarea name="comment" id="editor1" rows="3" class="form-control" placeholder="Join the discussion"></textarea>
                        <input type="submit" value="Click to comment" class="btn btn-primary btn-block btn-sm mt-2">
                    </form>
                </div>
            </div>

            <!-- Comments -->
            @foreach ($single_lesson->comments->reverse() as $comment)
                <div class="media p-3 mt-2">

                    @if (isset($comment->user->profile->photo))
                        <img class="mr-3 rounded" src="{{ asset(optional($comment->user->profile)->photo) }}" height="44" width="44" alt="....">
                    @else
                        <img class="mr-3 rounded" src="{{ asset('images/default.jpg') }}" height="44"width="44" alt="....">
                    @endif
                    
                    <div class="media-body">

                        <p>
                            {{ $comment->comment }}
                            <button onclick="reply_text_box({{ $comment->id }})" class="btn btn-link float-right">
                                <i class="fa fa-reply"></i>
                            </button>
                        </p>

                        <div class="media" id="{{ $comment->id }}" style="display: none">
                            @if (isset($user->profile->photo))
                                <img class="mr-3 rounded" src="{{ asset(optional($user->profile)->photo) }}" height="44" width="44" alt="....">
                            @else
                                <img class="mr-3 rounded" src="{{ asset('images/default.jpg') }}" height="44"width="44" alt="....">
                            @endif
                            <div class="media-body mb-4">
                                {{-- comment reply form --}}
                                <form action="{{ route('website.comment-reply') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <textarea name="reply" id="editor1" rows="3" class="form-control" placeholder="Join the discussion"></textarea>
                                    <input type="submit" value="Click to reply" class="btn btn-info btn-block btn-sm mt-2">
                                </form>
                            </div>
                        </div>

                        <!-- Replies -->
                        @foreach ($comment->replies as $reply)
                            <div class="media py-1">
                                @if (isset(optional($reply->user->profile)->photo))
                                    <img class="mr-3 rounded" src="{{ asset($reply->user->profile->photo) }}" height="44" width="44" alt="....">
                                @else
                                    <img class="mr-3 rounded" src="{{ asset('images/default.jpg') }}" height="44"width="44" alt="....">
                                @endif
                                <div class="media-body">
                                    <p>{{ $reply->reply }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endforeach
           
        </div>

    </div>

</div>
</div>


<!-- Realated Courses -->
<div class="container my-3 my-5" data-aos="fade-up">
    <h1 class="title-lg">Related Courses</h1>

        <div class="owl-carousel owl-theme d-flex">

            @foreach ($related_course as $course_item)
                <div class="item">

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
                                        <a href="{{ route('website.rating', [$course->id, $i]) }}" class="rating {{ $color }} d-block">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
</div>
<!-- Realated Courses section end -->

@endsection

@push('js')

<script>
    // Owl carousel slider
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 2000,
        responsiveClass: true,
        responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 3,
            nav: false
        },
        1000: {
            items: 4,
            nav: true,
            loop: true
        }
        }
    });

    // User comment reply text box function
    function reply_text_box(id) {
        $('#' + id).slideToggle();
    }

    // view likers
    $(function () {
        $('[data-toggle="likers"]').tooltip()
    });
</script>

@endpush