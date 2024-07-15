@extends('layouts.admin')

@section('content')
    <div class="panel-heading">Dashboard</div>
    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title bold-title">Total Donations</h5>
                            <p class="card-text">$ {{ $totalDonations }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title bold-title">Active Missions</h5>
                            <p class="card-text">{{ $activeMissionsCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title bold-title">Active Fundraisers</h5>
                            <p class="card-text">{{ $activeFundraisersCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
