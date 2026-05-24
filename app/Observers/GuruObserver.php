<?php

namespace App\Observers;

use App\Models\AdminActivityLog;
use App\Models\Guru;

class GuruObserver
{
    public function created(Guru $guru): void
    {
        AdminActivityLog::catat(
            modul: 'guru',
            aksi: 'created',
            deskripsi: "Data guru \"{$guru->nama}\" ditambahkan",
            model: $guru,
            sesudah: $guru->toArray(),
        );
    }

    public function updated(Guru $guru): void
    {
        $sebelum = $guru->getOriginal();
        $sesudah = $guru->getChanges();

        AdminActivityLog::catat(
            modul: 'guru',
            aksi: 'updated',
            deskripsi: "Data guru \"{$guru->nama}\" diperbarui",
            model: $guru,
            sebelum: array_intersect_key($sebelum, $sesudah),
            sesudah: $sesudah,
        );
    }

    public function deleted(Guru $guru): void
    {
        AdminActivityLog::catat(
            modul: 'guru',
            aksi: 'deleted',
            deskripsi: "Data guru \"{$guru->nama}\" dihapus",
            model: $guru,
            sebelum: $guru->toArray(),
        );
    }
}
