<div id="donation-history" class="content-section d-none">
    <div class="card mb-4">
        <div class="card-header">
            <h5>Donation History</h5>
        </div>
        <div class="card-body">
            @if($donations->isEmpty())
                <p>No donation history found.</p>
            @else
                <ul class="list-group">
                    @foreach($donations as $donation)
                        <li class="list-group-item">
                            <strong>Date:</strong> {{ $donation->created_at->format('M d, Y') }}<br>
                            <strong>Amount:</strong> ${{ $donation->amount }}<br>
                            <strong>Mission/Fundraiser:</strong>
                            @if($donation->mission)
                                {{ $donation->mission->title }}
                            @elseif($donation->campaign)
                                {{ $donation->campaign->title }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
