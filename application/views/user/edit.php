		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>

			<div class="row">
				<div class="col-lg-8">
					<form action="edit" method="POST">
						<div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_depan" class="col-sm-2 col-form-label">Nama Depan</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?= $user['nama_depan'] ;?>">
								<?= form_error('nama_depan', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_belakang" class="col-sm-2 col-form-label">Nama Belakang</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?= $user['nama_belakang'] ;?>">
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
