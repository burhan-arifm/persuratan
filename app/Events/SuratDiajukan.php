<?php

namespace App\Events;

use App\Helpers\Formatter as Format;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SuratDiajukan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $surat;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Surat $surat)
    {
        $this->surat = $surat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('persuratan');
    }

    public function broadcastWith()
    {
        $this->surat->jenis;
        if ($this->surat->jenis->kode_surat != 'izin-kunjungan') {
            $this->surat->mahasiswa;
        } else {
            $this->surat->izin_kunjungan;
        }


        return [
            'surat' => Format::surat_table($this->surat)
        ];
    }
}
