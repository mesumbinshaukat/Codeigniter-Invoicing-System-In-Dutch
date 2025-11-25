<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>Admin Login</h1>
                <p>Welkom terug</p>
            </div>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-error">
                    <?= session('error') ?>
                </div>
            <?php endif ?>

            <form action="<?= base_url('admin/authenticate') ?>" method="post" class="login-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Gebruikersnaam of E-mail</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Inloggen</button>
            </form>
        </div>
    </div>
</body>
</html>
