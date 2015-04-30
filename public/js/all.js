// =============================
// REST ADAPTER
// =============================
	
var RestAdapter = {

	// GET
	index: function(route) {
		var deferred = $.Deferred();
		var ajax = this.ajaxRequest(route, 'GET');
		ajax.done(function(response) {
			deferred.resolve(response);
		});
		return deferred.promise();
	},
	show: function(route) {
		var deferred = $.Deferred();
		var ajax = this.ajaxRequest(route, 'GET');
		ajax.done(function(response) {
			deferred.resolve(response);
		});
		return deferred.promise();
	},
	edit: function(route) {
		var deferred = $.Deferred();
		var ajax = this.ajaxRequest(route, 'GET');
		ajax.done(function(response) {
			deferred.resolve(response);
		});
		return deferred.promise();
	},
	create: function(route) {
		var deferred = $.Deferred();
		var ajax = this.ajaxRequest(route, 'GET');
		ajax.done(function(response) {
			deferred.resolve(response);
		});
		return deferred.promise();
	},
	// POST
	store: function(route, data) {
		var deferred = $.Deferred();
		var ajax = this.ajaxRequest(route, 'POST', data);
		ajax.done(function(response) {
			deferred.resolve(response);
		});
		return deferred.promise();
	},
	// PUT
	update: function(route, data) {
		var deferred = $.Deferred();
		var ajax = this.ajaxRequest(route, 'PATCH', data);
		ajax.done(function(response) { 
			deferred.resolve(response);
		});
		return deferred.promise();
	},
	//DELETE 
	destroy: function(route) {
		var deferred = $.Deferred();
		var ajax = this.ajaxRequest(route, 'DELETE');
		ajax.done(function(response) { 
			deferred.resolve(response);
		});
		return deferred.promise();
	},
	// ajaxRequest METHOD
	ajaxRequest: function(route, method, data) {	
		var response;
		var deferred = $.Deferred();

		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});	

		var ajax = $.ajax({
			url: route,
			method: method,
			data: data,
			success: function(response) {
				deferred.resolve(response);	
			},
			error: function(response) {
				deferred.resolve({error: response.message, status: response.status});
			}
		});
	 	return deferred.promise();
	}
};

$(document).ready(function() {

	// =============================
	// BIND EVENTS 
	// =============================

	var bindEvents = (function() {

		// UPDATE A TASK TO BE COMPLETED
		$('.completed-task-switch').on('click', function() {

			var _this = $(this);
			var taskId = $(this).attr('data-taskId');
			var url = '/dev.todoparrot.com/public/tasks/' + taskId;

			RestAdapter.update(url).then(function(response) {
				changeTaskStatus(response.task, _this);
			});
			
		});

		// CREATE A NEW TASK
		$('#create-new-task').on('submit', function(e) {
			e.preventDefault();

			var data = {
				listId: $(this).find('#list-id').val(),
				name: $(this).find('#name').val(),
				description: $(this).find('#description').val()
			};

			var url = window.location.origin + '/dev.todoparrot.com/public/tasks';

			RestAdapter.store(url, data).then(function(response) {
				appendNewTask(response.task);
				addNoTasks();
				unbinder()		
				bindEvents();
			});

		});

		// DELETE TASK
		$('.remove-task').on('click', function() {

			var _this = $(this);
			var taskId = $(this).attr('data-taskId');
			var url = window.location.origin + '/dev.todoparrot.com/public/tasks/' + taskId;
			
			RestAdapter.destroy(url).then(function(response) {
				_this.parent().parent().remove();
				displayMessage(response.task.name + ' removed');
				addNoTasks();
			});
		
		});

		//SHOW ONLY USERS TASKS
		$('#usersLists').on('click', function() {

			var url = window.location.origin + '/dev.todoparrot.com/public/current_user_lists';

			RestAdapter.index(url).then(function(response) {
				onlyShowCurrentUserLists(response.lists);
			});
		});


		//sortable
		sortableList('/dev.todoparrot.com/public/sort-tasks');

	});

	bindEvents();


	// =============================
	// FUNCTIONS 
	// =============================

	function unbinder() {
		$('*').unbind();	
		$('#sortable').sortable('destroy');

	}

	function changeTaskStatus(task, $this) {
		if (task.done) {
			$this.find('#complete-task').hide();
			$this.find('#replace-task').show();
			$this.find('#replace-task').find('.text').text('Completed on: ' + task.updated_at);
			displayMessage(task.name + ' has been completed');
		} else {
			$this.find('#complete-task').show();
			$this.find('#replace-task').hide();
			displayMessage(task.name + ' status is now not completed');
		}			
	} 

	function appendNewTask(task) {
		
		$('#sortable').prepend('<li class="task-item">'
		+	'<div class="row">'
		+		'<span class="col-xs-1 glyphicon glyphicon-sort" data-taskId="' + task.id + '""></span>'
		+		'<h5 class="col-xs-4 ">' + task.name + '</h5>'		
		+		'<button class="remove-task col-xs-1 glyphicon glyphicon-remove" data-taskid=' + task.id + '></button>'
		+		'<div class="completed-task-switch col-xs-6" data-taskid=' +  task.id +'>'
		+			'<div id="replace-task" style="display: none;">'
		+				'<p class="col-xs-7 text">Completed on: ' + task.created_at + '</p>'
		+				'<div id="replace-task-icon" class="glyphicon glyphicon-wrench"></div>'
		+			'</div>'
		+			'<div id="complete-task" class="btn-mini glyphicon glyphicon-ok" data-taskid=' + task.id + ' style="display: inline-block;"></div>'
		+		'</div>'
		+	'</div>'
		+'</li>');

		displayMessage(task.name + ' has been created');

	} 

	function displayMessage(message) {

		$('.message').remove();

		$('body').append('<div class="message">'
		+	message	
		+'</div>');

		var $message = $('.message');

		setTimeout(function() {
			$message.fadeOut(200);
		}, 2000);
	}

	function addNoTasks() {
		$taskContainer = $('.tasks-container');

		if ($('.tasks-container').children().length === 0) {
			text = $('.list-title').text();
			$taskContainer.append('<p class="no-tasks-message">You have not created any tasks for ' + text + '! Just add one above...</p>');	
		} else {
			$('.no-tasks-message').remove();
		}
	}

	function sortableList(route) {

		var index;
		// SORT LIST ITEMS 
		$('#sortable').sortable({
			start: function(event, ui) {
				var start_pos = ui.item.index();
				ui.item.data('start_pos', start_pos);
			},
			change: function(event, ui) {
				var start_pos = ui.item.data('start_pos');
				index = ui.placeholder.index();
				if (start_pos < index) {
					$('#sortable li:nth-child(' + index + ')').addClass('highlights');
				} else {
					$('#sortable li:eq(' + (index + 1) + ')').addClass('highlights');
				}
			},
			update: function(event, ui) {
				taskOrder = [];

				$('#sortable li').removeClass('highlights');

				$('#sortable li').each(function(index, value) {
					taskOrder.push({
						taskId: $(value).attr('data-taskId'),
						order: index
					});
				});

				RestAdapter.update(route, {tasks: taskOrder}).then(function(response) {
					displayMessage(response.message);
				});

			}
		}).disableSelection();
	}

	var isOnlyCurrentUserLists = false;

	function onlyShowCurrentUserLists(userLists) {
		if (!isOnlyCurrentUserLists) {
			$('#listItems li').hide();
			for (var i = 0; i < userLists.length; i++) {
				var list = userLists[i];
				var match = $('#listItems').find('[data-listId="' + list.id + '"]');
				if (match) { match.show(); }
				isOnlyCurrentUserLists = true;
				$('#usersLists').text('Show all list items');
			}
		} else {
			$('#usersLists').text('Show my Lists Items Only');
			$('#listItems li').show();
			isOnlyCurrentUserLists = false;
		}
	}


});
//# sourceMappingURL=all.js.map