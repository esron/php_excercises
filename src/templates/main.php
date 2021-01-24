<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo($title ?? '(no title)'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Learning PHP</a>

        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['username'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/support">Support</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                <?php } ?>
            </ul>
            <?php if (isset($_SESSION['username'])) { ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </nav>
    <main class="container">
        <?php if (isset($content)) {
            echo $content;
        } else { ?>
            <div class="jumbotron">
                <h1 class="display-4">Hello!</h1>
                <p class="lead">
                    <a href="/signup">Sign up</a> to start creating your contacts list.
                </p>
                <p>
                    Already have an account? <a href="/login">Login here</a>.
                </p>
            </div>
        <?php } ?>
    </main>
</body>
</html>
