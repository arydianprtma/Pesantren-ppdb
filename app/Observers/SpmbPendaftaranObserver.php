<?php

namespace App\Observers;

use App\Models\AdminActivityLog;
use App\Models\SpmbPendaftaran;

class SpmbPendaftaranObserver
{
    public function created(SpmbPendaftaran $data): void
    {
        AdminActivityLog::catat(
            modul: 'spmb',
            aksi: 'created',
            deskripsi: "Pendaftaran baru no. reg \"{$data->no_registrasi}\" dibuat",
            model: $data,
            sesudah: ['no_registrasi' => $data->no_registrasi, 'status' => $data->status, 'tingkat' => $data->tingkat],
        );
    }

    public function updated(SpmbPendaftaran $data): void
    {
        $changes = $data->getChanges();
        unset($changes['updated_at']);

        if (empty($changes)) return;

        AdminActivityLog::catat(
            modul: 'spmb',
            aksi: 'updated',
            deskripsi: "Data pendaftaran \"{$data->no_registrasi}\" diperbarui",
            model: $data,
            sebelum: array_intersect_key($data->getOriginal(), $changes),
            sesudah: $changes,
        );
    }

    public function deleted(SpmbPendaftaran $data): void
    {
        AdminActivityLog::catat(
            modul: 'spmb',
            aksi: 'deleted',
            deskripsi: "Pendaftaran \"{$data->no_registrasi}\" dihapus",
            model: $data,
        );
    }
}
