<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<section class="d-flex">
    <img src="<?php echo base_url()?>public/placeholder-profile-male.jpg" alt="profile-image" class="me-5">
    <div>
        <h3>Username : <?= session()->get('username'); ?></h3>
        <h3>Role :  <?= session()->get('role'); ?> </h3>
        <p><?=session()->get('id') ?></p>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editPassword-<?= session()->get('id')?>">
			Ganti Password
		</button>
        <div class="modal fade" id="editPassword-<?= session()->get('id'); ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ganti Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('profile/edit/'.session()->get('id')); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group ">
                                <label for="username">Username :</label>
                                <input type="text" name="username" class="form-control disable" id="username"  value="<?= session()->get('username')?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role">Role :</label>
                                <input type="text" name="role" class="form-control" id="role" value="<?= session()->get('role')?>" readonly>
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
    </div>
</section>
<?= $this->endSection() ?>