<div class="container">
	<div class="row mt-3">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<b>Form Merubah Data Presensi</b>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<?= $this->session->flashdata('message'); ?>
						<form action="<?= base_url('admin/Presensi') ?>" method="POST">
							<div class="form-group row">
								<label for="nama_belakang" class="col-sm-2 col-form-label">Status</label>
								<div class="col-sm-10">
									<div class="radio mt-2">
										<label><input type="radio" name="status" class="ml-2" value="Hadir"> Hadir</label>
										<label><input type="radio" name="status" class="ml-5" value="Izin"> Izin</label>
										<label><input type="radio" name="status" class="ml-5" value="Alfa"> Alfa</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-10">
									<button type="submit" class="btn btn-primary">Edit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->