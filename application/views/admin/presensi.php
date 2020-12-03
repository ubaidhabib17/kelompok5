		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


			<div class="col-lg">
				<?= form_error('presensi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

				<?= $this->session->flashdata('message'); ?>
			
				<div class="row">

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama </th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php $i = 1; ?>
						<?php foreach ($presensi as $p) : ?>
							<tr>
								<th scope="row"><?= $i; ?></th>
								<td><?= $p['nama_depan']. " " . $p['nama_belakang'];?></td>
								<td><?= $p['tanggal']; ?></td>
								<td><?= $p['status']; ?></td>
								<td>
								<a href="" data-toggle="modal" data-target="#editPresensiModal<?= $p['id_presen'] ?>" class="badge badge-success">edit</a>
									<a href="<?= base_url('admin/deletePresensi/').$p['id_presen'];?>" class="badge badge-danger"
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

				<!-- Edit Modal -->
				<?php foreach($presensi as $p): ?>
		<div class="modal fade" id="editPresensiModal<?= $p['id_presen'] ?>" tabindex="-1" role="dialog"
			aria-labelledby="editPresensiModal<?= $p['id_presen'] ?>Label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editMenuModal<?= $p['id_presen']?>">Edit Presensi</h5>
						<buttond type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</buttond>
					</div>
					<form action="<?= base_url('admin/editPresensi/'.$p['id_presen']); ?>" method="post">
						<div class="modal-body">
							<div class="form-group">
								<input type="text" class="form-control" readonly value="<?= $p['nama_depan']." ". $p['nama_belakang']; ?>" id="nama" name="nama"
									placeholder="Submenu title">
							</div>
							<div class="form-group">
								<input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($p['tanggal'])); ?>" id="tanggal" name="tanggal"
									placeholder="Submenu url">
							</div>
							<div class="form-group">
								<select class="form-control" id="status" name="status">
									<option value="" disabled selected>Pilih Kehadiran </option>
									<option value="Hadir">Hadir</option>
									<option value="Izin">Izin</option>
									<option value="Alfa">Alfa</option>
								</select>
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
		<?php endforeach; ?>
		<!-- End Edit Modal -->

