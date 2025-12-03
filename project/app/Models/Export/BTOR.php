<?php

namespace App\Models\Export;

use App\Models\Kegiatan;
use App\Models\Kegiatan_Lokasi;
use App\Models\Kegiatan_Penulis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BTOR
 *
 * Base class for Back To Office Report (BTOR) export data.
 *
 * @package App\Models\Export
 */
class BTOR extends Model
{
    use HasFactory;

    /**
     * Map data for export.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return array
     */
    public function map($kegiatan): array
    {
        $penulisIds = $kegiatan->penulis->pluck('id');
        $perans = Kegiatan_Penulis::with('peran')
            ->where('kegiatan_id', $kegiatan->id)
            ->whereIn('penulis_id', $penulisIds)
            ->get()
            ->groupBy('penulis_id');

        $staffList = $kegiatan->penulis->map(function ($penulis) use ($perans) {
            $peranNames = $perans->has($penulis->id)
                ? $perans[$penulis->id]->pluck('peran.nama')->filter()->implode(', ')
                : '';
            return $penulis->nama . ($peranNames ? ' (' . $peranNames . ')' : '');
        })->implode(', ');

        $lokasiList = Kegiatan_Lokasi::with('desa.kecamatan.kabupaten.provinsi')
            ->where('kegiatan_id', $kegiatan->id)
            ->get()
            ->map(function ($lokasi) {
                $desa = $lokasi->desa->nama_desa_kelurahan ?? '';
                $kecamatan = $lokasi->desa->kecamatan->nama_kecamatan ?? '';
                $kabupaten = $lokasi->desa->kecamatan->kabupaten->nama_kabupaten ?? '';
                $provinsi = $lokasi->desa->kecamatan->kabupaten->provinsi->nama_provinsi ?? '';
                return array_filter([$desa, $kecamatan, $kabupaten, $provinsi]);
            })
            ->map(function ($parts) {
                return implode(', ', $parts);
            })
            ->unique()
            ->implode('; ');

        $commonData = [
            'Staff Name' => $staffList,
            'Activity' => $kegiatan->activity->nama ?? '',
            'Location' => $lokasiList,
            'Start Date' => $kegiatan->tanggalmulai,
            'End Date' => $kegiatan->tanggalselesai,
            'Background' => $kegiatan->deskripsilatarbelakang,
            'Objective' => $kegiatan->deskripsitujuan,
            'Output' => $kegiatan->deskripsikeluaran,
        ];

        return array_merge($commonData, $this->getSpecificData($kegiatan));
    }

    /**
     * Get specific data for the export type.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return array
     */
    protected function getSpecificData(Kegiatan $kegiatan): array
    {
        return [];
    }
}
