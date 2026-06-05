<?php

namespace App\Observers;

use App\Models\AdminActivityLog;
use App\Models\PpdbPendaftaran;

class PpdbPendaftaranObserver
{
    public function created(PpdbPendaftaran $data): void
    {
        AdminActivityLog::catat(
            modul: 'ppdb',
            aksi: 'created',
            deskripsi: "Pendaftaran baru no. reg \"{$data->no_reg}\" dibuat",
            model: $data,
            sesudah: ['no_reg' => $data->no_reg, 'status' => $data->status, 'tingkat' => $data->tingkat],
        );
    }

    public function updated(PpdbPendaftaran $data): void
    {
        $changes = $data->getChanges();
        unset($changes['updated_at']);

        if (empty($changes)) return;

        AdminActivityLog::catat(
            modul: 'ppdb',
            aksi: 'updated',
            deskripsi: "Data pendaftaran \"{$data->no_reg}\" diperbarui",
            model: $data,
            sebelum: array_intersect_key($data->getOriginal(), $changes),
            sesudah: $changes,
        );
    }

    public function deleted(PpdbPendaftaran $data): void
    {
        AdminActivityLog::catat(
            modul: 'ppdb',
            aksi: 'deleted',
            deskripsi: "Pendaftaran \"{$data->no_reg}\" dihapus",
            model: $data,
        );
    }
}
