@extends('admin.master')

@section('title', 'Reply')

@section('content')

    <div class="row">
        <div class="card shadow col-lg-6 offset-md-3">
            <div class="p-4">

                <h4 class="text-center font-weight-light">Reply</h4><hr>

                <form method="POST" action="{{ route('admin.contact-reply') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $contact->name }}" class="form-control form-control-user" id="name" readonly>
                        @if ($errors->has('name')) 
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" value="{{ $contact->email }}" class="form-control form-control-user" id="email" readonly>
                        @if ($errors->has('email')) 
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ $contact->phone }}" class="form-control form-control-user" id="phone" readonly>
                        @if ($errors->has('phone')) 
                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="reply">Reply</label>
                        <textarea name="reply" class="form-control form-control-user" placeholder="Type your reply...." id="reply"></textarea>
                        @if ($errors->has('reply')) 
                            <p class="text-danger">{{ $errors->first('reply') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            <i class="fa fa-reply"></i> Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection