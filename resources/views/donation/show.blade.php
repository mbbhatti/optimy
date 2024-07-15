@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="missions-fundraisers my-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Missions and Fundraisers</h2>
                <div class="btn-group" role="group" aria-label="View mode">
                    <button type="button" class="btn btn-primary grid-view-btn">Grid View</button>
                    <button type="button" class="btn btn-secondary list-view-btn">List View</button>
                </div>
            </div>

            @if($missions->isNotEmpty() || $fundraisers->isNotEmpty())
                <div class="view-mode" id="grid-view">
                    <div class="row">
                        @foreach ($missions as $mission)
                            @include('missions.components.card', ['item' => $mission])
                        @endforeach
                        @foreach ($fundraisers as $fundraiser)
                            @include('missions.components.card', ['item' => $fundraiser])
                        @endforeach
                    </div>
                </div>
                <div class="view-mode d-none" id="list-view">
                    <div class="list-group">
                        @foreach ($missions as $mission)
                            @include('missions.components.list-item', ['item' => $mission])
                        @endforeach
                        @foreach ($fundraisers as $fundraiser)
                            @include('missions.components.list-item', ['item' => $fundraiser])
                        @endforeach
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    No missions or fundraisers found.
                </div>
            @endif
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.grid-view-btn').click(function () {
                $('#grid-view').removeClass('d-none');
                $('#list-view').addClass('d-none');
                $('.grid-view-btn').addClass('btn-primary').removeClass('btn-secondary');
                $('.list-view-btn').addClass('btn-secondary').removeClass('btn-primary');
            });

            $('.list-view-btn').click(function () {
                $('#grid-view').addClass('d-none');
                $('#list-view').removeClass('d-none');
                $('.list-view-btn').addClass('btn-primary').removeClass('btn-secondary');
                $('.grid-view-btn').addClass('btn-secondary').removeClass('btn-primary');
            });
        });
    </script>
@stop

