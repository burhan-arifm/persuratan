<?php

namespace Tests\Feature;

use App\Admin;
use App\Helpers\Formatter;
use App\IzinKunjungan;
use App\IzinObservasi;
use App\IzinPraktik;
use App\IzinRiset;
use App\JenisSurat;
use App\JobTraining;
use App\Mahasiswa;
use App\PPM;
use App\ProgramStudi;
use App\Surat;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JenisSuratSeeder;
use ProgramStudiSeeder;
use Tests\TestCase;

class MelihatDataSuratTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(JenisSuratSeeder::class);
    }

    /** @test */
    public function itShouldSeeDataSuratTerbaru()
    {
        // setup
        $admin = factory(Admin::class)->make();
        $suratTelahDiproses = factory(Surat::class, 5)->state('telah_diproses')->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-riset')->first()->id,
            'pemohon' => factory(Mahasiswa::class)->create()->nim,
            'surat' => factory(IzinRiset::class)->create()->id,
        ]);
        $suratBelumDiproses = factory(Surat::class, 3)->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-observasi')->first()->id,
            'pemohon' => factory(Mahasiswa::class)->create()->nim,
            'surat' => factory(IzinObservasi::class)->create()->id,
        ]);
        $datatest01 = array_map(fn ($data) => Formatter::surat_table($data), $suratTelahDiproses->all());
        $datatest02 = array_map(fn ($data) => Formatter::surat_table($data), $suratBelumDiproses->all());

        // action
        $response = $this->actingAs($admin)->get(route('beranda'));

        // test
        $response->assertStatus(200);
        $response->assertViewIs('admin.home');
        $response->assertLocation('/');
        foreach ($datatest01 as $dataset) {
            unset($dataset['nomor_surat'], $dataset['jenis_surat'], $dataset['waktu']);
            foreach ($dataset as $data) {
                $response->assertDontSee($data);
            }
        }
        foreach ($datatest02 as $dataset) {
            unset($dataset['nomor_surat'], $dataset['jenis_surat'], $dataset['waktu']);
            foreach ($dataset as $data) {
                $response->assertSee($data);
            }
        }
        $this->assertDatabaseCount('surats', 8);
    }

    /** @test */
    public function itShouldNotSeeDataSuratTerbaruBecauseUnauthorized()
    {
        // action
        $response = $this->get(route('beranda'));

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function itShouldSeeSemuaDataSurat()
    {
        // setup
        $admin = factory(Admin::class)->make();
        $suratTelahDiproses = factory(Surat::class, 5)->state('telah_diproses')->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-riset')->first()->id,
            'pemohon' => factory(Mahasiswa::class)->create()->nim,
            'surat' => factory(IzinRiset::class)->create()->id,
        ]);
        $suratBelumDiproses = factory(Surat::class, 3)->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-observasi')->first()->id,
            'pemohon' => factory(Mahasiswa::class)->create()->nim,
            'surat' => factory(IzinObservasi::class)->create()->id,
        ]);
        $datatest01 = array_map(fn ($data) => Formatter::surat_table($data), $suratTelahDiproses->all());
        $datatest02 = array_map(fn ($data) => Formatter::surat_table($data), $suratBelumDiproses->all());
        $datatest = array_merge($datatest02, $datatest01);

        // action
        $response = $this->actingAs($admin)->get(route('surat.riwayat'));

        // test
        $response->assertStatus(200);
        $response->assertViewIs('admin.riwayat');
        foreach ($datatest as $dataset) {
            unset($dataset['nomor_surat'], $dataset['jenis_surat'], $dataset['waktu']);
            foreach ($dataset as $data) {
                $response->assertSee($data);
            }
        }
        $this->assertDatabaseCount('surats', 8);
    }

    /** @test */
    public function itShouldNotSeeSemuaDataSuratBecauseUnauthorized()
    {
        // action
        $response = $this->get(route('surat.riwayat'));

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function itShouldSeeSpecifiedDataSuratById()
    {
        // setup
        $this->seed(ProgramStudiSeeder::class);
        $kodeSurats = JenisSurat::pluck('kode_surat');
        $prodiIds = ProgramStudi::pluck('id');
        $admin = factory(Admin::class)->make();
        $dataMahasiswas = factory(Mahasiswa::class, 5)->create([
            'program_studi' => $this->faker->randomElement($prodiIds),
        ]);
        $dataTambahan = [
            "izin-riset" => factory(IzinRiset::class)->create(),
            "izin-observasi" => factory(IzinObservasi::class)->create(),
            "izin-praktik" => factory(IzinPraktik::class)->create(),
            "job-training" => factory(JobTraining::class)->create(),
            "ppm" => factory(PPM::class)->create()
        ];
        $dataJenisSurat = array_merge(...array_map(
            function ($data) {
                $key = $data['kode_surat'];
                $data['perihal'] = str_replace("Izin ", "", $data['jenis_surat']);
                unset(
                    $data['id'],
                    $data['kode_surat'],
                    $data['jenis_surat'],
                    $data['created_at'],
                    $data['updated_at']
                );
                return [$key => $data];
            },
            JenisSurat::all()->toArray(),
        ));
        $dataSurats = array_combine(
            array_keys($dataTambahan),
            array_map(
                function ($key, $data, $mahasiswa) {
                    return factory(Surat::class)->create([
                        'jenis_surat' => JenisSurat::where('kode_surat', $key)->first()->id,
                        'pemohon' => $mahasiswa->nim,
                        'surat' => $data->id,
                    ]);
                },
                array_keys($dataTambahan),
                $dataTambahan,
                $dataMahasiswas->all()
            )
        );
        $datatests = array_map(
            function ($surat) use ($dataTambahan, $dataJenisSurat) {
                $mahasiswa = Mahasiswa::find($surat->pemohon)->toArray();
                $mahasiswa['program_studi'] = ProgramStudi::find($mahasiswa['program_studi'])->nama_program_studi;
                $kodeSurat = JenisSurat::find($surat->jenis_surat)->kode_surat;
                $detailSurat = $dataTambahan[$kodeSurat]->toArray();
                unset(
                    $detailSurat['id'],
                    $detailSurat['created_at'],
                    $detailSurat['updated_at'],
                    $mahasiswa['created_at'],
                    $mahasiswa['updated_at'],
                    $mahasiswa['tempat_tanggal_lahir']
                );
                return array_filter(
                    array_merge(
                        $surat->toArray(),
                        $dataJenisSurat[$kodeSurat],
                        $mahasiswa,
                        $detailSurat
                    ),
                    fn ($data) => !is_null($data)
                );
            },
            $dataSurats
        );
        $dataTambahan["izin-kunjungan"] = factory(IzinKunjungan::class)->create([
            'program_studi' => $this->faker->randomElement($prodiIds),
        ]);
        $dataSurats["izin-kunjungan"] = factory(Surat::class)->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-kunjungan')->first()->id,
            'pemohon' => $dataTambahan['izin-kunjungan']->jurusan->singkatan_program_studi . " " . $dataTambahan['izin-kunjungan']->semester . "-" . $dataTambahan['izin-kunjungan']->kelas,
            'surat' => $dataTambahan["izin-kunjungan"]->id,
        ]);
        $datatests["izin-kunjungan"] = array_merge(
            $dataSurats["izin-kunjungan"]->toArray(),
            $dataJenisSurat["izin-kunjungan"],
            $dataTambahan["izin-kunjungan"]->toArray()
        );
        $datatests = array_map(function ($datatest) {
            $jenisSurat = JenisSurat::find($datatest['jenis_surat']);
            $tanggal_terbit = Carbon::createFromFormat('Y-m-d', $datatest['tanggal_terbit']);
            $datatest['nomor_surat'] = sprintf("B-%04u/Un.05/III.4/TL.10/%02u/%u", $datatest['nomor_surat'], $tanggal_terbit->month, $tanggal_terbit->year);
            $datatest['tanggal_terbit'] = $tanggal_terbit->isoFormat('DD MMMM YYYY');
            unset($datatest['id'], $datatest['jenis_surat'], $datatest['pemohon'], $datatest['status_surat'], $datatest['surat'], $datatest['updated_at'], $datatest['created_at']);
            if ($jenisSurat->kode_surat == 'izin-kunjungan') {
                $datatest['program_studi'] = ProgramStudi::find($datatest['program_studi'])->nama_program_studi;
                $datatest['tanggal_kunjungan'] = Carbon::createFromFormat('Y-m-d', $datatest['tanggal_kunjungan'])->isoFormat('dddd, DD MMMM YYYY');
                unset($datatest['jurusan']);
            }
            return $datatest;
        }, $datatests);

        // test loop
        foreach ($kodeSurats as $kodeSurat) {
            $response = $this->actingAs($admin)->get(route('surat.detail', $dataSurats[$kodeSurat]->id));
            $response->assertStatus(200);
            $response->assertViewIs("admin.detail.$kodeSurat");
            foreach ($datatests[$kodeSurat] as $datatest) {
                $response->assertSee($datatest);
            }
        }
    }

    /** @test */
    public function itShouldNotSeeSpecifiedDataSuratBecauseUnauthorized()
    {
        // setup
        $surat = factory(Surat::class)->create();

        // action
        $response = $this->get(route('surat.detail', $surat->id));

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function itShouldNotSeeSpecifiedDataSuratBecauseIdNotFound()
    {
        // setup
        factory(Surat::class, 5)->create();
        $admin = factory(Admin::class)->create();

        // action
        $response = $this->actingAs($admin)->get(route('surat.detail', $this->faker->uuid()));

        // test
        $response->assertStatus(404);
    }
}
