<div class="form">
        <h1>Sign Up</h1>
<form  action="register" method="POST">
    <div class="form-input">
        <label for="username">Username</label>
        <input type="text" placeholder="username" name="username" id="username" required/>
        <div class="error"></div>
    </div>
    <div class="form-input">
        <label for="email">Email</label>
        <input type="text" placeholder="email address" name="email" id="email" required/>
        <div class="error"></div>
    </div>
    <div class="form-input">
        <label for="password">Password</label>
        <input type="password" placeholder="password" name="passwd" id="password" required/>
        <div class="error"></div>
    </div>
    <div class="form-input">
        <label for="password2">Confirm Password</label>
        <input type="password" placeholder="confirm password" name="passwd2" id="password2" required/>
        <div class="error"></div>
    </div>
    <input type="submit" name="submit" value="Register" />
</form>
already a user? <a href="/user/login">log in</a>
</div>