		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


			<div class="col-lg-6">
				<?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

				<?= $this->session->flashdata('message'); ?>
			
				<div class="row">
					<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Role</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($role as $r) : ?>
								<tr>
									<th scope="row"><?= $i; ?></th>
									<td><?= $r['role']; ?></td>
									<td>
										<a href="<?= base_url('admin/roleaccess/').$r['id']?>" class="badge badge-warning">access</a>
										<a href="" data-toggle="modal" data-target="#editMenuModal<?= $r['id'] ?>" class="badge badge-success">edit</a>
										<a href="<?= base_url('admin/deleteRole/').$r['id'];?>" class="badge badge-danger"
										onclick="return confirm('Are you sure to delete this data ?');">delete</a>
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


		<!-- Modal -->
		<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="newRoleModalLabel">Add new Role</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url('admin/role'); ?>" method="post">
						<div class="modal-body">
							<div class="form-group">
								<input type="text" class="form-control" id="role" name="role" placeholder="Role name">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="Submit" class="btn btn-primary">Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- edit Modal -->
		<?php foreach ($role as $r):?>
		<div class="modal fade" id="editMenuModal<?= $r['id']?>" tabindex="-1" role="dialog"
			aria-labelledby="editMenuModal<?= $r['id']?>" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editMenuModal">Edit Role</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url('admin/editRole/'.$r['id']); ?>" method="post">
						<div class="modal-body">
							<div class="form-group">
								<input type="text" class="form-control" value="<?= $r['role'] ?>" id="role" name="role"
									placeholder="Role name">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php endforeach;?>
		<!-- End edit Modal -->
