<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Burma Camp Computer Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="logo.jpg">
</head>

<body class="body-login">
    <div class="black-fill"><br /> <br />
        <div class="d-flex justify-content-center align-items-center flex-column">
            <form class="login"
                  method="post"
                  action="">
                <div class="text-center">
                    <img src="logo.jpg" width="100">
                </div>
                <h3>LOGIN</h3>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Login As</label>
                    <select class="form-control">
                        <option value="1">Admin</option>
                        <option value="2">Student</option>
                        <option value="3">Teacher</option>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="index.php" class="text-decoration-none">Home</a>
            </form>

            <br /><br />
            <div class="text-center text-light">
                Copyright &copy; 2023 Burma Camp Computer Center. All right reserved.
            </div>



        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>