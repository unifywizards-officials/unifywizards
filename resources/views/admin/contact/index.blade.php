@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3>Contact</h3>
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
                        @forelse($contact as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->full_name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->subject }}</td>
                                <td>{{ $value->message }}</td>
                                <td>{{ $value->created_at->format('d M Y h:i A') }}</td>

                                <td>
                                    <form action="{{ route('admin.contact.delete', $value->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this contact?')">

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
                    {{ $contact->links() }}
                </div>

            </div>
        </div>

    </div>
@endsection