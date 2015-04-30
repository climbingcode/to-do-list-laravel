@extends('layouts.master')

	@section('content')

	<h1 class="col-xs-12 col-md-8 col-md-offset-2">To Do List</h1>

	<div class="container col-xs-12 col-md-8 col-md-offset-2">
		{!! HTML::linkAction('ListController@create', 'Create a list item') !!}
		{!! HTML::linkAction('AboutController@create', 'Contact us') !!}
		<button id="usersLists" class="btn btn-success">Show my Lists Items Only</button>
	</div>

	@if ($lists->count() > 0)
		<ul id="listItems">
			@foreach ($lists as $list)
				<li class="container col-xs-12 col-md-8 col-md-offset-2" data-listId='{{$list->id}}'> 
					<div class="well">
						<h3><strong>{!! HTML::linkAction('ListController@show', $list->name, $list->id) !!}</strong></h3>
						@if ($list->user)  
							Created by {{$list->user->name}}
						@endif 
						<h4>{{ $list->description }}</h4>
						<p><em>This item was created on {{ $list->created_at }}</em></p>
						{!! Form::open(array('route' => array('lists.destroy', $list->id), 'method' => 'delete')) !!}
							<button type="submit" class="glyphicon glyphicon-remove"></div>
						{!! Form::close() !!}
					</div>
				</li>
			@endforeach
		</ul>
		{!! $lists->render() !!}
	@else 
		<h2>Sorry there are no tasks at the Mo!</h2>
	@endif 

@endsection
