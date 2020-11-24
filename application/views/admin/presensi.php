		<!-- Begin Page Content -->
		<div class="container-fluid">

		    <!-- Page Heading -->
		    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


		    <div class="col-lg-6">
		        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

		        <?= $this->session->flashdata('message'); ?>

		        <div class="row">

		            <table class="table table-hover">
		                <thead>
		                    <tr>
		                        <th scope="col">#</th>
		                        <th scope="col">ID User</th>
		                        <th scope="col">Status</th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php $i = 1; ?>
		                    <?php foreach ($role as $r) : ?>
		                        <tr>
		                            <th scope="row"><?= $i; ?></th>
		                            <td><?= $r['role']; ?></td>
		                            <td>
		                                <a href="<?= base_url('admin/editPresensi/') . $r['id'] ?>" class="badge badge-success">edit</a>
		                                <a href="<?= base_url('admin/deletePresensi/') . $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure to delete this data ?');">delete</a>
		                            </td>
		                        </tr>
		                        <?php $i++; ?>
		                    <?php endforeach; ?>
		                </tbody>
		            </table>


		        </div>

		    </div>
		    <!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->