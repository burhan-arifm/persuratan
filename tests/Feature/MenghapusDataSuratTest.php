<?php

namespace Tests\Feature;

use App\Admin;
use App\IzinObservasi;
use App\JenisSurat;
use App\Mahasiswa;
use App\Surat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JenisSuratSeeder;
use Tests\TestCase;

class MenghapusDataSuratTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(JenisSuratSeeder::class);
    }

    /** @test */
    public function itShouldDeleteDataSurat()
    {
        // setup
        $admin = factory(Admin::class)->make();
        $izinObservasi = factory(IzinObservasi::class)->create();
        $surat = factory(Surat::class)->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-observasi')->first()->id,
            'pemohon' => factory(Mahasiswa::class)->create()->nim,
            'surat' => $izinObservasi->id,
        ]);

        // pre-test
        $this->assertDatabaseCount('izin_observasis', 1);
        $this->assertDatabaseCount('surats', 1);

        // action
        $response = $this->actingAs($admin)->delete(route('surat.hapus', $surat->id));

        // post test
        $response->assertStatus(204);
        $this->assertDatabaseCount('surats', 0);
        $this->assertDatabaseMissing('surats', $surat->toArray());
        $this->assertDatabaseCount('izin_observasis', 0);
        $this->assertDatabaseMissing('izin_observasis', $izinObservasi->toArray());
    }

    /** @test */
    public function itShouldNotDeleteDataSuratBecauseUnauthorized()
    {
        // setup
        $izinObservasi = factory(IzinObservasi::class)->create();
        $surat = factory(Surat::class)->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-observasi')->first()->id,
            'pemohon' => factory(Mahasiswa::class)->create()->nim,
            'surat' => $izinObservasi->id,
        ]);
        $datatestIzinObservasi = $izinObservasi->toArray();
        $datatestSurat = $surat->toArray();
        unset($datatestIzinObservasi['created_at'], $datatestIzinObservasi['updated_at'], $datatestSurat['created_at'], $datatestSurat['updated_at']);

        // pre-test
        $this->assertDatabaseCount('surats', 1);
        $this->assertDatabaseCount('izin_observasis', 1);

        // action
        $response = $this->delete(route('surat.hapus', $surat->id));

        // post test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertDatabaseCount('izin_observasis', 1);
        $this->assertDatabaseHas('izin_observasis', $datatestIzinObservasi);
        $this->assertDatabaseCount('surats', 1);
        $this->assertDatabaseHas('surats', $datatestSurat);
    }

    /** @test */
    public function itShouldNotDeleteDataSuratBecauseSuratNotFound()
    {
        // setup
        $admin = factory(Admin::class)->make();
        factory(Surat::class)->create();

        // pre-test
        $this->assertDatabaseCount('surats', 1);

        // action
        $response = $this->actingAs($admin)->delete(route('surat.hapus', $this->faker->uuid()));

        // post test
        $response->assertStatus(404);
        $this->assertDatabaseCount('surats', 1);
    }
}
