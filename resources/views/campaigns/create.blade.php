@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Create Campaign</h1>

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <form action="{{ route('campaigns.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="goal_amount">Goal Amount</label>
                <input type="number" name="goal_amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image_url">Image</label>
                <input type="file" name="image_url" accept="image/*" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('profile') }}?activeTab=created-campaigns'">Cancel</button>
        </form>
    </div>
@endsection

