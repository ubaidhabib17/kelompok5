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
								<td><?= $p['nama_depan']; ?> <?= $p['nama_belakang'];?></td>
								<td><?= $p['tanggal']; ?></td>
								<td><?= $p['status']; ?></td>
								<td>
									<a href="<?= base_url('admin/editPresensi/').$p['id_presen']?>" class="badge badge-success">edit</a>
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
