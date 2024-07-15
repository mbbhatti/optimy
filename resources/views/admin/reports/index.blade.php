@extends('layouts.admin')

@section('content')
    <div class="panel-heading">Analytics and Reports</div>
    <div class="panel-body">
        <div class="container">
            <form action="{{ route('admin.reports.generate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </form>

            @isset($donationsData)
                <div class="mt-4">
                    <h2>Report Summary</h2>

                    <div class="report-columns">
                        <div class="column">
                            <h3>Donations</h3>
                            <p><strong>Total Donations:</strong> ${{ number_format($donationsData['total'], 2) }}</p>
                            <p><strong>Average Donation:</strong> ${{ number_format($donationsData['average'], 2) }}</p>
                            <p><strong>Total Number of Donations:</strong> {{ $donationsData['count'] }}</p>
                        </div>

                        <div class="column">
                            <h3>User Engagement</h3>
                            <p><strong>Total Donations Made:</strong> {{ $engagementData['userEngagement'] }}</p>
                            <p><strong>Active Users (in selected period):</strong> {{ $engagementData['activeUsers'] }}</p>
                        </div>

                        <div class="column">
                            <h3>Platform Performance</h3>
                            <p><strong>Total Users:</strong> {{ $performanceData['total_users'] }}</p>
                            <p><strong>Active Missions:</strong> {{ $performanceData['active_missions'] }}</p>
                            <p><strong>Active Fundraisers:</strong> {{ $performanceData['active_fundraisers'] }}</p>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
