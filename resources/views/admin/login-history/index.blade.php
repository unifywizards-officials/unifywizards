@extends('layouts.app')

@section('title', 'Login History')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Login History</h5>
        </div>
        <div class="card-body">

            <form method="GET" class="row g-2 mb-3">
                <div class="col-auto">
                    <select name="event" class="form-select form-select-sm">
                        <option value="">All events</option>
                        <option value="login" @selected(request('event') === 'login')>Login</option>
                        <option value="logout" @selected(request('event') === 'logout')>Logout</option>
                        <option value="failed" @selected(request('event') === 'failed')>Failed attempt</option>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="text" name="email" class="form-control form-control-sm" placeholder="Search email" value="{{ request('email') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    <a href="{{ route('admin.login-history.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>When</th>
                            <th>Event</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>IP Address</th>
                            <th>Device / Browser</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($history as $entry)
                            <tr>
                                <td>{{ $entry->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if ($entry->event === 'login')
                                        <span class="badge bg-success">Login</span>
                                    @elseif ($entry->event === 'logout')
                                        <span class="badge bg-secondary">Logout</span>
                                    @else
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                                <td>{{ $entry->user->name ?? '—' }}</td>
                                <td>{{ $entry->email ?? '—' }}</td>
                                <td>{{ $entry->ip_address ?? '—' }}</td>
                                <td class="text-truncate d-inline-block" style="max-width:320px;" title="{{ $entry->user_agent }}">
                                    {{ $entry->user_agent ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No login history yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $history->links() }}

        </div>
    </div>
</div>
@endsection
