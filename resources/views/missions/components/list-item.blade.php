<div class="list-group-item">
    <a href="#" class="list-group-item-action">
        <img src="{{ asset($item->image_url) }}" alt="{{ $item->title }}">
    </a>
    <div class="item-details">
        <h5>{{ $fundraiser->title }}</h5>
        <p>{{ Str::words($fundraiser->description, 5, '...') }}</p>

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
