<div class="form">
        <h1>Sign Up</h1>
<form  action="register" method="POST" id="form">
    <div class="form-input">
        <label for="username">Username</label>
        <input type="text" placeholder="username" name="username" id="username" autocomplete="username" required/>
        <div class="error"></div>
    </div>
    <div class="form-input">
        <label for="email">Email</label>
        <input type="text" placeholder="email address" name="email" id="email" autocomplete="email" required/>
        <div class="error"></div>
    </div>
    <div class="form-input">
        <label for="password">Password</label>
        <input type="password" placeholder="password" name="passwd" id="password" autocomplete="new-password" required/>
        <div class="error"></div>
    </div>
    <div class="form-input">
        <label for="password2">Confirm Password</label>
        <input type="password" placeholder="confirm password" name="passwd2" id="password2" autocomplete="new-password" required/>
        <div class="error"></div>
    </div>
    <input type="submit" name="submit" value="Register" />
</form>
already a user? <a href="/user/login">log in</a>
<script src="/public/js/registration_validator.js"></script>
</div>