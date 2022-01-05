 <div class="container-fluid">
     <div class="row">
         <div class="col-12 col-md-10 offset-md-1">
             <div class="profile-info">
                 <div class="info-header mb-3">Departments Management</div>
                 <div class="info-body">
                     <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#department-add-modal">
                         <i class='bx bxs-add-to-queue'></i> Thêm Mới
                     </button>
                     <div class="table-wrapper-scroll-y">
                         <table class="table table-bordered table-hover mt-4 table-responsive-md">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <!-- CONTENT -->
                             <tbody id="table-body">
                                 <?php
                                    foreach ($data['departments'] as $s) {
                                    ?>
                                     <tr>
                                         <td><?= $s->id ?></td>
                                         <td><?= $s->name ?></td>
                                         <td>
                                             <a class="btn btn-sm btn-primary" href="?controller=department&action=view&id=<?= $s->id ?>">View</a>
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

 <!-- ADD DEPARTMENT MODAL -->
 <div class="modal" id="department-add-modal">
     <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title">Add New Department</h3>
                 <button type="button" class="close" data-dismiss="modal">
                     &times;
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST">
                     <div class="form-group">
                         <label for="department-add-name">Name:</label>
                         <input class="form-control" id="department-add-name" type="text">
                     </div>
                     <div class="form-group">
                         <label for="department-add-description">Description:</label>
                         <textarea class="form-control" name="department-add-description" rows="3" id="department-add-description"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="department-add-quantity">Room Quantity:</label>
                         <input class="form-control" id="department-add-quantity" type="number" min="1">
                     </div>
                     <div class="form-group">
                         <div id="fail-alert" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                             Success
                         </div>
                         <div id="success-alert" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                             Failure
                         </div>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="submit" id="department-add-btn" name="submit" class="btn btn-sm btn-primary p-2">Confirm</button>
             </div>
         </div>
     </div>
 </div>