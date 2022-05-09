<?php

namespace Tests\Feature;

use App\Admin;
use App\JenisSurat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JenisSuratSeeder;
use Tests\TestCase;

class MenyuntingKomponenSuratTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $admin;
    private $kodeSurats;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(JenisSuratSeeder::class);
        $this->admin = factory(Admin::class)->make();
        $this->kodeSurats = JenisSurat::pluck('kode_surat');
    }

    /** @test */
    public function itShouldShowSuntingKomponenSuratFormPageWhenAuthorized()
    {
        // setup
        $JenisSurats = JenisSurat::all()->toArray();
        $dataTest = array_combine(
            $this->kodeSurats->toArray(),
            array_map(
                function ($item) {
                    unset($item['id'], $item['created_at'], $item['updated_at']);
                    return $item;
                },
                $JenisSurats
            )
        );

        // test loop
        foreach ($this->kodeSurats as $kodeSurat) {
            $response = $this->actingAs($this->admin)->get(route('pengaturan.surat.buka', $kodeSurat));
            $response->assertStatus(200);
            $response->assertViewIs("admin.pengaturan.surat");
            foreach ($dataTest[$kodeSurat] as $data) {
                $response->assertSee($data);
            }
        }
    }

    /** @test */
    public function itShouldNotShowSuntingKomponenSuratFormPageWhenUnauthorized()
    {
        // test loop
        foreach ($this->kodeSurats as $kodeSurat) {
            $response = $this->get(route('pengaturan.surat.buka', $kodeSurat));
            $this->assertGuest();
            $response->assertStatus(302);
            $response->assertRedirect(route('login'));
        }
    }

    /** @test */
    public function itShouldShowNotFoundPageWhenKodeSuratNotFound()
    {
        // action
        $response = $this->actingAs($this->admin)->get(route('pengaturan.surat.buka', 'surat-keterangan'));

        // test
        $response->assertStatus(404);
    }

    /** @test */
    public function itShouldSaveChangesOfDataKomponenSurat()
    {
        // setup
        // old data
        $kodeSurat = $this->faker->randomElement($this->kodeSurats->toArray());
        $oldData = JenisSurat::where('kode_surat', $kodeSurat)->first()->toArray();
        unset($oldData['id'], $oldData['created_at'], $oldData['kode_surat']);

        // new data
        $dataForm = [
            'jenis_surat' => 'Surat Keterangan',
            'perihal' => 'Surat Keterangan',
            'atas_nama' => $this->faker->name(),
            'penanda_tangan' => $this->faker->jobTitle(),
            'nip_penanda_tangan' =>
            $this->faker->numerify("{$this->faker->date('Ymd')}{$this->faker->date('Ym')}{$this->faker->randomElement([1, 2])}0##"),
            'jabatan_penanda_tangan' => $this->faker->jobTitle()
        ];

        // action
        $response = $this->actingAs($this->admin)->put(
            route(
                'pengaturan.surat.simpan',
                $kodeSurat
            ),
            $dataForm
        );

        // test
        $response->assertStatus(302);
        $response->assertRedirect(route('beranda'));
        $this->assertDatabaseMissing('jenis_surats', $oldData);
        $this->assertDatabaseHas('jenis_surats', $dataForm);
    }

    /** @test */
    public function itShouldNotSaveChangesOfDataKomponenSuratBecauseUnauthorized()
    {
        // setup
        $kodeSurat = $this->faker->randomElement($this->kodeSurats->toArray());
        $dataForm = [
            'jenis_surat' => 'Surat Keterangan',
            'perihal' => 'Surat Keterangan',
            'atas_nama' => $this->faker->name(),
            'penanda_tangan' => $this->faker->jobTitle(),
            'nip_penanda_tangan' =>
            $this->faker->numerify("{$this->faker->date('Ymd')}{$this->faker->date('Ym')}{$this->faker->randomElement([1, 2])}0##"),
            'jabatan_penanda_tangan' => $this->faker->jobTitle()
        ];

        // action
        $response = $this->put(
            route(
                'pengaturan.surat.simpan',
                $kodeSurat
            ),
            $dataForm
        );

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function itShouldNotSaveChangesOfDataKomponenSuratBecauseKodeSuratIsNotFound()
    {
        // setup
        $dataForm = [
            'jenis_surat' => 'Surat Keterangan',
            'perihal' => 'Surat Keterangan',
            'atas_nama' => $this->faker->name(),
            'penanda_tangan' => $this->faker->jobTitle(),
            'nip_penanda_tangan' =>
            $this->faker->numerify("{$this->faker->date('Ymd')}{$this->faker->date('Ym')}{$this->faker->randomElement([1, 2])}0##"),
            'jabatan_penanda_tangan' => $this->faker->jobTitle()
        ];

        // action
        $response = $this->actingAs($this->admin)->put(
            route(
                'pengaturan.surat.simpan',
                'surat-keterangan'
            ),
            $dataForm
        );

        // test
        $response->assertStatus(404);
    }
}
