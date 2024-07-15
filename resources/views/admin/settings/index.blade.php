@extends('layouts.admin')

@section('content')
    <div class="panel-heading d-flex justify-content-between align-items-center">
        <div class="h4">
            System Settings
            <a href="{{ route('admin.settings.create') }}" class="btn btn-primary" style="float: right;">
                <i class="fa fa-plus"></i> Add Setting
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($settings as $setting)
                    <tr>
                        <td>{{ $setting->key }}</td>
                        <td>{{ $setting->value }}</td>
                        <td><a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-primary">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
