<div class="container">
<div class ="row mt-3">
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
           <b>Form Merubah Data Role</b>
        </div>
        <div class="card-body">
            <?php if(validation_errors()):?>
            <div class="alert alert-danger" role="alert">
            <!-- $this->form_validation->set_message('rule,'eror message'); -->
            <?= validation_errors();?>
</div>
            <?php endif;?>
            <?php echo 
            form_open('admin/editRole/'.$role['id']); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label form="id">  <b>ID ROLE</b> </label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= $role['id'];?>">
                </div>
                <div class="form-group">
                    <label form="role">  <b>ROLE NAME</b> </label>
                    <input type="text" class="form-control" id="role" name="role" value="<?= $role['role'];?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary float-right"> Edit </button>
            </form>
            <?php echo 
            form_close();
            ?>
        </div>
        </div>
    </div>
 </div>
</div>