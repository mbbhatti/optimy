@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <aside class="col-md-3 mb-4">
                <div class="list-group" id="sidebar">
                    <button class="list-group-item list-group-item-action active" onclick="showContent('profile-information')" data-section="profile-information">Profile Information</button>
                    <button class="list-group-item list-group-item-action" onclick="showContent('donation-history')" data-section="donation-history">Donation History</button>
                    <button class="list-group-item list-group-item-action" onclick="showContent('created-campaigns')" data-section="created-campaigns">Created Campaigns</button>
                    <button class="list-group-item list-group-item-action" onclick="showContent('impact-tracking')" data-section="impact-tracking">Impact Tracking</button>
                </div>
            </aside>

            <div class="col-md-9">
                @include('user.sections.profile-information')
                @include('user.sections.donation-history')
                @include('user.sections.created-campaigns')
                @include('user.sections.impact-tracking')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/chart.js') }}"></script>
@endpush

@section('javascript')
    <script type="text/javascript">
        function showContent(sectionId) {
            const sections = document.querySelectorAll('.content-section');
            const buttons = document.querySelectorAll('#sidebar button');

            // Hide all sections
            sections.forEach(section => {
                section.classList.add('d-none');
            });

            // Deactivate all buttons
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Show the clicked section
            document.getElementById(sectionId).classList.remove('d-none');

            // Activate the clicked button
            document.querySelector(`#sidebar button[data-section="${sectionId}"]`).classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('donationImpactChart').getContext('2d');
            var donationData = @json($donationData);
            var labels = donationData.map(function (data) {
                return data.date;
            });
            var amounts = donationData.map(function (data) {
                return data.amount;
            });

            var donationImpactChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Donation Amount ($)',
                        data: amounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Check if there's an 'activeTab' parameter in the URL
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('activeTab');

            // If there's an activeTab parameter, show that section
            if (activeTab) {
                showContent(activeTab);
            }
        });
    </script>
@stop
