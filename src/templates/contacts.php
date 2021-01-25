<section class="my-5">
    <h1>Contacts</h1>
</section>
<section>
    <h2>Contacts list:</h2>

    <?php if ($contacts->rowCount() > 0) { ?>
        <table class="table">
            <?php while ($contact = $contacts->fetch()) { ?>
                <tr>
                    <th scope="row"><?= $contact['name'] ?></th>
                    <td><?= $contact['email'] ?></td>
                    <td><?= $contact['phone'] ?></td>
                    <td><?= $contact['address'] ?></td>
                    <td class="d-flex flex-column">
                        <a href="/contacts?edit=<?= $contact['id'] ?>">Edit</a>
                        <a href="/contacts?delete=<?= $contact['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No contacts</p>
    <?php } ?>
</section>
<section>
    <h2>Add contact:</h2>
    <form action="/contacts" method="post">
        <div class="form-row">
            <input type="hidden" name="id" value="<?= htmlentities($formData['id'])?>">
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input
                    type="text"
                    class="form-control <?= isset($formError['name']) ? 'is-invalid' : ''; ?>"
                    name="name"
                    id="inputName"
                    placeholder="Enter name"
                    value="<?= htmlentities($formData['name']) ?>"
                >
                <?php if (isset($formError['name'])) {
                    echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['name']));
                } ?>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPhone">Phone</label>
                <input
                    type="text"
                    class="form-control"
                    name="phone"
                    id="inputPhone"
                    placeholder="Enter phone"
                    value="<?= htmlentities($formData['phone']) ?>"
                >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input
                type="email"
                class="form-control <?= isset($formError['email']) ? 'is-invalid' : ''; ?>"
                id="inputEmail"
                name="email"
                placeholder="Enter email"
                value="<?= htmlentities($formData['email']) ?>"
            >
            <?php if (isset($formError['email'])) {
                echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['email']));
            } ?>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <textarea
                class="form-control"
                id="inputAddress"
                name="address"
                placeholder="1234 Main St"
            ><?= htmlentities($formData['address']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</section>
