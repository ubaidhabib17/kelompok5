		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


			<div class="col-lg-6">
				<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

				<?= $this->session->flashdata('message'); ?>
			
				<div class="row">

                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Depan</th>
                        <th scope="col">Nama Belakang</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        </tr>
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
