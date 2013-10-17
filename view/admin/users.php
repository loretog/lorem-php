<script type="text">
	$("#add_user").click(function() {	
		alert("xxx");
		/*$.ajax({
			type: "POST"
			url: "<?php echo URL ?>/admin/add_user"
		});*/
	});
</script>
<div id="user_table">

</div>
<button onclick="show_msgbox('add_user', null)">Add New User</button>
<button onclick="load_user_table()">Refresh</button>