<div class="form">
<h1>Login</h1>
<form  action="login" method="POST">
    <div class="form-input">
        <label for="login">login</label>
        <input type="text" placeholder="username or email" name="username" id="username" autocomplete="email" required/><br />
    </div>
    <div class="form-input">
        <label for="password">Password</label>
        <input type="password" placeholder="password" name="passwd" id="password" autocomplete="current-password" required/><br />
    </div>   
    <input type="submit" name="submit" value="Login" />
    
</form>
<p>New user? <a href="/user/register">Sign up</a></p>
    <p><a href="/user/forgot">forgot password</a></p>
</div>
