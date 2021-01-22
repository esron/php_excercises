<section class="my-5">
    <h1>Welcome, <?= $username ?>!</h4>
</section>
<section>
    <h2>Your profile:</h2>
    <table class="table">
        <tbody>
            <tr>
                <th scope="row">Username:</th>
                <td><?= $username ?></td>
            </tr>
            <tr>
                <th scope="row">Signup date:</th>
                <td><?= $signUpDate ?></td>
            </tr>
            <tr>
                <th scope="row">Last login:</th>
                <td><?= $loginTime ?></td>
            </tr>
        </tbody>
    </table>
</section>
