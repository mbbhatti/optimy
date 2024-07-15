@extends('layouts.admin')

@section('content')
    <div class="panel-heading">Fundraisers Management</div>
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
                    <th>Goal Amount</th>
                    <th>Status</th>
                    <th style="width: 200px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->title }}</td>
                        <td>{{ $campaign->description }}</td>
                        <td>{{ $campaign->goal_amount }}</td>
                        <td>{{ ucfirst($campaign->status) }}</td>
                        <td>
                            <form id="updateStatusForm_{{ $campaign->id }}" action="{{ route('admin.campaigns.updateStatus', $campaign->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')

                                <div class="input-group mb-3">
                                    <select id="status_{{ $campaign->id }}" name="status" class="form-select" onchange="confirmStatusUpdate({{ $campaign->id }}, '{{ $campaign->status }}')">
                                        <option value="active" {{ $campaign->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $campaign->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="approved" {{ $campaign->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="denied" {{ $campaign->status == 'denied' ? 'selected' : '' }}>Deny</option>
                                        <option value="pending" {{ $campaign->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $campaigns->links() }}
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        function confirmStatusUpdate(campaignId, initialStatus) {
            if (confirm("Are you sure you want to update the status?")) {
                $('#updateStatusForm_' + campaignId).submit();
            } else {
                $('#status_' + campaignId).val(initialStatus);
            }
        }
    </script>
@stop
