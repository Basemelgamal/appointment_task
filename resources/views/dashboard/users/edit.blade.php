@extends('layouts.app')
@section('content')
<div class="container">
    <div class="parent">
        {!! Form::model($user ,['route' => ['dashboard.users.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
            @include('dashboard.users.form')
        {!! Form::close() !!}
    </div>
</div>
@endsection
