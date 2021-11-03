<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SuratDisunting implements ShouldBroadcast
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
        $this->surat->mahasiswa;
        $this->surat->izin_kunjungan;

        return [
            'surat' => \Format::surat_table($this->surat, 'terbaru')
        ];
    }
}
