<?php

namespace Tests\Feature;

use App\IzinKunjungan;
use App\IzinObservasi;
use App\IzinPraktik;
use App\IzinRiset;
use App\JenisSurat;
use App\JobTraining;
use App\Mahasiswa;
use App\PPM;
use App\ProgramStudi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JenisSuratSeeder;
use ProgramStudiSeeder;
use Tests\TestCase;

class MengajukanSuratTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itShouldShowDaftarFormSuratPage()
    {
        // action
        $response = $this->get(route('pengajuan.index'));

        // test
        $response->assertStatus(200);
        $response->assertViewIs('surat.form.index');
    }

    /** @test */
    public function itShouldShowFormSuratPage()
    {
        // setup
        $this->seed(JenisSuratSeeder::class);
        $kodeSurats = JenisSurat::pluck('kode_surat');

        // test loop
        foreach ($kodeSurats as $kodeSurat) {
            // action
            $response = $this->get(route('pengajuan.form_surat', ["kode_surat" => $kodeSurat]));

            // test
            $response->assertStatus(200);
            $response->assertViewIs("surat.form.$kodeSurat");
        }
    }

    /** @test */
    public function itShouldShow404PageWhenVisitInvalidFormSurat()
    {
        // action
        $response = $this->get(route('pengajuan.form_surat', ["kode_surat" => "invalid"]));

        // test
        $response->assertStatus(404);
    }

    /** @test */
    public function itShouldSaveDataPengajuanSurat()
    {
        // setup
        $this->seed(JenisSuratSeeder::class);
        $this->seed(ProgramStudiSeeder::class);
        $kodeSurats = JenisSurat::pluck('kode_surat');
        $kodeProdis = ProgramStudi::pluck('kode_program_studi');
        $dataMahasiswas = factory(Mahasiswa::class, 5)->make([
            'program_studi' => $this->faker->randomElement($kodeProdis),
        ])->toArray();
        $tabelSurat = [
            "izin-kunjungan" => "izin_kunjungans",
            "izin-riset" => "izin_risets",
            "izin-observasi" => "izin_observasis",
            "izin-praktik" => "izin_praktiks",
            "job-training" => "job_trainings",
            "ppm" => "p_p_m_s"
        ];
        $dataSurats = [
            "izin-riset" => factory(IzinRiset::class)->make()->toArray(),
            "izin-observasi" => factory(IzinObservasi::class)->make()->toArray(),
            "izin-praktik" => factory(IzinPraktik::class)->make()->toArray(),
            "job-training" => factory(JobTraining::class)->make()->toArray(),
            "ppm" => factory(PPM::class)->make()->toArray()
        ];
        $dataForms = array_combine(
            array_keys($dataSurats),
            array_map(
                function ($dataMahasiswa, $dataSurat) {
                    return array_merge($dataMahasiswa, $dataSurat);
                },
                $dataMahasiswas,
                $dataSurats
            )
        );
        $dataSurats["izin-kunjungan"] = factory(IzinKunjungan::class)->make([
            'program_studi' => $this->faker->randomElement($kodeProdis),
        ])->toArray();
        $dataForms["izin-kunjungan"] = $dataSurats["izin-kunjungan"];
        $dataSurats["izin-kunjungan"] = array_filter($dataSurats["izin-kunjungan"], function ($key) {
            return $key != 'program_studi';
        }, ARRAY_FILTER_USE_KEY);

        // test loops
        foreach ($kodeSurats as $kodeSurat) {
            // action
            $response = $this->post(route('pengajuan.ajukan_surat', ["kode_surat" => $kodeSurat]), $dataForms[$kodeSurat]);

            // test
            $response->assertStatus(200);
            $response->assertViewIs("surat.saved.$kodeSurat");
            $this->assertDatabaseCount($tabelSurat[$kodeSurat], 1);
            $this->assertDatabaseHas($tabelSurat[$kodeSurat], $dataSurats[$kodeSurat]);
        }
        $this->assertDatabaseCount('surats', count($kodeSurats));
        foreach ($dataMahasiswas as  $dataMahasiswa) {
            unset($dataMahasiswa['program_studi']);
            $this->assertDatabaseHas('mahasiswas', $dataMahasiswa);
        }
    }
}
