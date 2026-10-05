@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3>Blog Form Submissions</h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service</th>
                            <th>Blog Reference</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($forms as $form)
                            <tr>
                                <td>{{ $form->id }}</td>
                                <td>{{ $form->name }}</td>
                                <td>{{ $form->email }}</td>
                                <td>{{ $form->phone }}</td>
                                <td>{{ $form->service }}</td>
                                <td>{{ $form->blog_ref }}</td>
                                <td>{{ $form->message }}</td>
                                <td>{{ $form->created_at->format('d M Y h:i A') }}</td>

                                <td>
                                    <form action="{{ route('admin.blog.forms.delete', $form->id) }}" method="POST"
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
                                <td colspan="8" class="text-center">
                                    No Records Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $forms->links() }}
                </div>

            </div>
        </div>

    </div>
@endsection
