<div class="col-md-4 mb-4">
    <div class="card">
        <img class="card-img-top" src="{{ $item->image_url }}" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
        <div class="card-body">
            <h5 class="card-title">{{ $item->title }}</h5>
            <p class="card-text">{{ Str::words($item->description, 5, '...') }}</p>

            @isset($item->organization)
                <p><small class="text-muted">Organization: {{ $item->organization }}</small></p>
            @endisset

            @isset($item->user)
                <p><small class="text-muted">Creator: {{ $item->user->name }}</small></p>
            @endisset

            <p class="card-text"><small class="text-muted">Goal Amount: ${{ $item->goal_amount }}</small></p>

            @php
                $totalDonations = $item->donations->sum('amount');
                $goalAmount = $item->goal_amount;
                $progressPercentage = ($goalAmount > 0) ? ($totalDonations / $goalAmount) * 100 : 0;
            @endphp
            <div class="progress mb-2">
                <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                     aria-valuenow="{{ $totalDonations }}" aria-valuemin="0" aria-valuemax="{{ $goalAmount }}">
                </div>
            </div>

            <a href="{{ route('donate.' . ($item->organization ? 'missions' : 'fundraiser') . '.show', ['id' => $item->id]) }}"
               class="btn btn-primary">Donate</a>
        </div>
    </div>
</div>

