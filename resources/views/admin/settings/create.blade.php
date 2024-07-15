@extends('layouts.admin')

@section('content')
    <div class="panel-heading">System Settings</div>
    <div class="panel-body">
        <div class="container">
            <h1>Add Setting</h1>
            <form action="{{ route('admin.settings.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="key">Key</label>
                    <input type="text" class="form-control" id="key" name="key" required>
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="text" class="form-control" id="value" name="value" required>
                </div>
                <button type="submit" class="btn btn-success">Add</button>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
