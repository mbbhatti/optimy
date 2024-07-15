@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Edit Campaign</h1>

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $campaign->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $campaign->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="goal_amount">Goal Amount</label>
                <input type="number" name="goal_amount" class="form-control" value="{{ $campaign->goal_amount }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('profile') }}?activeTab=created-campaigns'">Cancel</button>
        </form>
    </div>
@endsection
