<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
	if(session()->getFlashData('success')){
?> 
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('success') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<?php
	if(session()->getFlashData('failed')){
?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('failed') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
Tambah User
</button>
<!-- Table with stripped rows -->
<table class="table datatable">
<thead>
	<tr>
	<th scope="col">Id</th>
	<th scope="col">Username</th>
	<th scope="col">Password</th>
	<th scope="col">Role</th>  
	<th scope="col"></th> 
	</tr>
</thead>
<tbody>
	<?php foreach($users as $index=>$user): ?>
	<tr>
	<td><?php echo $user['id'] ?></td> 
	<td><?php echo $user['username'] ?></td> 
	<td><?php echo $user['password'] ?></td> 
	<td><?php echo $user['role'] ?></td> 
	<td>
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $user['id'] ?>">
            Ganti Password
		</button>
	</td>
	</tr>
	<!-- Edit Modal Begin -->
	<div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ganti Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			<form action="<?= base_url('datauser/edit/'.$user['id']) ?>" method="post" enctype="multipart/form-data">
			<?= csrf_field(); ?>
				<div class="modal-body">
                    <div class="form-group ">
                        <label for="username">Username :</label>
                        <input type="text" name="username" class="form-control disable" id="username"  value="<?= $user['username']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="role">Role :</label>
                        <input type="text" name="role" class="form-control" id="role" value="<?= $user['role']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="text" name="password" class="form-control" id="password" placeholder="Password Baru" required>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal End -->
	<?php endforeach ?>   
</tbody>
</table>
<!-- End Table with stripped rows -->

<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Tambah User</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form action="<?= base_url('datauser') ?>" method="post" enctype="multipart/form-data">
		<?= csrf_field(); ?>
		<div class="modal-body">
            <div class="form-group mb-3">
                <label for="username">Username :</label>
                <input type="text" name="username" class="form-control disable" placeholder="Masukkan Username" id="username"  required>
            </div>
			<label for="username">Role :</label>
            <div class="form-group mb-3">
				<input class="form-check-input" type="radio" name="role" id="role1" value="guest">
				<label class="form-check-label me-3" for="role1">
					Guest
				</label>
				<input class="form-check-input" type="radio" name="role" id="role2" value="admin">
				<label class="form-check-label" for="role2">
					Admin
				</label>
			</div>
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="text" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
            </div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
		</form>
		</div>
	</div>
</div>
<!-- Add Modal End -->
<?= $this->endSection() ?>