<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/profile.png" />
    <link rel="stylesheet" href="css/app.css">

    <title>Login | SI Pencatatan Barang</title>

</head>

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <img src="assets/profile.png" alt="" class="logo" />
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>Login Akun</header>
                        @if (session('welcome'))
                            <div class="alert alert-success">
                                Berhasil Logout
                            </div>
                        @endif
                        <form action="login" method="get">
                            <div class="input-field">
                                <input type="text" class="input" name="username" id="username" required
                                    autocomplete="off" />
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field">
                                <input type="password" name="password" class="input" id="password" required />
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field">
                                <button type="submit" class="submit" name="login">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
