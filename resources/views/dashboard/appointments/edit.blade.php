@extends('layouts.app')
@section('content')
<div class="container">
    <div class="parent">
        {{--  @dd($leave)  --}}
        {!! Form::model($appointment ,['route' => ['dashboard.appointments.update', $appointment->id], 'method' => 'PUT']) !!}
            @include('dashboard.appointments.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection
