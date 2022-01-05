 <div class="container-fluid">
     <div class="row">
         <div class="col-12 col-md-10 offset-md-1">
             <div class="profile-info">
                 <div class="info-header mb-3">Users Management</div>
                 <div class="info-body">
                     <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#user-addAccount-modal">
                         <i class='bx bxs-add-to-queue'></i> Thêm Mới
                     </button>
                     <div class="table-wrapper-scroll-y">
                         <table class="table table-bordered table-hover mt-4 table-responsive-md">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Username</th>
                                     <th>First Name</th>
                                     <th>Email</th>
                                     <th>Phone Number</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <!-- CONTENT -->
                             <tbody id="table-body">
                                 <?php
                                    foreach ($data['users'] as $s) {
                                        if ($_SESSION['id'] == $s->id) {
                                            continue;
                                        }
                                    ?>
                                     <tr>
                                         <td><?= $s->id ?></td>
                                         <td><?= User::getUsername($s->id) ?></td>
                                         <td><?= $s->firstname ?></td>
                                         <td><?= $s->email ?></td>
                                         <td><?= $s->phone ?></td>
                                         <td>
                                             <a class="btn btn-sm btn-primary" href="?controller=user&action=view&id=<?= $s->id ?>">View</a>
                                         </td>
                                     </tr>
                                 <?php
                                    }
                                    ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- ADD ACCOUNT MODAL -->
 <div class="modal" id="user-addAccount-modal">
     <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title">Add New Account</h3>
                 <button type="button" class="close" data-dismiss="modal">
                     &times;
                 </button>
             </div>
             <div class="modal-body">
                 <form method="" action="POST">
                     <div class="form-group">
                         <label for="add-user-username">Username:</label>
                         <input class="form-control" id="add-user-username" type="text">
                     </div>
                     <div class="form-group">
                         <label for="add-user-firstname">Firstname:</label>
                         <input class="form-control" id="add-user-firstname" type="text">
                     </div>
                     <div class="form-group">
                         <label for="add-user-lastname">Lastname:</label>
                         <input class="form-control" id="add-user-lastname" type="text">
                     </div>
                     <div class="form-group">
                         <label for="add-user-email">Email:</label>
                         <input class="form-control" id="add-user-email" type="email">
                     </div>
                     <div class="form-group">
                         <label for="add-user-phone">Phone Number:</label>
                         <input class="form-control" id="add-user-phone" type="text">
                     </div>
                     <div class="form-group">
                         <label for="add-user-department">Department:</label>
                         <select class="form-control" name="add-user-department" id="add-user-department">
                             <?php
                                $department = Department::getAll();
                                foreach ($department as $d) {

                                ?>
                                 <option value="<?= $d->id ?>"><?= $d->name ?></option>
                             <?php
                                }
                                ?>
                         </select>
                     </div>
                     <div class="form-group">
                         <div id="fail-alert" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                             This type of file is not allowed
                         </div>
                         <div id="success-alert" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                             This type of file is allowed
                         </div>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="submit" id="user-addAccount-btn" name="submit" class="btn btn-sm btn-primary p-2">Confirm</button>
             </div>
         </div>
     </div>
 </div>