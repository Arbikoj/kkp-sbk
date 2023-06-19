<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SBK</title>
  <link rel="icon" href="<?php echo base_url('assets/images/favicon.ico') ?>" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url("assets/plugins/bootstrap/bootstrap.min.css") ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url("assets/css/main.css?" . now()) ?>" rel="stylesheet">
</head>

<body>
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <label>Karena tanda tangan SBK harus basah, maka tidak dilakukan tanda tangan secara digital lagi.</label>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <label>Layanan ini digunakan untuk mempermudah dalam membuat dokumen SBK secara otomatis.</label>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3>Pencatatan <strong>Petugas</strong></h3>
                <p class="mb-4">Pelaksanaan kekarantinaan kesehatan di bandara juanda.</p>
              </div>
              <label class="inputlabel" for="tgl">Tanggal</label>
              <div class="form-group first">
                <input type="text" class="form-control datepicker" id="tgl">
              </div>
              <label class="inputlabel" for="nip">Petugas</label>
              <div class="form-group">
                <select class="form-control live" id="nip" data-live-search="true" title="Pilih Petugas..."></select>
              </div>
              <label class="inputlabel" for="role">Sebagai</label>
              <div class="form-group last mb-4">
                <select class="form-control" id="role" title="Pilih Tugas Sebagai..."></select>
              </div>
              <button type="button" class="btn text-white btn-block btn-primary" id="sign">Simpan</button>
            </div>
          </div>
        </div>
        <div class="col-md-6 order-md-2">
          <div>
            <h3>Petugas<strong>Jaga</strong></h3>
            <p class="mb-2">Daftar petugas jaga tanggal <strong id="tgl2"></strong>.</p>
            <p><strong>Generate dokumen atau laporan harus tgl 1 atau 16</strong>.</p>
            <p><strong>Generate laporan ketika tgl 15 atau akhir bulan sudah terisi</strong>.</p>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Sebagai</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody id="data_petugas"></tbody>
            </table>
          </div>
          <br>
          <button type="button" class="btn text-white btn-block btn-primary mt-4" id="generateSBK">Generate Dokumen SBK</button>
          <!-- <button type="button" class="btn text-white btn-block btn-primary mt-4" id="laporan">Input Data Laporan Kegiatan</button> -->
          <button type="button" class="btn text-white btn-block btn-info mt-4" id="laporan">Generate Laporan SBK</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="SignModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tanda Tangan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 d-flex flex-column align-items-center position-relative">
              <div class="note">
                <small class="form-text text-muted">Tanda tangan didalam kotak</small>
                <button type="button" class="btn btn-primary btn-mini-round" id="clear"><i class='material-icons'>refresh</i></button>
              </div>
              <div class="cvs" id="cvsSign"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ReportModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Laporan Kegiatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center mb-3">
            <label for="tgl3" class="mr-3">Tanggal</label>
            <input type="text" class="form-control datepicker" id="tgl3">
          </div>
          <div class="accordion" id="accordionExample">
            <!-- <div class="card">
              <div class="card-header" id="headingST">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseST" aria-expanded="true" aria-controls="collapseST">
                    Surat Tugas
                  </button>
                </h2>
              </div>
              <div id="collapseST" class="collapse" aria-labelledby="headingST" data-parent="#accordionExample">
                <div class="card-body">
                  <label class="inputlabel" for="no_st">No Surat Tugas</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="no_st" class="form-control" placeholder="Masukkan Nomor Surat Tugas">
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="card">
              <div class="card-header" id="headingT1">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseT1" aria-expanded="true" aria-controls="collapseT1">
                    Hasil Terminal 1
                  </button>
                </h2>
              </div>
              <div id="collapseT1" class="collapse" aria-labelledby="headingT1" data-parent="#accordionExample">
                <div class="card-body">
                  <label class="inputlabel" for="t1_psw_d">Jumlah Pesawat Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_psw_d" class="form-control" placeholder="Masukkan Jumlah Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_kru_psw_d">Jumlah Kru Pesawat Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_kru_psw_d" class="form-control" placeholder="Masukkan Jumlah Kru Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_pnp_psw_d">Jumlah Penumpang Pesawat Kedatangan(&lt;37,5&#8451;)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_pnp_psw_d" class="form-control" placeholder="Masukkan Jumlah Penumpang Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_pnp_psw_d_suhu">Jumlah Penumpang Pesawat Kedatangan (&gt;37,5&#8451;)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_pnp_psw_d_suhu" class="form-control" placeholder="Masukkan Jumlah Penumpang Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_psw_b">Jumlah Pesawat Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_psw_b" class="form-control" placeholder="Masukkan Jumlah Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_kru_psw_b">Jumlah Kru Pesawat Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_kru_psw_b" class="form-control" placeholder="Masukkan Jumlah Kru Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_pnp_psw_b">Jumlah Penumpang Pesawat Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_pnp_psw_b" class="form-control" placeholder="Masukkan Jumlah Penumpang Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_pmrksn_sts_vksnasi">Jumlah Pemeriksaan Status Vaksinasi</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_pmrksn_sts_vksnasi" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_pmrksn_sts_vksnasi_ms">Jumlah Pemeriksaan Status Vaksinasi (MS)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_pmrksn_sts_vksnasi_ms" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_pmrksn_sts_vksnasi_tms">Jumlah Pemeriksaan Status Vaksinasi (TMS)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_pmrksn_sts_vksnasi_tms" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_pmrksn_sts_vksnasi_tms_als">Keterangan Pemeriksaan Status Vaksinasi (TMS)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t1_pmrksn_sts_vksnasi_tms_als" class="form-control" placeholder="Masukkan Keterangan Pemeriksaan" maxlength="100">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_plyn_kshtn">Jumlah Pelayanan Kesehatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_plyn_kshtn" class="form-control" placeholder="Masukkan Jumlah Pelayanan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_poli_tdk_mnlr">Jumlah Kunjungan Klinik Bukan Penyakit Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_poli_tdk_mnlr" class="form-control" placeholder="Masukkan Jumlah Kunjungan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_poli_mnlr">Jumlah Kunjungan Klinik Penyakit Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_poli_mnlr" class="form-control" placeholder="Masukkan Jumlah Kunjungan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_kgwtdrtn_mds">Jumlah Penanganan Kegawadaruratan Medis</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_kgwtdrtn_mds" class="form-control" placeholder="Masukkan Jumlah Penanganan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_plyn_kshtn_rujukan">Jumlah Pelayanan Kesehatan Rujukan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_plyn_kshtn_rujukan" class="form-control" placeholder="Masukkan Jumlah Rujukan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_pmrksn_laik_trbng">Jumlah Pemeriksaan Laik Terbang</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_pmrksn_laik_trbng" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_laik_trbng">Jumlah Hasil Laik Terbang</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_laik_trbng" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_tdk_laik_trbng">Jumlah Hasil Tidak Laik Terbang</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_tdk_laik_trbng" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_tdk_laik_trbng_dgnosa">Diagnosa Hasil Tidak Laik Terbang</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t1_tdk_laik_trbng_dgnosa" class="form-control" placeholder="Masukkan Diagnosa Pemeriksaan" maxlength="100">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_ijn_org_skt">Jumlah Pengawasan Orang Sakit</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_ijn_org_skt" class="form-control" placeholder="Masukkan Jumlah Pengawasan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_org_skt_d">Jumlah Orang Sakit Dari Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_org_skt_d" class="form-control" placeholder="Masukkan Jumlah Orang Sakit">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_org_skt_b">Jumlah Orang Sakit Dari Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_org_skt_b" class="form-control" placeholder="Masukkan Jumlah Orang Sakit">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_org_skt_tdk_mnlr">Jumlah Orang Sakit Tidak Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_org_skt_tdk_mnlr" class="form-control" placeholder="Masukkan Jumlah Orang Sakit">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_org_skt_mnlr">Jumlah Orang Sakit Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_org_skt_mnlr" class="form-control" placeholder="Masukkan Jumlah Orang Sakit">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_kmtn_jnzh">Jumlah Penanganan Kasus Kematian</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_kmtn_jnzh" class="form-control" placeholder="Masukkan Jumlah Kasus Kematian">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_kmtn_jnzh_dgnosa">Diagnosa Kematian</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t1_kmtn_jnzh_dgnosa" class="form-control" placeholder="Masukkan Diagnosa Kematian" maxlength="100">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_jnzh_tdk_mnlr">Jumlah Kematian Penyakit Tidak Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_jnzh_tdk_mnlr" class="form-control" placeholder="Masukkan Jumlah Kematian">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_jnzh_mnlr">Jumlah Kematian Penyakit Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_jnzh_mnlr" class="form-control" placeholder="Masukkan Jumlah Kematian">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_vksnasi_covid">Jumlah Vaksinasi Covid</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_vksnasi_covid" class="form-control" placeholder="Masukkan Jumlah Vaksinasi">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_jml_dsnfksi">Jumlah Desinfeksi</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t1_jml_dsnfksi" class="form-control" placeholder="Masukkan Jumlah Vaksinasi">
                    </div>
                  </div>
                  <label class="inputlabel" for="t1_lks_dsnfksi">Lokasi Desinfeksi</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t1_lks_dsnfksi" class="form-control" placeholder="Masukkan Lokasi Desinfeksi" maxlength="100">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingT2">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseT2" aria-expanded="false" aria-controls="collapseT2">
                    Hasil Terminal 2
                  </button>
                </h2>
              </div>
              <div id="collapseT2" class="collapse" aria-labelledby="headingT2" data-parent="#accordionExample">
                <div class="card-body">
                  <label class="inputlabel" for="t2_psw_d">Jumlah Pesawat Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_psw_d" class="form-control" placeholder="Masukkan Jumlah Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_kru_psw_d">Jumlah Kru Pesawat Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_kru_psw_d" class="form-control" placeholder="Masukkan Jumlah Kru Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pnp_psw_d">Jumlah Penumpang Pesawat Kedatangan (&lt;37,5&#8451;)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_pnp_psw_d" class="form-control" placeholder="Masukkan Jumlah Penumpang Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pnp_psw_d_suhu">Jumlah Penumpang Pesawat Kedatangan (&gt;37,5&#8451;)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_pnp_psw_d_suhu" class="form-control" placeholder="Masukkan Jumlah Penumpang Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_psw_b">Jumlah Pesawat Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_psw_b" class="form-control" placeholder="Masukkan Jumlah Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_kru_psw_b">Jumlah Kru Pesawat Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_kru_psw_b" class="form-control" placeholder="Masukkan Jumlah Kru Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pnp_psw_b">Jumlah Penumpang Pesawat Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_pnp_psw_b" class="form-control" placeholder="Masukkan Jumlah Penumpang Pesawat">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pmrksn_sts_vksnasi">Jumlah Pemeriksaan Status Vaksinasi</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_pmrksn_sts_vksnasi" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pmrksn_sts_vksnasi_ms">Jumlah Pemeriksaan Status Vaksinasi (MS)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_pmrksn_sts_vksnasi_ms" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pmrksn_sts_vksnasi_tms">Jumlah Pemeriksaan Status Vaksinasi (TMS)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_pmrksn_sts_vksnasi_tms" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pmrksn_sts_vksnasi_tms_als">Keterangan Pemeriksaan Status Vaksinasi (TMS)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t2_pmrksn_sts_vksnasi_tms_als" class="form-control" placeholder="Masukkan Keterangan Pemeriksaan" maxlength="100">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_plyn_kshtn">Jumlah Pelayanan Kesehatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_plyn_kshtn" class="form-control" placeholder="Masukkan Jumlah Pelayanan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_poli_tdk_mnlr">Jumlah Kunjungan Klinik Bukan Penyakit Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_poli_tdk_mnlr" class="form-control" placeholder="Masukkan Jumlah Kunjungan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_poli_mnlr">Jumlah Kunjungan Klinik Penyakit Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_poli_mnlr" class="form-control" placeholder="Masukkan Jumlah Kunjungan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_kgwtdrtn_mds">Jumlah Penanganan Kegawadaruratan Medis</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_kgwtdrtn_mds" class="form-control" placeholder="Masukkan Jumlah Penanganan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_plyn_kshtn_rujukan">Jumlah Pelayanan Kesehatan Rujukan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_plyn_kshtn_rujukan" class="form-control" placeholder="Masukkan Jumlah Rujukan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pmrksn_laik_trbng">Jumlah Pemeriksaan Laik Terbang</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_pmrksn_laik_trbng" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_laik_trbng">Jumlah Hasil Laik Terbang</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_laik_trbng" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_tdk_laik_trbng">Jumlah Hasil Tidak Laik Terbang</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_tdk_laik_trbng" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_tdk_laik_trbng_dgnosa">Diagnosa Hasil Tidak Laik Terbang</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t2_tdk_laik_trbng_dgnosa" class="form-control" placeholder="Masukkan Diagnosa Pemeriksaan" maxlength="100">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_ijn_org_skt">Jumlah Pengawasan Orang Sakit</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_ijn_org_skt" class="form-control" placeholder="Masukkan Jumlah Pengawasan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_org_skt_d">Jumlah Orang Sakit Dari Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_org_skt_d" class="form-control" placeholder="Masukkan Jumlah Orang Sakit">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_org_skt_b">Jumlah Orang Sakit Dari Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_org_skt_b" class="form-control" placeholder="Masukkan Jumlah Orang Sakit">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_org_skt_tdk_mnlr">Jumlah Orang Sakit Tidak Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_org_skt_tdk_mnlr" class="form-control" placeholder="Masukkan Jumlah Orang Sakit">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_org_skt_mnlr">Jumlah Orang Sakit Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_org_skt_mnlr" class="form-control" placeholder="Masukkan Jumlah Orang Sakit">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_kmtn_jnzh">Jumlah Penanganan Kasus Kematian</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_kmtn_jnzh" class="form-control" placeholder="Masukkan Jumlah Kasus Kematian">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_kmtn_jnzh_dgnosa">Diagnosa Kematian</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t2_kmtn_jnzh_dgnosa" class="form-control" placeholder="Masukkan Diagnosa Kematian" maxlength="100">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_jnzh_tdk_mnlr">Jumlah Kematian Penyakit Tidak Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_jnzh_tdk_mnlr" class="form-control" placeholder="Masukkan Jumlah Kematian">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_jnzh_mnlr">Jumlah Kematian Penyakit Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_jnzh_mnlr" class="form-control" placeholder="Masukkan Jumlah Kematian">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_jml_dsnfksi">Jumlah Desinfeksi</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_jml_dsnfksi" class="form-control" placeholder="Masukkan Jumlah Vaksinasi">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_lks_dsnfksi">Lokasi Desinfeksi</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t2_lks_dsnfksi" class="form-control" placeholder="Masukkan Lokasi Desinfeksi" maxlength="100">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_pmrksn_snts_psw">Jumlah Pemeriksaan Sanitasi Pesawat</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_pmrksn_snts_psw" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_snts_psw_laik">Jumlah Pemeriksaan Sanitasi Pesawat (Laik)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_snts_psw_laik" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_snts_psw_tdk_laik">Jumlah Pemeriksaan Sanitasi Pesawat (Tidak Laik)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="t2_snts_psw_tdk_laik" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="t2_snts_psw_tdk_laik_tndkn">Tindakan Sanitasi Pesawat (Tidak Laik)</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="t2_snts_psw_tdk_laik_tndkn" class="form-control" placeholder="Masukkan Tindakan" maxlength="100">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingCargo">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCargo" aria-expanded="false" aria-controls="collapseCargo">
                    Hasil Terminal Cargo
                  </button>
                </h2>
              </div>
              <div id="collapseCargo" class="collapse" aria-labelledby="headingCargo" data-parent="#accordionExample">
                <div class="card-body">
                  <label class="inputlabel" for="crg_ijn_angkt_jnzh">Jumlah Izin Angkut Jenazah</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_ijn_angkt_jnzh" class="form-control" placeholder="Masukkan Jumlah Izin">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_ijn_angkt_jnzh_d">Jumlah Izin Angkut Jenazah Dari Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_ijn_angkt_jnzh_d" class="form-control" placeholder="Masukkan Jumlah Izin">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_ijn_angkt_jnzh_b">Jumlah Izin Angkut Jenazah Dari Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_ijn_angkt_jnzh_b" class="form-control" placeholder="Masukkan Jumlah Izin">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_jnzh_tdk_mnlr">Jumlah Jenazah Tidak Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_jnzh_tdk_mnlr" class="form-control" placeholder="Masukkan Jumlah Jenazah">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_jnzh_mnlr">Jumlah Jenazah Menular</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_jnzh_mnlr" class="form-control" placeholder="Masukkan Jumlah Jenazah">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_jnzh_luar_ngri">Jumlah Jenazah Luar Negeri</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_jnzh_luar_ngri" class="form-control" placeholder="Masukkan Jumlah Jenazah">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_jnzh_dlm_ngri">Jumlah Jenazah Dalam Negeri</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_jnzh_dlm_ngri" class="form-control" placeholder="Masukkan Jumlah Jenazah">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_pmrksn_jnzh">Jumlah Pemeriksaan Jenazah</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_pmrksn_jnzh" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_pmrksn_jnzh_d">Jumlah Pemeriksaan Jenazah Dari Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_pmrksn_jnzh_d" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_pmrksn_jnzh_b">Jumlah Pemeriksaan Jenazah Dari Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_pmrksn_jnzh_b" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_ijn_angkt_abu_jnzh">Jumlah Izin Angkut Abu Jenazah</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_ijn_angkt_abu_jnzh" class="form-control" placeholder="Masukkan Jumlah Izin">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_ijn_angkt_abu_jnzh_d">Jumlah Izin Angkut Abu Jenazah Dari Kedatangan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_ijn_angkt_abu_jnzh_d" class="form-control" placeholder="Masukkan Jumlah Izin">
                    </div>
                  </div>
                  <label class="inputlabel" for="crg_ijn_angkt_abu_jnzh_b">Jumlah Izin Angkut Abu Jenazah Dari Keberangkatan</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" id="crg_ijn_angkt_abu_jnzh_b" class="form-control" placeholder="Masukkan Jumlah Izin">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingSP">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseSP" aria-expanded="true" aria-controls="collapseSP">
                    Permasalahan
                  </button>
                </h2>
              </div>
              <div id="collapseSP" class="collapse" aria-labelledby="headingSP" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-vcenter" style="width:100%" id="tabel_permasalahan">
                      <thead>
                        <tr>
                          <th>Permasalahan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="isi_tabel_permasalahan">
                        <tr>
                          <td><textarea class="form-control" id="permasalahan" rows="3"></textarea></td>
                          <td><button type='button' class='btn btn-primary btn-mini-round' id="simpan_permasalahan"><i class='material-icons'>check</i></button></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingSS">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseSS" aria-expanded="true" aria-controls="collapseSS">
                    Saran - saran
                  </button>
                </h2>
              </div>
              <div id="collapseSS" class="collapse" aria-labelledby="headingSS" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-vcenter" style="width:100%" id="tabel_saran">
                      <thead>
                        <tr>
                          <th>Saran</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="isi_tabel_saran">
                        <tr>
                          <td><textarea class="form-control" id="saran" rows="3"></textarea></td>
                          <td><button type='button' class='btn btn-primary btn-mini-round' id="simpan_saran"><i class='material-icons'>check</i></button></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="simpan2">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ExportModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Generate Dokumen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center mb-3">
            <label for="tgl4" class="mr-3">Tanggal</label>
            <input type="text" class="form-control datepicker" id="tgl4">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="export">Export PDF</button>
          <button type="button" class="btn btn-primary hide" id="export2">Export Word</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="STModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Dokumen SBK</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label class="inputlabel" for="tgl5">Tanggal</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text" id="tgl5" class="form-control datepicker" placeholder="Pilih Tanggal">
            </div>
          </div>
          <label class="inputlabel" for="no_st">No Surat Tugas</label>
          <div class="form-group">
            <div class="form-line">
              <input type="text" id="no_st" class="form-control" placeholder="Masukkan Nomor Surat Tugas">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="simpan3">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url("assets/plugins/jquery/jquery-3.3.1.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/plugins/popper/popper.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/plugins/bootstrap/bootstrap.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/plugins/bootstrap-select/js/bootstrap-select.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/plugins/momentjs/moment.js") ?>"></script>
  <script src="<?php echo base_url("assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js") ?>"></script>
  <script src="<?php echo base_url('assets/plugins/fabric/fabric_with_gestures.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
  <script src="<?php echo base_url("assets/js/main.js?" . now()) ?>"></script>
</body>

</html>