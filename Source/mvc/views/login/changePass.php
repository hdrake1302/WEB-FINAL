<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

  <!-- Bootstrap & Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- JS -->
  <script src="./main.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="./style.css" />

  <!-- Box Icons -->
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
          <!-- New password -->
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

          <!-- Confirm password -->
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

          <button data-toggle="modal" data-target="#myModal" type="submit" name="submit" class="btn btn-default btn-primary w-100" id="changePass-button">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>


  <!-- MODAL BOX -->
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <div class="errorText text-center text-white"></div>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>
        <div class="modal-footer">
          <div>
            <button type="button" id="modal-close" class="btn btn-secondary" data-dismiss="modal">
              Đóng
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>