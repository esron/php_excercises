<section class="my-5">
    <h1>Welcome, <?= $username ?>!</h1>
</section>
<section class="container">
    <h2 class="my-5">Support Area</h2>
    <div class="row">
        <div class="col-sm">
            <h3>Contact Form</h3>
            <form action="/support" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        class="form-control <?= isset($formError['name']) ? 'is-invalid' : ''; ?>"
                        id="name"
                        name="name"
                        placeholder="John Doe"
                        value="<?= htmlentities($formName ?? '') ?>"
                    >
                    <?php if (isset($formError['name'])) {
                        echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['name']));
                    } ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        class="form-control <?= isset($formError['email']) ? 'is-invalid' : ''; ?>"
                        id="email"
                        name="email"
                        placeholder="name@example.com"
                        value="<?= htmlentities($formEmail ?? '') ?>"
                    >
                    <?php if (isset($formError['email'])) {
                        echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['email']));
                    } ?>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea
                        class="form-control <?= isset($formError['message']) ? 'is-invalid' : ''; ?>"
                        id="message"
                        name="message"
                        rows="3"
                    ></textarea>
                    <?php if (isset($formError['message'])) {
                        echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['message']));
                    } ?>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
        <div class="col-sm">
            <h3>Message history</h3>
        </div>
    </div>
</section>
