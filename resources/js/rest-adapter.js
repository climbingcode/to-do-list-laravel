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
