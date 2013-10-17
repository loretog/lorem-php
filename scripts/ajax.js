$(function() {
	$("#program_id option").click(function() {	
		var id = $(this).val();
		if(id == "") return false;
		var path = URL + "/year_levels/get_year_levels/option/" + id;		
		get_content("#year_level_id", path);
	});
});

$(document).ready(function() {
	load_user_table();
});

function load_user_table() {
	var table;
	$.ajax({
		url: URL + "/admin/load_user_table",
		success: function(data) {
			$("#user_table").html(data);
		}
	});
}

function get_content(id, url) {
	$.ajax({
		url: url,
		success: function(data) {			
			$(id).html(data);
		}
	});
}

function show_msgbox(request, passedData) {
	var msgbox = document.getElementById("msgbox");
	msgbox.style.display = "block";
	if(request == 'payments') {
		$.ajax({
			type: "POST",
			url: URL + "/payments/ajax_history",
			data: passedData,
			success: function(response) {
				$("#msgbox_content").html(response);
			}
		});
	} else if(request == 'grades') {
		$.ajax({
			type: "POST",
			url: URL + "/student_grades/ajax_view",
			data: passedData,
			success: function(response) {
				$("#msgbox_content").html(response);
			}
		});
	} else if(request == 'add_user') {				
			var form = "<table class='msgbox_table' style='margin: 0 auto; width: 80%;'>" +
									"<tr>" +
										"<td>Group</td>" +
										"<td>" + 
										"<select id='group_id' name='group_id'>" +
										"<option value='1'>Administrator</option>" +
										"<option value='2'>Registrar</option>" +
										"<option value='3'>Cashier</option>" +
										"<option value='4'>Teacher</option>" +
										"</select>" +
										"</td>" +
									"</tr>" +
									"<tr>" +
										"<td>Username</td>" +
										"<td><input id='username' name='username' value='' type='text' /></td>" +
									"</tr>" +
									"<tr>" +
										"<td>Last Name</td>" +
										"<td><input id='lastname' name='lastname' value='' type='text' /></td>" +
									"</tr>" +
									"<tr>" +
										"<td>First Name</td>" +
										"<td><input id='firstname' name='firstname' value='' type='text' /></td>" +
									"</tr>" +
									"<tr>" +
										"<td>Email</td>" +
										"<td><input id='email' name='email' value='' type='text' /></td>" +
									"</tr>" +
									"<tr>" +
										"<td>Send Profile to Email?</td>" +
										"<td><input type='checkbox' checked='checked' id='send' name='send' value='1' /></td>" +
									"</tr>" +
									"<tr>" +
										"<td>Temporary Password</td>" +
										"<td><input id='password' name='password' value='' type='text' /></td>" +
									"</tr>" +
									"<tr>" +											
										"<td colspan='2'><input id='add_user' value='Add User' type='submit' onclick='add_new_user()' /></td>" +
									"</tr>" +
								"</table>";			
		$("#msgbox_content").html(form);
	}
}
function hide_msgbox() {
	var msgbox = document.getElementById("msgbox").style.display = "none";		
	var msgbox = document.getElementById("msgbox_content").innerHTML = "";
}
function add_new_user() {	
	var d = "group_id=" + $("#group_id").val() + "&username=" + $("#username").val() + "&lastname=" + $("#lastname").val() + "&firstname=" + $("#firstname").val() + "&email=" + $("#email").val() + "&send=" + $("#send").val() + "&password=" + $("#password").val();	
	$.ajax({
		type: "POST",
		url: URL + "/admin/add_new_user/",
		data: d,
		success: function(data) {
			if(data)
				$("#msgbox_error").html(data)
			else {
				load_user_table();
				hide_msgbox();
			}
		}
	});
}