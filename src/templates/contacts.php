<section class="my-5">
    <h1>Contacts</h1>
</section>
<section>
    <h2>Contacts list:</h2>

    <p>No contacts</p>
</section>
<section>
    <h2>Add contact:</h2>
    <form action="/contact" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Enter name">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="Enter phone">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Enter email"></textarea>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <textarea class="form-control" id="inputAddress" placeholder="1234 Main St"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</section>
