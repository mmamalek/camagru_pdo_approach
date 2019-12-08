<div class="contents">
<h1>New Password</h1>

<form  action="/user/setnewpassword" method="POST">
    <label for="password">New Password</label>
        <input type="password" placeholder="password" name="passwd" id="password" required/><br />
    <label for="password2">Confirm Password</label>
        <input type="password" placeholder="confirm password" name="passwd2" id="password2" required/><br />
    <input type="submit" name="submit" value="Reset" />
</form>
</div>