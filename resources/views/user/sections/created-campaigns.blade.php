<div id="created-campaigns" class="content-section d-none">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Created Campaigns</h5>
            <a href="{{ route('campaigns.create') }}" class="btn btn-primary">New Campaign</a>
        </div>
        <div class="card-body">
            @if($campaigns->isEmpty())
                <p>No campaigns created.</p>
            @else
                <ul class="list-group">
                    @foreach($campaigns as $campaign)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $campaign->title }}
                            <div>
                                <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('campaigns.delete', $campaign->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
