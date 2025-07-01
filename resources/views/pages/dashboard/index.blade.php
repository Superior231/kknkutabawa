@extends('layouts.dashboard')

@section('content')
    <div class="asd">
        <h1>Selamat datang, {{ Auth::user()->name }}!</h1>
    </div>
@endsection