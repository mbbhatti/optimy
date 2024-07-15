@extends('layouts.layout')

@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="search-bar my-4">
            <form action="{{ url('/') }}" method="GET">
                <input type="text" name="search" placeholder="Search missions and fundraisers" class="form-control"
                       value="{{ request('search') }}">
            </form>
        </div>

        <div class="featured my-4">
            <h2>Featured Missions and Fundraisers</h2>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($featuredItems as $key => $featuredItem)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <div class="carousel-image-container">
                                <img class="d-block w-100" src="{{ asset($featuredItem['image_url']) }}"
                                     alt="{{ $featuredItem['title'] }}">
                            </div>
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $featuredItem['title'] }}</h5>
                                <p>{{ Str::words($featuredItem['description'], 5, '') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

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

