@extends('layouts.app')
@section('content')
<div class="container">
    <div class="parent">
        {!! Form::open(['route' => 'dashboard.users.store', 'method' => 'POST', 'files' => true, 'enctype' => "multipart/form-data"]) !!}
            @include('dashboard.users.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection
