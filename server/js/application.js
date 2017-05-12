/**
 * Application Javascript Code
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 * @copyright	(c) 2016 Jonas Tomanga
 */

$(function () {
    /* add new intersection */
    $(document).on("click", "#addInt", function () {
	url = "/api/add";
	var data = {
	    minorStreet: $("#minorStreet").val(),
	    majorStreet: $("#majorStreet").val(),
	    latitude: $("#latitude").val(),
	    longitude: $("#longitude").val(),
	    phases: $("#phases").val(),
	    ways: $("#ways").val()
	};
	$.post(url, data, function (data, status, jqXHR) {
	    if (data.code === 1) {
		$("#addModal .modal-content").html("<i class='fa fa-2x fa-thumbs-up'></i>"
			+ "<span class='h3'>Intersection Created with ID: " + data.intID + "</span>"
			+ "<br/> <div class='modal-footer'>"
			+ "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div>");
	    }
	}, "json");
    });
    /* edit intersection */
    $(document).on("click", "#EditInt", function () {
	url = "/api/edit/" + $(this).attr("data-id");
	var data = {
	    minorStreet: $("#minorStreet").val(),
	    majorStreet: $("#majorStreet").val(),
	    latitude: $("#latitude").val(),
	    longitude: $("#longitude").val(),
	    phases: $("#phases").val(),
	    ways: $("#ways").val()
	};
	$.post(url, data, function (data, status, jqXHR) {
	    if (data.code === 1) {
		$("#EditModal .modal-content").html("<i class='fa fa-2x fa-thumbs-up'></i> "
			+ "<span class='h3'>Intesection Updated!</span>"
			+ "<br/><div class='modal-footer'><center>"
			+ "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button></center></div>");
	    }
	}, "json");
    });

    /* remove intersection */
    $(document).on("click", "#remove", function () {
	$("#DeleteModal .modal-content").html("<i class='fa fa-circle-o-notch fa-2x fa-spin'></i> "
		+ "<span class='h3'>Removing intersection</span>");
	url = "/api/remove/" + $("#delete").attr("data-id");
	var data = {
	};
	$.post(url, data, function (data, status, jqXHR) {
	    if (data.code === 1) {
		$("#DeleteModal .modal-content").html("<i class='fa fa-2x fa-thumbs-up'></i> "
			+ "<span class='h3'>Intersection Removed!</span>"
			+ "<br/><div class='modal-footer'><center>"
			+ "<button type='button' class='btn btn-primary' data-dismiss='modal' id='removed'>Close</button></center></div>");
	    }
	}, "json");

    });

    $(document).on("click", "#removed", function () {
	window.location = "/intersections/";
    });

    /**
     * User Section
     */
    /* edit user info */
    $(document).on("click", "#EditUser", function () {
	url = "/api/useredit/" + $(this).attr("data-id");
	var data = {
	    username: $("#username").val(),
	    fname: $("#fname").val(),
	    sname: $("#sname").val(),
	    password: $("#password").val(),
	    password2: $("#password2").val()
	};
	$.post(url, data, function (data, status, jqXHR) {
	    if (data.code === 1) {
		$("#UserEditModal .modal-content").html("<i class='fa fa-2x fa-thumbs-up'></i> "
			+ "<span class='h3'>User Updated!</span>"
			+ "<br/><div class='modal-footer'><center>"
			+ "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button></center></div>");
	    } else {
		$("#UserEditModal .modal-content").html("<i class='fa fa-2x fa-thumbs-down'></i> "
			+ "<span class='h3'>User not updated!</span>"
			+ "<p>" + data.msg
			+ "<br/><div class='modal-footer'><center>"
			+ "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button></center></div>");

	    }
	}, "json");
    });

    /* remove intersection */
    $(document).on("click", "#remove-user", function () {
	$("#UserDeleteModal .modal-content").html("<i class='fa fa-circle-o-notch fa-2x fa-spin'></i> "
		+ "<span class='h3'>Removing user</span>");
	url = "/api/userremove/" + $("#delete").attr("data-id");
	var data = {
	};
	$.post(url, data, function (data, status, jqXHR) {
	    if (data.code === 1) {
		$("#UserDeleteModal .modal-content").html("<i class='fa fa-2x fa-thumbs-up'></i> "
			+ "<span class='h3'>User Removed!</span>"
			+ "<br/><div class='modal-footer'><center>"
			+ "<button type='button' class='btn btn-primary' data-dismiss='modal' id='removed-user'>Close</button></center></div>");
	    }
	}, "json");

    });

    $(document).on("click", "#removed-user", function () {
	window.location = "/users";
    });

    $(document).on("click", "#AddUser", function () {
	url = "/api/useradd";
	var data = {
	    username: $("#username").val(),
	    fname: $("#fname").val(),
	    sname: $("#sname").val(),
	    password: $("#password").val(),
	    password2: $("#password2").val()
	};
	$.post(url, data, function (data, status, jqXHR) {
	    if (data.code === 1) {
		$("#UserAddModal .modal-content").html("<i class='fa fa-2x fa-thumbs-up'></i>"
			+ "<span class='h3'>User added successfully</span>"
			+ "<br/> <div class='modal-footer'>"
			+ "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div>");
	    } else {
		$("#UserAddModal .modal-content").html("<i class='fa fa-2x fa-thumbs-down'></i> "
			+ "<span class='h3'>User not added!</span>"
			+ "<p>" + data.msg
			+ "<br/><div class='modal-footer'><center>"
			+ "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button></center></div>");

	    }
	}, "json");
    });

    $(document).on("click", "#AddAcc", function () {
	url = "/api/accadd";
	var data = {
	    street: $("#street").val(),
	    latitude: $("#latitude").val(),
	    longitude: $("#longitude").val(),
	    description: $("#description").val()
	};
	$.post(url, data, function (data, status, jqXHR) {
	    if (data.code === 1) {
		$("#AccAddModal .modal-content").html("<i class='fa fa-2x fa-thumbs-up'></i>"
			+ "<span class='h3'>Accident report successful</span>"
			+ "<br/> <div class='modal-footer'>"
			+ "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div>");
	    } else {
		$("#AccAddModal .modal-content").html("<i class='fa fa-2x fa-thumbs-down'></i> "
			+ "<span class='h3'>Accident not reported!</span>"
			+ "<p>" + data.msg
			+ "<br/><div class='modal-footer'><center>"
			+ "<button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button></center></div>");

	    }
	}, "json");
    });

});
