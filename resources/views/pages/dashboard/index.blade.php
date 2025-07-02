@extends('layouts.dashboard')

@section('content')
    <div class="asd">
        <h1>Selamat datang, {{ Auth::user()->fullname }}!</h1>
    </div>
@endsection