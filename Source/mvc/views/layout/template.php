<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>

<style>

    .alert{
        max-width: 500px;
        margin: auto;
    }
</style>
<a href="?controller=login&action=logout">Log out</a>

<div class="container">
    <h3 class="text-primary mt-3">Student Management using Ajax</h1>
    <div class="row">
        <div class="col-md-3">
            <form class="form-horizontal w-100">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="phone">Phone:</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter phone">
                </div>

                <div class="form-group">
                    <button type="button" id="add-student" class="btn btn-success">Add</button>
                    <button type="submit" id="update-student" class="btn btn-warning disabled">Update</button>
                </div>
            </form>


        </div> <!-- Col 1 -->
        <div class="col-md-9 mt-2">

            <?= $content ?>
            
        </div> <!-- col 2-->
    </div>


    <br><br>
    <div style="display: none" id="success-message" class="alert alert-success alert-dismissable ">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Delete student success.
    </div>
    <br>
    <div style="display: none" id="failure-message" class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed!</strong> An unknown eror occured. Please try again later.
    </div>

</div>


<!-- Confirm Removal Modal -->
<div class="modal fade" id="confirm-removal-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Xóa sinh viên</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa sinh viên <strong id="producer-name">My Tam</strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete-button" class="btn btn-danger" data-dismiss="modal">Xóa</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
            </div>
        </div>

    </div>
</div><!-- Confirm Removel modal -->


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./js/exercise4.js"></script>
</html>
