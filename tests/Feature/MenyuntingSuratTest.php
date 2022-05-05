<?php

namespace Tests\Feature;

use App\Admin;
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

class MenyuntingSuratTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $admin;
    private $kodeSurats;
    private $prodiIds;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(JenisSuratSeeder::class);
        $this->seed(ProgramStudiSeeder::class);
        $this->admin = factory(Admin::class)->make();
        $this->kodeSurats = JenisSurat::pluck('kode_surat');
        $this->prodiIds = ProgramStudi::pluck('id');
    }

    /** @test */
    public function itShouldShowSuntingSuratFormPageWhenAuthorized()
    {
        // setup
        $dataMahasiswas = factory(Mahasiswa::class, 5)->create([
            'program_studi' => $this->faker->randomElement($this->prodiIds),
        ]);
        $dataTambahan = [
            "izin-riset" => factory(IzinRiset::class)->create(),
            "izin-observasi" => factory(IzinObservasi::class)->create(),
            "izin-praktik" => factory(IzinPraktik::class)->create(),
            "job-training" => factory(JobTraining::class)->create(),
            "ppm" => factory(PPM::class)->create()
        ];
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
            function ($surat) use ($dataTambahan) {
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
                        $mahasiswa,
                        $detailSurat
                    ),
                    fn ($data) => !is_null($data)
                );
            },
            $dataSurats
        );
        $dataTambahan["izin-kunjungan"] = factory(IzinKunjungan::class)->create([
            'program_studi' => $this->faker->randomElement($this->prodiIds),
        ]);
        $dataSurats["izin-kunjungan"] = factory(Surat::class)->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-kunjungan')->first()->id,
            'pemohon' => $dataTambahan['izin-kunjungan']->jurusan->singkatan_program_studi . " " . $dataTambahan['izin-kunjungan']->semester . "-" . $dataTambahan['izin-kunjungan']->kelas,
            'surat' => $dataTambahan["izin-kunjungan"]->id,
        ]);
        $datatests["izin-kunjungan"] = array_merge(
            $dataSurats["izin-kunjungan"]->toArray(),
            $dataTambahan["izin-kunjungan"]->toArray()
        );
        $datatests = array_map(function ($datatest) {
            $jenisSurat = JenisSurat::find($datatest['jenis_surat']);
            $tanggal_terbit = Carbon::createFromFormat('Y-m-d', $datatest['tanggal_terbit']);
            $datatest['nomor_surat'] = sprintf("B-%04u/Un.05/III.4/TL.10/%02u/%u", $datatest['nomor_surat'], $tanggal_terbit->month, $tanggal_terbit->year);
            $datatest['tanggal_terbit'] = $tanggal_terbit->isoFormat('MM/YYYY');
            unset($datatest['id'], $datatest['jenis_surat'], $datatest['pemohon'], $datatest['status_surat'], $datatest['surat'], $datatest['updated_at'], $datatest['created_at']);
            if ($jenisSurat->kode_surat == 'izin-kunjungan') {
                $datatest['program_studi'] = ProgramStudi::find($datatest['program_studi'])->nama_program_studi;
                unset($datatest['jurusan'], $datatest['tanggal_kunjungan'], $datatest['waktu_kunjungan']);
            }
            return $datatest;
        }, $datatests);

        // test loop
        foreach ($this->kodeSurats as $kodeSurat) {
            $response = $this->actingAs($this->admin)->get(route('surat.sunting', $dataSurats[$kodeSurat]->id));
            $response->assertStatus(200);
            $response->assertViewIs("admin.sunting.$kodeSurat");
            foreach ($datatests[$kodeSurat] as $datatest) {
                $response->assertSee($datatest);
            }
        }
    }

    /** @test */
    public function itShouldNotShowSuntingSuratFormPageWhenUnauthorized()
    {
        // action
        $response = $this->get(route('surat.sunting', 1));

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function itShouldShowNotFoundPageWhenSuratIdNotFound()
    {
        // action
        $response = $this->actingAs($this->admin)->get(route('surat.sunting', 1));

        // test
        $response->assertStatus(404);
    }

    /** @test */
    public function itShouldSaveChangesOfDataSurat()
    {
        // setup
        $tabelSurat = [
            "izin-kunjungan" => "izin_kunjungans",
            "izin-riset" => "izin_risets",
            "izin-observasi" => "izin_observasis",
            "izin-praktik" => "izin_praktiks",
            "job-training" => "job_trainings",
            "ppm" => "p_p_m_s"
        ];

        // old data
        $oldDataMahasiswas = factory(Mahasiswa::class, 5)->create([
            'program_studi' => $this->faker->randomElement($this->prodiIds),
        ])->toArray();
        $oldDataTambahanSurats = [
            "izin-riset" => factory(IzinRiset::class)->create()->toArray(),
            "izin-observasi" => factory(IzinObservasi::class)->create()->toArray(),
            "izin-praktik" => factory(IzinPraktik::class)->create()->toArray(),
            "job-training" => factory(JobTraining::class)->create()->toArray(),
            "ppm" => factory(PPM::class)->create()->toArray()
        ];
        $oldDataSurats = array_combine(
            array_keys($oldDataTambahanSurats),
            array_map(
                function ($dataMahasiswa, $dataTambahan) use ($oldDataTambahanSurats) {
                    return factory(Surat::class)->create([
                        'jenis_surat' => JenisSurat::where('kode_surat', array_search($dataTambahan, $oldDataTambahanSurats))->first()->id,
                        'pemohon' => $dataMahasiswa['nim'],
                        'surat' => $dataTambahan['id'],
                    ])->toArray();
                },
                $oldDataMahasiswas,
                $oldDataTambahanSurats
            )
        );
        $oldDataIzinKunjungan = factory(IzinKunjungan::class)->create([
            'program_studi' => $this->faker->randomElement($this->prodiIds),
        ]);
        $oldDataTambahanSurats["izin-kunjungan"] = $oldDataIzinKunjungan->toArray();
        $oldDataSurats["izin-kunjungan"] = factory(Surat::class)->create([
            'jenis_surat' => JenisSurat::where('kode_surat', 'izin-kunjungan')->first()->id,
            'pemohon' =>
            $oldDataIzinKunjungan->jurusan->singkatan_program_studi
                . " "
                . $oldDataIzinKunjungan->semester
                . "-"
                . $oldDataIzinKunjungan->kelas,
            'surat' => $oldDataIzinKunjungan->id,
        ])->toArray();
        $idSurats = array_map(
            fn ($dataTambahan) => array_filter(
                $dataTambahan,
                fn ($key) => $key == 'id',
                ARRAY_FILTER_USE_KEY
            ),
            $oldDataSurats
        );
        $oldDataTestTambahanSurats = array_map(
            fn ($dataTambahan) => array_filter(
                $dataTambahan,
                fn ($key) => $key != 'id' && $key != 'created_at',
                ARRAY_FILTER_USE_KEY
            ),
            $oldDataTambahanSurats
        );
        $oldDataTestSurats = array_map(
            fn ($surat) => array_filter(
                $surat,
                fn ($key) => in_array(
                    $key,
                    ['nomor_surat', 'tanggal_terbit', 'pemohon', 'updated_at']
                ),
                ARRAY_FILTER_USE_KEY
            ),
            $oldDataSurats
        );

        // new data
        $kodeProdis = ProgramStudi::pluck('kode_program_studi');
        $newDataMahasiswas = factory(Mahasiswa::class, 5)->make([
            'program_studi' => $this->faker->randomElement($kodeProdis),
        ])->toArray();
        $newDataTambahanSurats = [
            "izin-riset" => factory(IzinRiset::class)->make()->toArray(),
            "izin-observasi" => factory(IzinObservasi::class)->make()->toArray(),
            "izin-praktik" => factory(IzinPraktik::class)->make()->toArray(),
            "job-training" => factory(JobTraining::class)->make()->toArray(),
            "ppm" => factory(PPM::class)->make()->toArray()
        ];
        $newDataSurats = array_map(
            fn () => [
                'nomor_surat' => $this->faker->unique()->randomNumber(4),
                'tanggal_terbit' => $this->faker->date('Y-m-d'),
                'pemohon' => $this->faker->unique()->randomNumber(5)
            ],
            $newDataTambahanSurats
        );
        $dataForms = array_combine(
            array_keys($newDataSurats),
            array_map(
                fn ($dataSurat, $dataMahasiswa, $dataTambahanSurat) => array_merge(
                    [
                        'nomor_surat' => $dataSurat['nomor_surat'],
                        'tanggal_terbit' => $dataSurat['tanggal_terbit'],
                    ],
                    $dataMahasiswa,
                    $dataTambahanSurat
                ),
                $newDataSurats,
                $newDataMahasiswas,
                $newDataTambahanSurats
            )
        );
        foreach (array_keys($newDataSurats) as $key) {
            $newDataSurats[$key]['pemohon'] = $dataForms[$key]['nim'];
        }
        $newDataIzinKunjungan = factory(IzinKunjungan::class)->make([
            'program_studi' => $this->faker->randomElement($kodeProdis),
        ]);
        $newDataTambahanSurats["izin-kunjungan"] = $newDataIzinKunjungan->toArray();
        $newDataSurats["izin-kunjungan"] = [
            'nomor_surat' => $this->faker->unique()->randomNumber(4),
            'tanggal_terbit' => $this->faker->date('Y-m-d'),
            'pemohon' => ProgramStudi::where(
                'kode_program_studi',
                $newDataTambahanSurats["izin-kunjungan"]['program_studi']
            )->first()->singkatan_program_studi
                . " "
                . $newDataIzinKunjungan->semester
                . "-"
                . $newDataIzinKunjungan->kelas
        ];
        $dataForms["izin-kunjungan"] = array_merge(
            [
                'nomor_surat' => $newDataSurats["izin-kunjungan"]['nomor_surat'],
                'tanggal_terbit' => $newDataSurats["izin-kunjungan"]['tanggal_terbit'],
            ],
            $newDataSurats["izin-kunjungan"],
            $newDataTambahanSurats["izin-kunjungan"]
        );
        $newDataTambahanSurats["izin-kunjungan"] = array_merge(
            $newDataTambahanSurats["izin-kunjungan"],
            [
                'program_studi' => ProgramStudi::where(
                    'kode_program_studi',
                    $newDataTambahanSurats["izin-kunjungan"]['program_studi']
                )->first()->id,
            ]
        );
        $dataForms = array_map(
            function ($dataSurat) {
                $tanggal_terbit = Carbon::parse($dataSurat['tanggal_terbit']);
                unset($dataSurat['pemohon'], $dataSurat['updated_at']);
                return array_merge(
                    $dataSurat,
                    [
                        'nomor_surat' => sprintf(
                            "B-%04u/Un.05/III.4/TL.10/%02u/%u",
                            $dataSurat['nomor_surat'],
                            $tanggal_terbit->month,
                            $tanggal_terbit->year
                        )
                    ]
                );
            },
            $dataForms
        );
        $newDataTestSurats = $newDataSurats;
        $newDataTestTambahanSurats = $newDataTambahanSurats;

        // test loop
        foreach ($this->kodeSurats as $kodeSurat) {
            $response = $this->actingAs($this->admin)->put(
                route(
                    'surat.edit',
                    $idSurats[$kodeSurat]
                ),
                $dataForms[$kodeSurat]
            );
            $response->assertStatus(302);
            $response->assertRedirect(route('surat.riwayat'));
            $this->assertDatabaseMissing('surats', $oldDataTestSurats[$kodeSurat]);
            $this->assertDatabaseMissing($tabelSurat[$kodeSurat], $oldDataTestTambahanSurats[$kodeSurat]);
            $this->assertDatabaseHas('surats', $newDataTestSurats[$kodeSurat]);
            $this->assertDatabaseHas($tabelSurat[$kodeSurat], $newDataTestTambahanSurats[$kodeSurat]);
        }
    }

    /** @test */
    public function itShouldNotSaveChangesOfDataSuratBecauseUnauthorized()
    {
        // setup
        $kodeProdis = ProgramStudi::pluck('kode_program_studi');
        $newDataMahasiswa = factory(Mahasiswa::class,)->make([
            'program_studi' => $this->faker->randomElement($kodeProdis),
        ])->toArray();
        $newDataTambahanSurat = factory(IzinRiset::class)->make()->toArray();
        $newDataSurat = [
            'nomor_surat' => $this->faker->unique()->randomNumber(4),
            'tanggal_terbit' => $this->faker->date('Y-m-d'),
            'pemohon' => $newDataMahasiswa['nim']
        ];
        $dataForm = array_merge(
            [
                'nomor_surat' => sprintf(
                    "B-%04u/Un.05/III.4/TL.10/%02u/%u",
                    $newDataSurat['nomor_surat'],
                    $this->faker->month(),
                    $this->faker->year()
                ),
                'tanggal_terbit' => $newDataSurat['tanggal_terbit'],
            ],
            $newDataMahasiswa,
            $newDataTambahanSurat
        );

        // action
        $response = $this->put(
            route(
                'surat.edit',
                $this->faker->uuid()
            ),
            $dataForm
        );

        // test
        $this->assertGuest();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function itShouldNotSaveChangesOfDataSuratBecauseIdSuratIsNotFound()
    {
        // setup
        $kodeProdis = ProgramStudi::pluck('kode_program_studi');
        $newDataMahasiswa = factory(Mahasiswa::class,)->make([
            'program_studi' => $this->faker->randomElement($kodeProdis),
        ])->toArray();
        $newDataTambahanSurat = factory(IzinRiset::class)->make()->toArray();
        $newDataSurat = [
            'nomor_surat' => $this->faker->unique()->randomNumber(4),
            'tanggal_terbit' => $this->faker->date('Y-m-d'),
            'pemohon' => $newDataMahasiswa['nim']
        ];
        $dataForm = array_merge(
            [
                'nomor_surat' => sprintf(
                    "B-%04u/Un.05/III.4/TL.10/%02u/%u",
                    $newDataSurat['nomor_surat'],
                    $this->faker->month(),
                    $this->faker->year()
                ),
                'tanggal_terbit' => $newDataSurat['tanggal_terbit'],
            ],
            $newDataMahasiswa,
            $newDataTambahanSurat
        );

        // action
        $response = $this->actingAs($this->admin)->put(
            route(
                'surat.edit',
                $this->faker->uuid()
            ),
            $dataForm
        );

        // test
        $response->assertStatus(404);
    }
}
