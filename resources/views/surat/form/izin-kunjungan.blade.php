@extends('surat.form.base')

@section('form-name', "Izin Kunjungan")

@section('additional-css-2')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/css/tempusdominus-bootstrap-4.min.css">
@endsection

@section('form')
    <input type="hidden" name="tipe_surat" value="izin-kunjungan">

    <div class="form-group">
        <label class="col-md-6" for="instansi_penerima">Tujuan Kunjungan</label>
        <div class="col-auto">
            <input id="instansi_penerima" name="instansi_penerima" type="text" placeholder="Nama Tujuan Observasi Ex: PT Jaya Abadi" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="alamat_instansi">Alamat Kunjungan</label>
        <div class="col-auto">
            <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" placeholder="Alamat Instansi Ex:Jl.A.H Nasution No.05" rows="3"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4" for="kota_instansi">Kota/Kabupaten</label>
        <div class="col-auto">
            <input id="kota_instansi" name="kota_instansi" type="text" placeholder="Kota tempat instansi berada" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="mata_kuliah">Mata Kuliah</label>
        <div class="col-auto">
            <input id="mata_kuliah" name="mata_kuliah" type="text" placeholder="Mata Kuliah" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="dosen_pengampu">Dosen Pengampu</label>
        <div class="col-auto">
            <input id="dosen_pengampu" name="dosen_pengampu" type="text" placeholder="Nama Dosen Pengampu Mata Kuliah" class="form-control">
        </div>
    </div>

	<div class="form-group">
		<label class="col-md-6" for="program_studi">Program Studi</label>
		<div class="col-auto">
            <select id="program_studi" name="program_studi" class="form-control selector" form="pengajuan-surat" data-width="100%">
                <option disabled selected hidden>Pilih Program Studi Anda</option>
                @foreach($program_studi as $prodi)
                <option value="{{ $prodi->kode_prodi }}">{{ $prodi->program_studi }}</option>
                @endforeach
            </select>
		</div>
	</div>

    <div class="form-group">
        <label class="col-md-6" for="semester">Semester</label>
        <div class="col-auto">
            <input id="semester" name="semester" type="text" placeholder="Isi dengan semester yang Anda jalani. Contoh: VIII" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="kelas">Kelas</label>
        <div class="col-auto">
            <input id="kelas" name="kelas" type="text" placeholder="Kelas Mata Kuliah" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-6" for="tanggal_kunjungan">Tanggal Kunjungan</label>
        <div class="col-auto">
            @php
            $useragent=$_SERVER['HTTP_USER_AGENT'];
            @endphp
            @if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            <input type="date" class="form-control" name="tanggal_kunjungan" placeholder="dd mm yyyy">
            @else
            <input id="date" type="text" class="form-control datetimepicker-input" name="tanggal_kunjungan" data-toggle="datetimepicker" data-target="#date">
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3" for="waktu_kunjungan">Jam</label>
        <div class="col-auto">
            @if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            <input type="time" class="form-control" name="waktu_kunjungan" placeholder="HH:mm">
            @else
            <input id="time" type="text" class="form-control datetimepicker-input" name="waktu_kunjungan" data-toggle="datetimepicker" data-target="#time">
            @endif
        </div>
    </div>
@endsection

@section('additional-scripts-2')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/js/tempusdominus-bootstrap-4.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#date').datetimepicker({
                defaultDate: new Date(),
                locale: "id-ID",
                format: "dddd, DD MMMM YYYY"
            });
            $('#time').datetimepicker({
                defaultDate: new Date(),
                locale: "id-ID",
                format: "HH:mm"
            });
        });
    </script>
@endsection