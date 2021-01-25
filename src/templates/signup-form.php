<div class="d-flex justify-content-center">
    <form method="post" action="/signup" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4">
            <h1 class="h3 my-4 font-weight-normal">Sign Up</h1>
        </div>

        <div class="form-label-group mb-3">
            <label for="inputUser">Username</label>
            <input type="text" name="username" id="inputUser" placeholder="Username"
                   class="form-control <?= isset($formError['username']) ? 'is-invalid' : ''; ?>"
                   value="<?= htmlentities($formUsername ?? '') ?>">
            <?php if (isset($formError['username'])) {
                echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['username']));
            } ?>
        </div>

        <div class="form-label-group mb-3">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" id="inputPassword" placeholder="Password"
                   class="form-control <?= isset($formError['password']) ? 'is-invalid' : ''; ?>">
            <?php if (isset($formError['password'])) {
                echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['password']));
            } ?>
        </div>

        <div class="form-label-group mb-3">
            <label for="inputPasswordVerify">Password verify</label>
            <input type="password" name="password" id="inputPasswordVerify" placeholder="Password verify"
                   class="form-control <?= isset($formError['password_verify']) ? 'is-invalid' : ''; ?>">
            <?php if (isset($formError['password'])) {
                echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['password']));
            } ?>
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign Up</button>

        <p class="mt-3">Already have an account? <a href="/login">Login here</a>.</p>
    </form>
</div>
