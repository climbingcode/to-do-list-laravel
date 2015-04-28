@extends('layouts.master')

	@section('content')

	<h1 class="col-xs-12 col-md-8 col-md-offset-2">To Do List</h1>

	<div class="container col-xs-12 col-md-8 col-md-offset-2">
		{!! HTML::linkAction('ListController@create', 'Create a list item') !!}
		{!! HTML::linkAction('AboutController@create', 'Contact us') !!}
	</div>

	@if ($lists->count() > 0)
		<ul>
			@foreach ($lists as $list)
				<div class="col-xs-12 col-md-8 col-md-offset-2"> 
					<div class="well">
						<h3><strong>{!! HTML::linkAction('ListController@show', $list->name, $list->id) !!}</strong></h3>
						<h4>{{ $list->description }}</h4>
						<p><em>This item was created on {{ $list->created_at }}</em></p>
						{!! Form::open(array('route' => array('lists.destroy', $list->id), 'method' => 'delete')) !!}
							<button type="submit" class="glyphicon glyphicon-remove"></div>
						{!! Form::close() !!}
					</div>
				</div>
			@endforeach
		</ul>

		{!! $lists->render() !!}
	@else 
		<h2>Sorry there are no tasks at the Mo!</h2>
	@endif 

@endsection
