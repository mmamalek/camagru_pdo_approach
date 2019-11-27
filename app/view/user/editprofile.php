<?php  
$user = $this->Array[0];
echo($user->notifications);

?>

<div class="form">
<h1>Update profile</h1>
<form  action="edit" method="POST">
	<?php // echo (isset($_SESSION['edit_error']) ? $_SESSION['edit_error']: ''); ?>
	<div class="form-input">  
    	<label for="username">Username</label>
        <input type="text" placeholder="username" value='<?php echo "$user->username"; ?>' name="username" id="username" required/><br />
		<div class="error"><?php echo $_SESSION['edit_error_username']; unset($_SESSION['edit_error_username']); ?></div>
	</div>
	<div class="form-input">  
        <label for="email">Email</label>
      	<input type="text" placeholder="email address" value='<?php echo $user->email; ?>' name="email" id="email" required/><br />
		  <div class="error"><?php echo $_SESSION['edit_error_email']; unset($_SESSION['edit_error_email']); ?></div>
	</div>
	<div class="form-input-radio">  
		<p>Do you want to recieve notifications when someone likes or comment on your photos?</p>
		<input type="radio" name="notifications" value="1" id="yes" <?php echo ($user->notifications? "checked" : "") ?> required/><label for="yes">Yes</label><br />
		<input type="radio" name="notifications" value="0" id="no" <?php echo (!$user->notifications? "checked" : "") ?>  required/><label for="no">No</label><br />
	</div>
		<input type="submit" name="submit" value="Update" />
</form>
</div>