@extends('layouts.admin')

@section('content')
    <div class="panel-heading">Missions Management</div>
    <div class="panel-body">
        <div class="container">
            <h1>Add Mission</h1>

            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <form action="{{ route('missions.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image_url">Image</label>
                    <input type="file" name="image_url" accept="image/*" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Mission</button>
                <a href="{{ route('missions.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

