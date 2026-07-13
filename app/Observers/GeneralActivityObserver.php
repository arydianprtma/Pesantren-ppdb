<?php

namespace App\Observers;

use App\Models\AdminActivityLog;
use Illuminate\Database\Eloquent\Model;

class GeneralActivityObserver
{
    /**
     * Get module name from model class
     */
    private function getModulName(Model $model): string
    {
        $className = class_basename($model);
        return match ($className) {
            'PpdbPendaftaran' => 'ppdb',
            'Guru' => 'guru',
            'Agenda' => 'agenda',
            'Berita' => 'berita',
            'Ekstrakurikuler' => 'ekstrakurikuler',
            'Fasilitas' => 'fasilitas',
            'Kelas' => 'kelas',
            'Prestasi' => 'prestasi',
            'Sejarah' => 'sejarah',
            'VisiMisi' => 'visi_misi',
            'WebSetting', 'PpdbSetting' => 'pengaturan',
            'User' => 'user',
            default => strtolower($className),
        };
    }

    /**
     * Get nice clean name of the record
     */
    private function getRecordName(Model $model): string
    {
        return $model->nama ?? $model->name ?? $model->judul ?? $model->no_reg ?? $model->username ?? '';
    }

    /**
     * Handle the Model "created" event.
     */
    public function created(Model $model): void
    {
        $className = class_basename($model);
        $name = $this->getRecordName($model);
        $identifier = $name ? " \"{$name}\"" : '';

        // Prevent logging log model itself
        if ($model instanceof AdminActivityLog) {
            return;
        }

        AdminActivityLog::catat(
            modul: $this->getModulName($model),
            aksi: 'created',
            deskripsi: "Data {$className}{$identifier} ditambahkan",
            model: $model,
            sesudah: $model->toArray(),
        );
    }

    /**
     * Handle the Model "updated" event.
     */
    public function updated(Model $model): void
    {
        if ($model instanceof AdminActivityLog) {
            return;
        }

        $changes = $model->getChanges();
        unset($changes['updated_at']);

        if (empty($changes)) return;

        $className = class_basename($model);
        $name = $this->getRecordName($model);
        $identifier = $name ? " \"{$name}\"" : '';

        AdminActivityLog::catat(
            modul: $this->getModulName($model),
            aksi: 'updated',
            deskripsi: "Data {$className}{$identifier} diperbarui",
            model: $model,
            sebelum: array_intersect_key($model->getOriginal(), $changes),
            sesudah: $changes,
        );
    }

    /**
     * Handle the Model "deleted" event.
     */
    public function deleted(Model $model): void
    {
        if ($model instanceof AdminActivityLog) {
            return;
        }

        $className = class_basename($model);
        $name = $this->getRecordName($model);
        $identifier = $name ? " \"{$name}\"" : '';

        AdminActivityLog::catat(
            modul: $this->getModulName($model),
            aksi: 'deleted',
            deskripsi: "Data {$className}{$identifier} dihapus",
            model: $model,
            sebelum: $model->toArray(),
        );
    }
}
