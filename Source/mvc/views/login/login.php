<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <!-- Latest compiled and minified CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://localhost/WEB-FINAL/Source/mvc/assets/style/login.css" />
  </head>
  <body>
    <div
      class="
        container container-login
        d-flex
        flex-sm-row
        justify-content-center
        align-items-center
      "
    >
      <div
        class="
          row
          wrap-login
          flex-md-row
          shadow-lg
          bg-white
          rounded
          justify-content-center
          align-items-center
          p-5
        "
      >
        <div class="text-center col-sm-12 col-lg-4">
          <img
            src="https://colorlib.com/etc/lf/Login_v1/images/img-01.png"
            alt="Login image"
            class="login-img"
          />
        </div>
        <div class="col-sm-12 col-lg-8">
          <h2 class="text-center">Login</h2>
          <form method="POST" action="?controller=login&action=login">
            <div class="form-group">
              <label for="email">Username:</label>
              <input
                type="text"
                class="form-control"
                placeholder="Enter your username:"
                name="username"
                id="username"
              />
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input
                type="password"
                class="form-control"
                placeholder="Enter your password"
                name="password"
                id="password"
              />
            </div>
            <div class="checkbox">
              <label><input type="checkbox" /> Remember me</label>
            </div>
            <button type="submit" name="submit" class="btn btn-default btn-primary w-100">
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
