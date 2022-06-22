<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_ENV["APP_NAME"] ?></title>
    <link rel="shortcut icon" href="#">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Login to <?= $_ENV["APP_NAME"] ?></h1>
        <div class="row">
            <div class="col-6 offset-3">
                <div id="alert" class="alert alert-info alert-dismissible" role="alert">
                    <span id="alert-value"></span>
                    <button type="button" class="btn-close" onclick="window.history.pushState(null, null, '/login'); $('#alert').hide();">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form id="login">
                    <table class="table table-borderless">
                        <tr>
                            <td>Username</td>
                            <td><input class="form-control" type="text" name="username" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input class="form-control" type="password" name="password" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary mr-3">Login</button> <button type="button" class="btn btn-primary mr-3" onclick="$('#login')[0].reset();">Batal</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

    <script src="views/js/script.js"></script>
</body>
</html>