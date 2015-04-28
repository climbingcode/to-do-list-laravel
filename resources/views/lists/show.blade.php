@extends('layouts.master')

@section('content')
	<section id="lists-show-wrapper">

		<div class="well">				
			<div class="row">
				<div class="col-xs-4">
					
					<div class="container col-xs-12">
						<h2 class="col-xs-8 list-title">{{ $list->name }}</h2>
						{{-- EDIT LIST ITEM --}}
						<div class="list-title-links">
							{!! HTML::linkAction('ListController@edit', '', $list->id, array('class' => 'col-xs-2 btn btn-success glyphicon glyphicon-pencil')) !!}

							{{-- DELETE LIST ITEM --}}
							{!! Form::open(array('route' => array('lists.destroy', $list->id), 'method' => 'post')) !!}
								<button type="submit" class="col-xs-2 btn btn-danger glyphicon glyphicon-trash"></button>
							{!! Form::close() !!}
						</div>
					</div>	
					<div class="container col-xs-12">	
						<h4>{{ $list->description }}</h4>
						<h5><em>Created On: {{ $list->created_at }}</em></h5>	
						{!! HTML::linkAction('ListController@index', 'Go Back To Lists') !!}	
					</div>
				</div>			

				{{-- ADD A NEW TASK --}}
				@if (Auth::guest())
					<div class="container col-xs-8">
						<h5><a href={{ url('/auth/login')}}>Login</a> or <a href={{url('/auth/register')}}>Signup</a> to add a task</h5>
					</div>
				@else
				<div class="container col-xs-8">
					<h4>Add A New Task</h4>
					<form id="create-new-task" class="form">
						<div class="form-group container">
							<input type="hidden" name="listId" id="list-id" value={{$list->id}}></input>
						</div>

						<div class="form-group container">
							<input name="name" id="name" type="text" class="form-control" placeholder="name"></input>
						</div>

						<div class="form-group container">
							<input name="description" id="description" type="text" class="form-control" placeholder="description"></input>
						</div>

						<div class="form-group container">
							<button class="btn btn-primary">Create a task for {{$list->name}}</button>
						</div>
					</form>
				</div>
				@endif 
			</div>
		</div>
		
		<div class="container">

			{{-- ITERATE OVER ITEMS --}}
			<h3 class="container-fluid">Tasks</h3>
			<ul class="tasks-container col-xs-12" id="sortable">
				@if ($list->tasks->count() > 0) 
					@foreach ($list->tasks as $task) 
						<li class="task-item" data-taskId="{{$task->id}}">
							<div class="row">
								<span class="col-xs-1 glyphicon glyphicon-sort"></span>
								<h5 class="col-xs-4 {{ $task->done ? 'done' : '' }}">{{ $task->name }}</h5>
								{{-- REMOVE TASK --}}
								<button class="remove-task col-xs-1 glyphicon glyphicon-remove" data-taskId="{{$task->id}}"></button>
								{{-- UPDATE TASK --}}
								@if ($task->done)
									<div class="completed-task-switch col-xs-6" data-taskId="{{ $task->id }}">
										<div id="replace-task">
											<p class="col-xs-7 text">Completed on {{ $task->updated_at }}</p>
											<div id="replace-task-icon" class="col-xs-1 glyphicon glyphicon-wrench"></div>
										</div>
										<div id="complete-task" style="display: none;" class="btn-mini glyphicon glyphicon-ok"></div>
									</div>
								@else 
									<div class="completed-task-switch col-xs-6" data-taskId="{{ $task->id }}">
										<div id="replace-task" style="display: none;">
											<p class="col-xs-7 text">Completed on {{ $task->updated_at }}</p>
											<div id="replace-task-icon" class="col-xs-1 glyphicon glyphicon-wrench"></div>
										</div>
										<div id="complete-task" class="btn-mini glyphicon glyphicon-ok" data-taskId="{{ $task->id }}"></div>
									</div>
								@endif 
							</div>
						</li>
					@endforeach
				@else 
					<p class="no-tasks-message">
						You have not created any tasks for {{ $list->name }}! Just add one above...
					</p>
				@endif 
			</ul>
		</div>
	</section>

@endsection
