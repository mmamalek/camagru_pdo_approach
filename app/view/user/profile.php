<?php $user = $this->Array[0];?>
<div class="contents">
	<h1>Profile</h1>
	<p>Username :  <?php echo $user->username;?></p>
	<p>Email :  <?php echo $user->email;?></p>
	<p>Notification preferences: <?php echo ($user->notifications? 'Recieve likes and comments notifications via email': 'Don\'t recieve notifications');?></p>
	<p><a href="/user/edit">Edit profile</a></p>
	<p><a href="/user/changepassword">change password</a></p>
	<p><a href="/user/logout">log out</a></p>

</div>