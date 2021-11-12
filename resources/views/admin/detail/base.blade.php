<style>
    @page {
        width: 215.9mm;
        height: 355.6mm;
        margin: 10mm 0;
    }
    .detail-container .table-sm td {
        padding: 0rem .3rem;
        font-size: inherit;
        color: #000;
    }
    .detail-container p.first-line-indent {
        text-indent: 3rem;
    }
    .detail-container p.mini-margin {
        margin-bottom: .5rem;
    }
    .detail-container {
        font-family: 'Times New Roman', Times, serif;
        font-size: 1.2rem;
        line-height: 1.5;
        text-align: left;
        border: 2px solid #000;
        color: #000;
    }
</style>
<div class="container detail-container">
    <!-- Kop Surat -->
    <div class="row">
        <img src="{{ asset('storage/kop_surat.jpg') }}" class="img-fluid mx-auto d-block" style="width: 100%;">
    </div>
    <!-- end of Kop Surat -->

    <!-- Badan Surat -->
    <div class="mt-4 px-4">
        @yield('badan-surat')
    </div>
    <!-- end of Badan Surat -->
</div>
