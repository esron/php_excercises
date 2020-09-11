<section class="my-5">
    <h1>Welcome, <?= $username ?>!</h1>
</section>
<section class="container">
    <h2 class="my-5">Support Area</h2>
    <?php if (isset($formError['form'])) { ?>
        <div class="alert alert-danger" role="alert"><?= $formError['form']; ?></div>
    <?php } ?>
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
                <input type="hidden" name="csrf-token" value="<?= $formCsrfToken ?>">
                <button class="btn btn-primary" type="submit" value="get-support" name="do">Submit form</button>
            </form>
        </div>
        <div class="col-sm">
            <h3>Message history</h3>
            <?php if (empty($sentForms)) {
                echo '<p>No messages are found.</p>';
            } else {
                foreach ($sentForms as $item) { ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-text"><?= htmlentities($item['form']['message']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <strong>Added:</strong> <?= htmlentities($item['timeAdded']) ?></h6>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <strong>Reply-to:</strong> <?= sprintf('%s &lt;%s&gt;', htmlentities($item['form']['name']), htmlentities($item['form']['email'])) ?>
                            </h6>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</section>
