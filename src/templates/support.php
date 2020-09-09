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
                    <input type="text" class="form-control" id="name" placeholder="John Doe">
                    <div class="invalid-feedback">
                        Please tell us who you are.
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="3"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
        <div class="col-sm">
            <h3>Message history</h3>
        </div>
    </div>
</section>
