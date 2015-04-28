@extends('layouts.master')

@section('content')

<h2>Edit {{ $list->name }}</h2>

	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

	{!! Form::model($list, array('method' => 'put', 'route' => ['lists.update', $list->id], 'class' => 'form')) !!}
		
		<div class="form-group">
			{!! Form::label('Edit List Name') !!}
			{!! Form::text('name', null, array('required', 'class' => 'form-control', 'placeholder' => 'Add new list name')) !!}
		</div>

		<div class="form-group">
			{!! Form::label('Edit Description') !!}
			{!! Form::text('description', null, array('required', 'class' => 'form-control', 'placeholder' => 'Please enter a description')) !!}
		</div>


		<div class="form-group">
			{!! Form::submit('Edit '. $list->name, array('class' => 'btn btn-success')) !!}
		</div>

	{!! Form::close() !!}

@endsection