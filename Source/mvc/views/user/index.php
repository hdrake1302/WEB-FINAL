 <div class="container-fluid">
     <div class="row">

         <div class="col-12 col-md-10 offset-md-1">
             <div class="profile-info">
                 <div class="info-header mb-3">Users Management</div>
                 <div class="info-body">
                     <button class="btn btn-outline-primary" type="button">
                         <i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới
                     </button>
                     <div class="table-wrapper-scroll-y">
                         <table class="table table-bordered table-hover mt-4 table-responsive-md">
                             <thead>
                                 <tr>
                                     <th>ID</th>
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
                                    ?>
                                     <tr>
                                         <td><?= $s->id ?></td>
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