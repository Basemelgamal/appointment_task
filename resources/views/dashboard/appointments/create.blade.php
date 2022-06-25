@extends('layouts.app')
@section('content')
<div class="container">
    <div class="parent">
        {!! Form::open(['route' => 'dashboard.appointments.store', 'method' => 'POST']) !!}
            @include('dashboard.appointments.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection
