@extends('layouts.app')
@section('content')
<div class="container">
    <h1>User Details</h1>

    <div class="card">
        <div class="card-header">
            <strong>Name:</strong> {{ $user->name }}
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
        </div>
    </div>
</div>
@endsection
