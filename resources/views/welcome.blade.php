@extends('layouts.master') 

@section('content') 

<h1>
Welcome To My Awesome App
</h1>

{!! HTML::linkAction('ListController@index', 'Go To Lists') !!}

@endsection