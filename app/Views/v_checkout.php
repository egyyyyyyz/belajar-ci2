<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6">
        <?= form_open('buy', 'class="row g-3"') ?>

<?= form_hidden('username', session()->get('username')) ?>

<?= form_input([
    'type'  => 'hidden',
    'name'  => 'total_harga',
    'id'    => 'total_harga',
    'value' => '']) ?>

<div class="col-12">
    <?= form_label('Nama', 'nama', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'     => 'nama',
        'id'       => 'nama',
        'class'    => 'form-control',
        'value'    => session()->get('username'),
        'readonly' => true]) ?>
</div>
<div class="col-12">
    <?= form_label('Alamat', 'alamat', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'  => 'alamat',
        'id'    => 'alamat',
        'class' => 'form-control']) ?>
</div> 
<div class="col-12"> 
    <?= form_label('Kelurahan', 'kelurahan', ['class' => 'form-label']) ?>
    <?= form_dropdown('kelurahan', [], '', ['id' => 'kelurahan', 'class' => 'form-control']) ?>
</div>
<div class="col-12"> 
    <?= form_label('Layanan', 'layanan', ['class' => 'form-label']) ?>
    <?= form_dropdown('layanan', [], '', ['id' => 'layanan', 'class' => 'form-control']) ?> 
</div>
<div class="col-12">
    <?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'     => 'ongkir',
        'id'       => 'ongkir',
        'class'    => 'form-control',
        'readonly' => true]) ?>
</div>
<div class="col-12">
    <?= form_label('Kode Voucher', 'voucher_code', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'        => 'voucher_code',
        'id'          => 'voucher_code',
        'class'       => 'form-control',
        'placeholder' => 'Masukkan kode voucher (opsional)']) ?>
    <small class="text-muted">Tersedia: <?= !empty($vouchers) ? implode(', ', $vouchers) : '-' ?></small>
</div>
<div class="col-12">
    <?= form_submit(
        'submit',
        'Buat Pesanan',
        ['class' => 'btn btn-primary']) ?>
</div>

<?= form_close() ?>
    </div>
    <div class="col-lg-6">
        <table class="table">
  <thead>
      <tr>
          <th scope="col">Nama</th>
          <th scope="col">Harga</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Sub Total</th>
      </tr>
  </thead>
  <tbody>
      <?php 
      if (!empty($items)) :
          foreach ($items as $index => $item) :
      ?>
              <tr>
                  <td><?= $item['name'] ?></td>
                  <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                  <td><?= $item['qty'] ?></td>
                  <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
              </tr>
      <?php
          endforeach;
      endif;
      ?>
      <tr>
          <td colspan="2"></td>
          <td>Subtotal</td>
          <td><?= number_to_currency($total, 'IDR') ?></td>
      </tr>
      <tr>
          <td colspan="2"></td>
          <td>Diskon Voucher</td>
          <td><span id="diskon_voucher_text">-IDR 0 (0%)</span></td>
      </tr>
      <tr>
          <td colspan="2"></td>
          <td>PPN (11%)</td>
          <td><span id="ppn_text"><?= number_to_currency($total * 0.11, 'IDR') ?></span></td>
      </tr>
      <tr>
          <td colspan="2"></td>
          <td>Biaya Admin</td>
          <td><span id="biaya_admin_text"></span></td>
      </tr>
      <tr>
          <td colspan="2"></td>
          <td>Subtotal (+PPN+Admin+Voucher)</td>
          <td><strong><span id="subtotal_after_text"></span></strong></td>
      </tr>
      <tr>
          <td colspan="2"></td>
          <td>Grand Total (incl. Ongkir)</td>
          <td><strong><span id="total"><?= number_to_currency($total, 'IDR') ?></span></strong></td>
      </tr>
  </tbody>
</table>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    let ongkir = 0;
let subtotal = <?= $total ?>;

// Daftar voucher untuk preview perhitungan di sisi client.
// Perhitungan final & otoritatif tetap dilakukan di server saat submit.
const voucherList = {
    'FLASH10': 0.10,
    'FLASH15': 0.15,
    'MEMBER20': 0.20
};

hitungTotal();

function hitungBiayaAdminRate(total) {
    if (total <= 20000000) return 0.006;
    if (total <= 40000000) return 0.008;
    return 0.01;
}

function hitungTotal() {
    let voucherCode = $("#voucher_code").val().trim().toUpperCase();
    let diskonRate = voucherList[voucherCode] || 0;
    let diskonVoucher = subtotal * diskonRate;

    let ppn = subtotal * 0.11;
    let adminRate = hitungBiayaAdminRate(subtotal);
    let biayaAdmin = subtotal * adminRate;

    let subtotalAfter = subtotal - diskonVoucher + ppn + biayaAdmin;
    let total = subtotalAfter + ongkir;

    $("#ongkir").val(ongkir);
    $("#diskon_voucher_text").text(`-IDR ${diskonVoucher.toLocaleString('id-ID')} (${(diskonRate * 100).toFixed(0)}%)`);
    $("#ppn_text").text(`IDR ${ppn.toLocaleString('id-ID')}`);
    $("#biaya_admin_text").text(`IDR ${biayaAdmin.toLocaleString('id-ID')} (${(adminRate * 100).toFixed(1)}%)`);
    $("#subtotal_after_text").text(`IDR ${subtotalAfter.toLocaleString('id-ID')}`);
    $("#total").text(`IDR ${total.toLocaleString('id-ID')}`);
    $("#total_harga").val(total);
}

$("#voucher_code").on('input', function () {
    hitungTotal();
});
	$('#kelurahan').select2({
	    placeholder: 'Cari daerah tujuan',
	    minimumInputLength: 3,
        ajax: {
            url: '<?= site_url('ajax/destinations') ?>',
            dataType: 'json',
            delay: 300,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        } 
	});
    $("#kelurahan").on('change', function () {
    let id_kelurahan = $(this).val();

    $("#layanan").empty();
    ongkir = 0;
    hitungTotal(); 

    $.ajax({
    url: "<?= site_url('ajax/costs') ?>", 
    dataType: "json",
    data: {
        destination: id_kelurahan
    },
    success: function (data) { 
        data.forEach(function (item) {
            $("#layanan").append(
                $('<option>', {
                    value: item.cost,
                    text: `${item.description} (${item.service}) : estimasi ${item.etd}`
                })
            );
        });
    }
});
});
$("#layanan").on('change', function() {
    ongkir = parseInt($(this).val());
    hitungTotal();
}); 
});
</script>
<?= $this->endSection() ?>