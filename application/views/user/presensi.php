		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>

			<div class="row">
				<div class="col-lg-8">
					<form action="<?= base_url('user/presensi')?>" method="POST">
						<div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Pertanyaan</label>
							<div class="col-sm-10">
								<select name="pertanyaan" id="pertanyaaan" class="form-control">
									<option selected>Pilih Pertanyaan Dibawah Ini !</option>
									<?php foreach($pertanyaan as $p){ ?>
									<option value="<?= $p['pertanyaan']?>"><?= $p['pertanyaan'];?></option>
									<?php 
									} ?>
								</select>
								<?= form_error('pertanyaan', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="jawaban" name="jawaban">
								<?= form_error('jawaban', '<small class="text-danger pl-3">', '</small>'); ?>

								<input type="hidden" class="form-control form-control-user" id="email" name="email"
									value="<?= $user['email'];?>">
								<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

							</div>
						</div>
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
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->
