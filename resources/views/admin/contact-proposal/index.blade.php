@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3>Contact Proposal Submissions</h3>
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($contactProposals as $proposal)
                            <tr>
                                <td>{{ $proposal->id }}</td>
                                <td>{{ $proposal->first_name }}</td>
                                <td>{{ $proposal->last_name }}</td>
                                <td>{{ $proposal->email }}</td>
                                <td>{{ $proposal->message }}</td>
                                <td>{{ $proposal->created_at->format('d M Y h:i A') }}</td>
                                <td>
                                    <form action="{{ route('admin.contact-perposal.delete', $proposal->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this record?')">

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
                                <td colspan="5" class="text-center">
                                    No Records Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $contactProposals->links() }}

            </div>
        </div>

    </div>
@endsection
