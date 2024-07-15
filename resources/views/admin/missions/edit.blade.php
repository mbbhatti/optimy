@extends('layouts.admin')

@section('content')
    <div class="panel-heading">Missions Management</div>
    <div class="panel-body">
        <div class="container">
            <h1>Edit Mission</h1>

            <form action="{{ route('missions.update', $mission->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $mission->title }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" required>{{ $mission->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="goal_amount">Goal Amount</label>
                    <input type="number" name="goal_amount" class="form-control" value="{{ $mission->goal_amount }}" required>
                </div>
                <div class="form-group">
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" class="form-control" value="{{ $mission->organization }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ $mission->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $mission->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('missions.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

