@extends('layouts.admin')

@section('content')
    <div class="panel-heading">System Settings</div>
    <div class="panel-body">
        <div class="container">
            <h1>Edit Setting</h1>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="key">Key</label>
                    <input type="text" class="form-control" id="key" name="key" value="{{ $setting->key }}" readonly>
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="text" class="form-control" id="value" name="value" value="{{ $setting->value }}">
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
