@extends('admin.master')

@section('title', 'Contacts')

@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-light">Contact List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @php($i = 1)

                    @foreach ($contacts as $contact)
                        @if ($contact->status == 'pending')
                            <tr class="bg-warning text-dark">
                                <td>{{ $i++ }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->message }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.contact-reply-form', $contact->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fa fa-reply"></i> </a>
                                        <form action="{{ route('admin.contact-delete') }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{ $contact->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"> 
                                                <i class="fa fa-trash-alt"></i> 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->message }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.contact-reply-form', $contact->id) }}" class="btn btn-sm btn-primary mr-1"> <i class="fa fa-reply"></i> </a>
                                        <form action="{{ route('admin.contact-delete') }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{ $contact->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"> 
                                                <i class="fa fa-trash-alt"></i> 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>

@endsection