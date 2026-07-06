<?php

/**
 * TransaksiHelper
 *
 * Kumpulan fungsi bantu untuk menghitung komponen tambahan pada proses
 * checkout: PPN, biaya admin berjenjang, dan diskon voucher.
 */

if (!function_exists('hitung_ppn')) {
    /**
     * Menghitung PPN 11% dari total harga pembelian (tidak termasuk ongkir).
     *
     * @param float $total_harga
     * @return float
     */
    function hitung_ppn(float $total_harga): float
    {
        if ($total_harga <= 0) {
            return 0;
        }

        return $total_harga * 0.11;
    }
}

if (!function_exists('hitung_biaya_admin')) {
    /**
     * Menghitung biaya admin berdasarkan total harga pembelian dengan tarif berjenjang:
     *  - <= Rp 20.000.000        : 0.6%
     *  - Rp 20.000.001 - 40.000.000 : 0.8%
     *  - > Rp 40.000.000         : 1.0%
     *
     * @param float $total_harga
     * @return float
     */
    function hitung_biaya_admin(float $total_harga): float
    {
        if ($total_harga <= 0) {
            return 0;
        }

        if ($total_harga <= 20000000) {
            $tarif = 0.006;
        } elseif ($total_harga <= 40000000) {
            $tarif = 0.008;
        } else {
            $tarif = 0.01;
        }

        return $total_harga * $tarif;
    }
}

if (!function_exists('hitung_diskon_voucher')) {
    /**
     * Menghitung diskon voucher dari total harga pembelian (sebelum PPN dan biaya admin).
     * Jika kode voucher tidak valid, diskon = 0.
     *
     * @param float  $total_harga
     * @param string|null $voucher_code
     * @return float
     */
    function hitung_diskon_voucher(float $total_harga, ?string $voucher_code): float
    {
        if ($total_harga <= 0 || empty($voucher_code)) {
            return 0;
        }

        $vouchers = get_voucher_list();
        $code     = strtoupper(trim($voucher_code));

        if (!isset($vouchers[$code])) {
            return 0;
        }

        return $total_harga * $vouchers[$code];
    }
}

if (!function_exists('get_voucher_list')) {
    /**
     * Daftar kode voucher yang tersedia beserta persentase diskonnya.
     *
     * @return array<string, float>
     */
    function get_voucher_list(): array
    {
        return [
            'FLASH10'  => 0.10,
            'FLASH15'  => 0.15,
            'MEMBER20' => 0.20,
        ];
    }
}

if (!function_exists('is_voucher_valid')) {
    /**
     * Mengecek apakah kode voucher valid.
     *
     * @param string|null $voucher_code
     * @return bool
     */
    function is_voucher_valid(?string $voucher_code): bool
    {
        if (empty($voucher_code)) {
            return false;
        }

        return isset(get_voucher_list()[strtoupper(trim($voucher_code))]);
    }
}
