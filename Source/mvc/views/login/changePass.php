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
  <link rel="stylesheet" href="./assets/style/changePass.css" />
  <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
</head>

<body class="login-body">
  <button type="submit">
    <a href="?controller=login&action=logout">Log out</a>
  </button>
  <div class="
        container
        d-flex
        justify-content-center
        align-items-center
      " style="height: 100vh">
    <div class="
          row
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
        <img src="https://colorlib.com/etc/lf/Login_v1/images/img-01.png" alt="Change password image" class="d-none d-lg-block" />
      </div>
      <div class="col-sm-12 col-lg-8">
        <h2 class="text-center">Change password</h2>
        <form method="POST" action="?controller=changePass&action=changePassword">
          <div class="form-group">
            <label for="newPwd">New password:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="icon-newPwd">
                  <i class="bx bxs-lock-alt"></i>
                </span>
              </div>
              <input type="password" class="form-control" name="newPwd" id="newPwd" placeholder="New password" aria-label="New password" aria-describedby="icon-newPwd" />
            </div>
          </div>
          <div class="form-group">
            <label for="confirmPwd">Confirm password:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="icon-confirmPwd">
                  <i class="bx bxs-lock-alt"></i>
                </span>
              </div>
              <input type="password" class="form-control" name="confirmPwd" id="confirmPwd" placeholder="Confirm Password" aria-label="Confirm password" aria-describedby="icon-confirmPwd" />
            </div>
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