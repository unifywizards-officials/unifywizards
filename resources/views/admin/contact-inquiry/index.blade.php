@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3>Contact Inquiry Submissions</h3>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($contactInquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->id }}</td>
                                <td>{{ $inquiry->full_name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->phone }}</td>
                                <td>{{ $inquiry->subject }}</td>
                                <td>{{ $inquiry->message }}</td>
                                <td>{{ $inquiry->created_at->format('d M Y h:i A') }}</td>

                                <td>
                                    <form action="{{ route('admin.contact-inquiry.delete', $inquiry->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this inquiry?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    No Records Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $contactInquiries->links() }}
                </div>

            </div>
        </div>

    </div>
@endsection
