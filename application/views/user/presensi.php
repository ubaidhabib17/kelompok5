		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title ;?></h1>

			<div class="row">
				<div class="col-lg-8">
					<form action="edit" method="POST">
						<div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Pertanyaan</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="<?= $user['pertanyaan'] ;?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="jawaban" name="jawaban" value="<?= $user['jawaban'] ;?>">
								<?= form_error('jawaban', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_belakang" class="col-sm-2 col-form-label">Status</label>
							<div class="col-sm-10">
                                <div class="radio mt-2">
                                    <label><input type="radio" name="optradio"class="ml-2">  Hadir</label>
                                    <label><input type="radio" name="optradio" class="ml-5">  Izin</label>
                                    <label><input type="radio" name="optradio" checked class="ml-5">  Alfa</label>
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
