@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="d-flex align-items-start mb-3">
            <img src="{{ asset($mission->image_url) }}" alt="{{ $mission->title }}" class="w-25 mr-3 border border-primary">
            <div>
                <h2>Donate to {{ $mission->title }}</h2>
                <p>{{ $mission->description }}</p>
                <div>
                    <p class="mb-1">Goal Amount: ${{ $mission->goal_amount }}</p>
                    <div class="progress-wrapper mb-2">
                        <label class="mb-0 mr-2">Progress:</label>
                        <progress value="{{ $mission->donations->sum('amount') }}" max="{{ $mission->goal_amount }}"></progress>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <h3 class="text-center">Mission Donation Form</h3>

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('donate.missions.create', $mission->id) }}">
            @csrf
            <div class="form-group">
                <label for="amount">Select Amount:</label>
                <div>
                    <label><input type="radio" name="amount" value="10"> $10</label>
                    <label><input type="radio" name="amount" value="20"> $20</label>
                    <label><input type="radio" name="amount" value="50"> $50</label>
                    <label><input type="radio" name="amount" value="custom"> Custom</label>
                </div>
                <input type="number" class="form-control mt-2" id="custom_amount" name="custom_amount" placeholder="Enter custom amount" min="1" style="display:none;">
            </div>
            <div class="form-group">
                <label>Donation Type:</label>
                <div>
                    <label><input type="radio" name="is_recurring" value="0" checked> One-time</label>
                    <label><input type="radio" name="is_recurring" value="1"> Recurring</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="payment_method">Payment Method:</label>
                    <select class="form-control" id="payment_method" name="payment_method">
                        <option value="credit_card">Credit Card</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="card_number">Card Number:</label>
                    <input type="text" class="form-control" id="card_number" name="card_number">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="text" class="form-control" id="expiry_date" name="expiry_date">
                </div>
                <div class="col-sm-6">
                    <label for="cvv">CVV:</label>
                    <input type="text" class="form-control" id="cvv" name="cvv">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Donate</button>
            <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('donations') }}'">Cancel</button>
        </form>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        document.querySelectorAll('input[name="amount"]').forEach((elem) => {
            elem.addEventListener("change", function(event) {
                if (event.target.value === 'custom') {
                    document.getElementById('custom_amount').style.display = 'block';
                } else {
                    document.getElementById('custom_amount').style.display = 'none';
                }
            });
        });
    </script>
@stop
