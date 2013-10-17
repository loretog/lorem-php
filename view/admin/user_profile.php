<script type="text/javascript">
  $(document).ready(function() {
    $("#update_profile").click(function() {
      $.ajax({
        type: "POST",
        url: "<?php echo URL ?>/admin/update_profile",
        data: "id=<?php echo $_SESSION['admin_id'] ?>&username=" + $("#username").val() + "&lastname=" + $("#lastname").val() + "&firstname=" + $("#firstname").val(),
        success: function(data) {          
          $(".error_msg1").html(data);
        }
      });
    });
    
    $("#update_password").click(function() {
      $.ajax({
        type: "POST",
        url: "<?php echo URL ?>/admin/update_password",
        data: "id=<?php echo $_SESSION['admin_id'] ?>&cur_pwd=" + $("#cur_pwd").val() + "&new_pwd=" + $("#new_pwd").val() + "&confirm_pwd=" + $("#confirm_pwd").val(),
        success: function(data) {
          $(".error_msg2").html(data);
					$(".pwd").val("");
        }
      });
    });
  });
</script>
<style type="text/css">
   .error_msg1, .error_msg2 { float: right; width: 30%; text-align: right; color: red; }
</style>
<table class="grid" style="width: 80%; margin: 0 auto;">
  <?php while($p = $profile->fetch_object()) : ?>
  <tr class="ghead">
    <td colspan="2">Profile</td>
  </tr>
  <tr>
    <td style="width: 20%;">Group:</td>
    <td><?php echo $p->name; ?></td>
  </tr>
  <tr>
    <td>Username: </td>
    <td><input id="username" type="text" value="<?php echo $p->username; ?>" /></td>
  </tr>
  <tr>
    <td>First Name</td>
    <td><input id="firstname" type="text" value="<?php echo $p->firstname ?>" /></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input id="lastname" type="text" value="<?php echo $p->lastname ?>" /></td>
  </tr>
  <tr>
    <td colspan="2" class="controls">
      <input id="update_profile" type="submit" value="Update Profile" />
      <span class="error_msg1"></span>
    </td>
  </tr>
  <tr class="ghead">
    <td colspan="2">Change Password</td>
  </tr>
  <tr>
    <td>Current Password: </td>
    <td><input id="cur_pwd" class="pwd" name="cur_pwd" type="password" value="" /></td>
  </tr>
  <tr>
    <td>New Password: </td>
    <td><input id="new_pwd" class="pwd" name="new_pwd" type="password" value="" /></td>
  </tr>
  <tr>
    <td>Confirm Password: </td>
    <td><input id="confirm_pwd" class="pwd" name="confirm_pwd" type="password" value="" /></td>
  </tr>
  <tr>
    <td colspan="2" class="controls">
      <input id="update_password" type="submit" value="Update Password" />
      <span class="error_msg2"></span>
    </td>
  </tr>
  <?php endwhile; ?>
</table>