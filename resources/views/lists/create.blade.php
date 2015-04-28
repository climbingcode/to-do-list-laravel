@extends('layouts.master')

@section('content')

<section id="createList">
	


	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="well">

					<h3>Create a new list item</h3>

					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>

					{!! Form::open(array('route' => 'lists.store', 'class' => 'form-horizontal')) !!}
						
						<div class="form-group container">
							{!! Form::label('List Name') !!}
							{!! Form::text('name', null, array('required', 'class' => 'form-control', 'placeholder' => 'Please enter the list name')) !!}
						</div>

						<div class="form-group container">
							{!! Form::label('Description') !!}
							{!! Form::text('description', null, array('required', 'class' => 'form-control', 'placeholder' => 'Please enter a description')) !!}
						</div>

						<div class="form-group container">
							{!! Form::submit('Create a list item', array('class' => 'btn btn-primary btn-sucess'))!!}
						</div>

					{!! Form::close() !!}

					<a>{!! HTML::linkAction('ListController@index', 'Go Back To Lists') !!}</a>
				</div>
			</div>
		</div>
	</div>

</div>

@stop