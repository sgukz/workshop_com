<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.lumen.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200&display=swap" rel="stylesheet">
    <!-- Custom Stylesheet  -->
    <style>
        body {
            background-color: #CCC;
        }

        .section-login {
            margin-top: 30px;
        }
    </style>
    <!-- End Custom Stylesheet  -->
</head>

<body>
    <div class="container">
        <div class="row section-login">
            <div class="col-3"></div>
            <div class="col-6">
                <form id="form-login" method="post">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Login Form</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-title text-center text-primary">Please make username and password</div>
                            <div class="form-group">
                                <label for="username" class="form-control-label">USERNAME</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="username">
                                <div class="invalid-feedback">Sorry, that username taken. Try another?</div>
                                <div class="valid-feedback">Success! You've done it.</div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">PASSWORD</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="password">
                                <div class="invalid-feedback">Sorry, that password taken. Try another?</div>
                                <div class="valid-feedback">Success! You've done it.</div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success">Login</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>

        </div>
    </div>
</body>

<script src="assets/js/sweetalert2.js"></script>
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="src/functions/js/login.js"></script>
</html>