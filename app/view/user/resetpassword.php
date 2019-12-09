<div class="form">
    <h1>Reset Password</h1>
<form  action="/user/changepassword" method="POST" id="form">
    <div class="form-input">
        <label for="password">Old Password</label>
        <input type="password" placeholder="old password" name="passwd" id="password" autocomplete="old-password" required/>
        <div class="error"></div>
    </div>

    <div class="form-input">
        <label for="password">New Password</label>
        <input type="password" placeholder="password" name="passwdnew" id="password-new" autocomplete="new-password" required/>
        <div class="error"></div>
    </div>
    <div class="form-input">
        <label for="password2">Confirm Password</label>
        <input type="password" placeholder="confirm password" name="passwdnew2" id="password-new2" autocomplete="new-password" required/>
        <div class="error"></div>
    </div>
    <input type="submit" name="submit" value="Change Password" />
</form>
</div>
<script src="/public/js/resetPassword_validator.js"></script>