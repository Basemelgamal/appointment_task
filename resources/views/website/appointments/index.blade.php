@extends('layouts.app')
@section('content')
<div class="container">
    <div class="parent">
        @foreach ($appointments as $appointment)
        <div class="col-12 mt-3">
            <div class="card text-center">
                <div class="card-header">
                    Appointment
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $appointment->reason }}</h5>
                </div>
                <div class="card-footer text-muted">
                    {{ $appointment->appointment }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
