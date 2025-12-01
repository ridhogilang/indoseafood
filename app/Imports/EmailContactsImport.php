<?php

namespace App\Imports;

use App\Models\EmailContact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmailContactsImport implements ToModel, WithHeadingRow
{
    /**
     * Menyimpan daftar "kirim" yang duplikat untuk ditampilkan sebagai notifikasi
     */
    protected array $duplicates = [];

    /**
     * Menyimpan "kirim" yang sudah diproses dalam 1 file (hindari duplikat di file yang sama)
     */
    protected array $seenKirim = [];

    /**
     * Header ada di baris ke-2:
     * No. | Company Name | Main Products | Website | Kirim | Country | Phone | Whatsapp | Contact Person | Notes
     */
    public function headingRow(): int
    {
        return 2;
    }

    /**
     * Getter untuk mengambil daftar duplikat setelah import selesai
     */
    public function getDuplicates(): array
    {
        // Biar rapi, kita unik-kan dulu
        return array_values(array_unique($this->duplicates));
    }

    public function model(array $row)
    {
        $nonEmpty = array_filter($row, function ($value) {
            return !is_null($value) && trim((string) $value) !== '';
        });

        if (empty($nonEmpty)) {
            // Semua kolom kosong → skip baris ini
            return null;
        }

        // ===== Normalisasi "kirim" jadi huruf kecil =====
        $rawKirim = $row['kirim'] ?? null;
        $kirim    = $rawKirim !== null ? trim($rawKirim) : null;

        if ($kirim === '') {
            $kirim = null;
        } else {
            $kirim = strtolower($kirim);
        }

        // Jika ada nilai kirim, cek duplikat
        if (!empty($kirim)) {
            // 1) Duplikat di dalam file yang sama
            if (in_array($kirim, $this->seenKirim, true)) {
                $this->duplicates[] = $kirim;
                return null; // skip baris ini
            }

            // 2) Duplikat di database
            if (EmailContact::where('kirim', $kirim)->exists()) {
                $this->duplicates[] = $kirim;
                return null; // skip baris ini
            }

            // Kalau lolos semua, tandai sebagai sudah pernah dipakai di file ini
            $this->seenKirim[] = $kirim;
        }

        return new EmailContact([
            'company'        => $row['company_name']   ?? null,
            'main_product'   => $row['main_products']  ?? null,
            'website'        => $row['website']        ?? null,
            'kirim'          => $kirim,
            'country'        => $row['country']        ?? null,
            'phone'          => $row['phone']          ?? null,
            'whatsapp'       => $row['whatsapp']       ?? null,
            'contact_person' => $row['contact_person'] ?? null,
            'notes'          => $row['notes']          ?? null,
            'status'         => 'active',
        ]);
    }
}
