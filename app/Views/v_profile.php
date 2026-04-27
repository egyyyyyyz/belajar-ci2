<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Profile</h5>
        
        <h4>Profil Pengguna</h4>
        <ul>
            <li><strong>Username:</strong> <?= session()->get('username') ?></li>
            <li><strong>Role:</strong> <?= session()->get('role') ?></li>
            <li><strong>Email:</strong> <?= session()->get('email') ?></li>
            <li><strong>Waktu Login:</strong> <?= session()->get('login_time') ?></li>
            <li><strong>Status Login:</strong> <?= session()->get('isLoggedIn') ? 'Sudah Login' : 'Belum Login' ?></li>
        </ul>

    </div>
</div>

<?= $this->endSection() ?>