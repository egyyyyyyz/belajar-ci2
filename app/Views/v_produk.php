<?php $this->extend('layout/layout') ?>
<?php $this->section('content') ?>

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Datatables</h5>
          <p>Add lightweight datatables to your project with using the
            <a href="https://github.com/fiduswriter/Simple-DataTables">Simple DataTables</a> library.
            Just add <code>.datatable</code> class name to any table you wish to convert to a datatable.
          </p>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($produk)) : ?>
                <?php foreach ($produk as $i => $p) : ?>
                  <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($p['nama_produk']) ?></td>
                    <td><?= esc($p['kategori']) ?></td>
                    <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                    <td><?= esc($p['stok']) ?></td>
                    <td>
                      <a href="<?= base_url('produk/edit/' . $p['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="<?= base_url('produk/delete/' . $p['id']) ?>" class="btn btn-danger btn-sm"
                         onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="6" class="text-center">Belum ada data produk.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->endSection() ?>