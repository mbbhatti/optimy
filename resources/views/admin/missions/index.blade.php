@extends('layouts.admin')

@section('content')
    <div class="panel-heading d-flex justify-content-between align-items-center">
        <div class="h4">
            Missions Management
            <a href="{{ route('missions.create') }}" class="btn btn-primary" style="float: right;">
                <i class="fa fa-plus"></i> Add New Mission
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Organization</th>
                    <th>Status</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($missions as $mission)
                    <tr>
                        <td>{{ $mission->title }}</td>
                        <td>{{ $mission->description }}</td>
                        <td>{{ $mission->goal_amount }}</td>
                        <td>{{ $mission->organization }}</td>
                        <td>{{ $mission->status }}</td>
                        <td style="width: 150px;">
                            <a href="{{ route('missions.edit', $mission->id) }}" class="btn btn-warning btn-sm" style="display: inline-block;">
                                Edit
                            </a>
                            <form action="{{ route('missions.destroy', $mission->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" style="display: inline-block;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $missions->links() }}
        </div>
    </div>
@endsection
