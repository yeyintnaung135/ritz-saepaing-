@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-lg index-tables border-0 mt-5">
            @include('department._form',['title'=>'Department Create','create'=>true])
        </div>
    </div>
@endsection