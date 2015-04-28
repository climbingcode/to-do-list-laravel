@extends('layouts.master')

@section('content')

	<h1>Contact Tom's To Do</h1>

	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

	{!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}

		<div class="form-group">
			{!! Form::label('Your Name') !!}
			{!! Form::text('name', null, array('required', 'class' => 'form-control', 'placeholder' => 'Name')) !!}
		</div>

		<div class="form-group">
			{!! Form::label('Your Email') !!}
			{!! Form::text('email', null, array('required', 'class' => 'form-control', 'placeholder' => 'Email')) !!}
		</div>

		<div class="form-group">
			{!! Form::label('Your Message') !!}
			{!! Form::text('message', null, array('required', 'class' => 'form-control', 'placeholder' => 'message')) !!}
		</div>

		<div clas="form-group">
			{!! Form::submit('Contact Us!', array('class' => 'btn btn-primary'))!!}
		</div>

	{!! Form::close() !!}

	{!! HTML::linkAction('ListController@index', 'Go Back To Lists') !!}

@endsection
