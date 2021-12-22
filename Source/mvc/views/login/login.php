<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="./assets/style/style.css" />

  <!-- Boxicon Icons -->
  <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />

</head>

<body class="login-body">
  <div class="
        container
        d-flex
        justify-content-center
        align-items-center
      " style="height: 100vh;">
    <div class="
          row
          flex-md-row
          shadow-lg
          bg-white
          rounded
          justify-content-center
          align-items-center
          w-100
          h-75
          p-5
        ">
      <div class="text-center col-sm-12 col-lg-4">
        <img src="https://colorlib.com/etc/lf/Login_v1/images/img-01.png" alt="Login image" class="login-img d-none d-lg-block w-100" />
      </div>
      <div class="col-12 col-lg-8">
        <h2 class="text-center">Login</h2>
        <form method="POST" action="?controller=login&action=login">
          <div class="form-group">
            <label for="username">Username:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="icon-username">
                  <i class="bx bxs-user"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" aria-label="Username" aria-describedby="icon-username" />
            </div>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="icon-password">
                  <i class="bx bxs-lock-alt"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="password" id="password" placeholder="Password" aria-label="Username" aria-describedby="icon-password" />
            </div>
          </div>
          <div class="mb-2 float-right"><a href="#">Forgot password?</a></div>
          <button type="submit" name="submit" class="btn btn-default btn-primary w-100">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>