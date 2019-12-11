<div class="form">
    <h1>New Password</h1>

    <form action="/user/setnewpassword" method="POST" id="form">
    <div class="form-input" >
        <label for="password">New Password</label>
        <input type="password" placeholder="password" name="passwd" id="password" autocomplete="new-password" required />
        <div class="error"></div>
    </div>
    <div class="form-input">
        <label for="password2">Confirm Password</label>
        <input type="password" placeholder="confirm password" name="passwd2" id="password2" autocomplete="new-password" required />
        <div class="error"></div>
    </div>
        <input type="submit" name="submit" value="Reset" />
    </form>
</div>
<script src="/public/js/newpassword_validator.js"></script>