<div class="text-primary text-center mb-3">
    <h3>INFO</h3>
</div>


<div>
    <?php
    foreach ($data['leaves'] as $s) {
    ?>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>ID: </b></div>
            <div class="col-sm-3 text-center"><?= $s->id ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>PersonID:</b></div>
            <div class="col-sm-3 text-center"><?= $s->personID ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>Role:</b></div>
            <div class="col-sm-3 text-center"><?= $s->role ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>Used_Leaves:</b></div>
            <div class="col-sm-3 text-center"><?= $s->used_leaves ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>Total_Leaves:</b></div>
            <div class="col-sm-3 text-center"><?= $s->total_leaves ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>Unused_Leaves:</b></div>
            <div class="col-sm-3 text-center"><?= $s->total_leaves -  $s->used_leaves ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <button data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-block mb-5 mt-5">Leave Request</button>
            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Leave Application</h3>
                        <button type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="sel">Choose the number of days off:</label>
                                <select class="form-control" id="sel">
                                    <option value=""> 1</option>
                                    <option value=""> 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Choose the date:</label>
                                <input class="form-control" id="date" type="date">
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason:</label>
                                <textarea class="form-control" rows="3" id="reason"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">Evidence:</label>
                                <input type="file" class="form-control-file border" name="file" id="file">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary" data-dismiss="modal">Create</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<div class="text-primary text-center mb-3">
    <h3>HISTORY</h3>
</div>

<table class="table-responsive-sm table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>PersonID</th>
            <th>Role</th>
            <th>used_leaves</th>
            <th>total_leaves</th>
            <th>Action</th>
        </tr>
    </thead>
    <!-- CONTENT -->
    <!-- <tbody id="table-body">
        <?php
        foreach ($data['leaves'] as $s) {
        ?>
            <tr>
                <td><?= $s->id ?></td>
                <td><?= $s->personID ?></td>
                <td><?= $s->role ?></td>
                <td><?= $s->used_leaves ?></td>
                <td><?= $s->total_leaves ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="?controller=user&action=view&id=<?= $s->id ?>">View</a> 
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>  -->
</table>