var canvas, canvasWidth, canvasHeight, canvasf;
var permasalahan, saran = [];
var id_sbk, no_st = '';

function toast(type, title, text) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    Toast.fire({
        type: type,
        title: title,
        text: text
    });
};

function prepareCanvas() {
    var canvasDiv = document.getElementById('cvsSign');
    canvas = document.createElement('canvas');
    canvas.setAttribute('width', document.getElementById("cvsSign").offsetWidth);
    canvas.setAttribute('height', document.getElementById("cvsSign").offsetHeight);
    canvas.setAttribute('id', 'canvas');
    canvasWidth = canvas.width;
    canvasHeight = canvas.height;
    canvasDiv.appendChild(canvas);
    if (typeof G_vmlCanvasManager != 'undefined') {
        canvas = G_vmlCanvasManager.initElement(canvas);
    }

    canvasf = new fabric.Canvas('canvas', {
        isDrawingMode: true,
        width: canvasWidth,
        height: canvasHeight,
        selection: false
    });

    canvasf.freeDrawingBrush.color = "rgb(0, 0, 0)";
    canvasf.freeDrawingBrush.width = 2;
}

function ambil_data_sbk() {
    $.ajax({
        type: 'POST',
        url: 'Main/ambil_data_sbk',
        dataType: 'JSON',
        async: false,
        data: {
            tgl: $('#tgl').val()
        },
        success: function(data) {
            id_sbk = data.id_sbk;
            no_st = data.no_st;
        },
        error: function() {
            toast('error', 'Gagal Menampilkan Data SBK');
        }
    });
}

function ambil_data_pegawai() {
    $.ajax({
        type: 'POST',
        url: 'Main/ambil_data_pegawai',
        dataType: 'JSON',
        success: function(data) {
            $('#nip').html('');
            $.each(data, function(key, val) {
                $('#nip').append(`<option id="${val.nip}" value="${val.nip}" data-nama="${val.nama}" data-gol="${val.gol}" data-status="${val.status}" data-pangkat="${val.pangkat}" data-jabatan="${val.jabatan}">${val.nama}</option>`);
            });
            $('#nip').selectpicker('refresh');
        },
        error: function() {
            toast('error', 'Gagal Menampilkan Data Pegawai');
        }
    });
}

function ambil_data_role() {
    $.ajax({
        type: 'POST',
        url: 'Main/ambil_data_role',
        dataType: 'JSON',
        success: function(data) {
            $('#role').html('');
            $.each(data, function(key, val) {
                $('#role').append(`<option value="${val.id_role}">${val.role}</option>`);
            });
            $('#role').selectpicker('refresh');
        },
        error: function() {
            toast('error', 'Gagal Menampilkan Data Role');
        }
    });
}

function ambil_data_petugas() {
    $.ajax({
        type: 'POST',
        url: 'Main/ambil_data_petugas',
        dataType: 'JSON',
        data: {
            tgl: $('#tgl').val()
        },
        success: function(data) {
            $('#data_petugas').html('');
            $.each(data, function(key, val) {
                $('#data_petugas').append(`
					<tr>
						<th>${key + 1}</th>
						<td>${val.nama}</td>
						<td>${val.role}</td>
						<td><button type='button' class='btn btn-danger btn-mini-round hapus_petugas' data-nip='${val.nip}' data-nama='${val.nama}'><i class='material-icons'>close</i></button></td>
					</tr>
				`);
            });
        },
        error: function() {
            toast('error', 'Gagal Menampilkan Data Petugas');
        }
    });
}

$('#data_petugas').on('click', '.hapus_petugas', function() {
    let nip = $(this).data('nip');
    let nama = $(this).data('nama');

    swal.fire({
        background: "#FFFFFF",
        title: "<label style='color:#000000'> Hapus Petugas? </label>",
        html: "<span style='color: #000000; font-size: 14px; margin: 0;'> " + nama + " </span><br>",
        showConfirmButton: true,
        confirmButtonColor: "#009688",
        confirmButtonText: "Yes",
        showCancelButton: true,
        cancelButtonColor: "#727b84",
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
    }).then((result) => {
        if (result.value) {
            hapus_petugas(nip);
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // do nothing
        }
    });
});

function hapus_petugas(vnip) {
    $.ajax({
        url: 'Main/hapus_petugas',
        type: 'POST',
        dataType: 'JSON',
        data: {
            tgl: $('#tgl').val(),
            nip: vnip
        },
        success: function() {
            toast('success', 'Petugas Berhasil Dihapus');
            ambil_data_petugas();
        },
        error: function() {
            toast('error', 'Gagal Menghapus Petugas');
            $('#simpan').prop('disabled', false);
        }
    });
}

$('#tgl').on('change', function(e) {
    $('#tgl2').html($('#tgl').val());
    $('#tgl3').val($('#tgl').val());
    $('#tgl4').val($('#tgl').val());
    $('#tgl5').val($('#tgl').val());
    ambil_data_sbk();
    ambil_data_petugas();
});

$('#tgl3').on('change', function(e) {
    $('#tgl').val($('#tgl3').val());
    $('#tgl2').html($('#tgl3').val());
    $('#tgl4').val($('#tgl3').val());
    $('#tgl5').val($('#tgl3').val());
    ambil_data_sbk();
    ambil_data_petugas();
    $('#laporan').click();
});

$('#tgl4').on('change', function(e) {
    $('#tgl').val($('#tgl4').val());
    $('#tgl2').html($('#tgl4').val());
    $('#tgl3').val($('#tgl4').val());
    $('#tgl5').val($('#tgl4').val());
    ambil_data_sbk();
    ambil_data_petugas();
});

$('#tgl5').on('change', function(e) {
    $('#tgl').val($('#tgl5').val());
    $('#tgl2').html($('#tgl5').val());
    $('#tgl3').val($('#tgl5').val());
    $('#tgl4').val($('#tgl5').val());
    ambil_data_sbk();
    ambil_data_petugas();
    $('#generateSBK').click();
});

$('#sign').on('click', function() {
    if ($('#nip').val() == '') {
        toast('info', 'Petugas Belum Dipilih');
        $('#nip').focus();
        return;
    }
    if ($('#role').val() == '') {
        toast('info', 'Petugas Sebagai Apa?');
        $('#role').focus();
        return;
    }

    // $('#SignModal').modal('show');
    // setTimeout(() => {
    // 	$("#cvsSign").empty();
    // 	prepareCanvas();
    // }, 500);

    simpan_data();
});

$('#clear').on('click', function() {
    canvasf.clear();
});

$('#simpan').on('click', function() {
    if (canvasf.getObjects().length == 0) {
        toast('info', 'Anda Belum Tanda Tangan');
        return;
    }

    simpan_data();
});

function simpan_data() {
    $('#simpan').prop('disabled', true);
    $.ajax({
        url: 'Main/simpan_data',
        type: 'POST',
        dataType: 'JSON',
        data: {
            tgl: $('#tgl').val(),
            nip: $('#nip').val(),
            nama: $('#' + $('#nip').val()).data('nama'),
            gol: $('#' + $('#nip').val()).data('gol'),
            status: $('#' + $('#nip').val()).data('status'),
            pangkat: $('#' + $('#nip').val()).data('pangkat'),
            jabatan: $('#' + $('#nip').val()).data('jabatan'),
            role: $('#role').val(),
            // sign: canvasf.toDataURL('image/png').replace('image/png', 'image/octet-stream')
        },
        success: function(data) {
            if (!data) {
                $('#simpan').prop('disabled', false);
                toast('info', 'Petugas Sudah Diinput');
                // $('#SignModal').modal('hide');
                // toast('info', 'Anda Sudah Tanda Tangan');
                ambil_data_petugas();
                $('body, html').animate({
                    scrollTop: $("#data_petugas").offset().top
                }, 1000);
            } else {
                $('#simpan').prop('disabled', false);
                toast('success', 'Petugas Berhasil Disimpan');
                // $('#SignModal').modal('hide');
                // toast('success', 'Tanda Tangan Berhasil Disimpan. Terimakasih');
                ambil_data_petugas();
                $('body, html').animate({
                    scrollTop: $("#data_petugas").offset().top
                }, 1000);
            }
            $('#nip').val('default').trigger('change');
            $('#role').val('default').trigger('change');
        },
        error: function() {
            toast('error', 'Gagal Menyimpan Petugas');
            $('#simpan').prop('disabled', false);
        }
    });
}

$('#laporan').on('click', function() {
    $('.collapse').removeClass('show');
    // $('#no_st').val('');
    $('#t1_psw_d').val('');
    $('#t1_kru_psw_d').val('');
    $('#t1_pnp_psw_d').val('');
    $('#t1_pnp_psw_d_suhu').val('');
    $('#t1_psw_b').val('');
    $('#t1_kru_psw_b').val('');
    $('#t1_pnp_psw_b').val('');
    $('#t1_pmrksn_sts_vksnasi').val('');
    $('#t1_pmrksn_sts_vksnasi_ms').val('');
    $('#t1_pmrksn_sts_vksnasi_tms').val('');
    $('#t1_pmrksn_sts_vksnasi_tms_als').val('');
    $('#t1_plyn_kshtn').val('');
    $('#t1_poli_tdk_mnlr').val('');
    $('#t1_poli_mnlr').val('');
    $('#t1_kgwtdrtn_mds').val('');
    $('#t1_plyn_kshtn_rujukan').val('');
    $('#t1_pmrksn_laik_trbng').val('');
    $('#t1_laik_trbng').val('');
    $('#t1_tdk_laik_trbng').val('');
    $('#t1_tdk_laik_trbng_dgnosa').val('');
    $('#t1_ijn_org_skt').val('');
    $('#t1_org_skt_d').val('');
    $('#t1_org_skt_b').val('');
    $('#t1_org_skt_tdk_mnlr').val('');
    $('#t1_org_skt_mnlr').val('');
    $('#t1_kmtn_jnzh').val('');
    $('#t1_kmtn_jnzh_dgnosa').val('');
    $('#t1_jnzh_tdk_mnlr').val('');
    $('#t1_jnzh_mnlr').val('');
    $('#t1_vksnasi_covid').val('');
    $('#t1_jml_dsnfksi').val('');
    $('#t1_lks_dsnfksi').val('');
    $('#t2_psw_d').val('');
    $('#t2_kru_psw_d').val('');
    $('#t2_pnp_psw_d').val('');
    $('#t2_pnp_psw_d_suhu').val('');
    $('#t2_psw_b').val('');
    $('#t2_kru_psw_b').val('');
    $('#t2_pnp_psw_b').val('');
    $('#t2_pmrksn_sts_vksnasi').val('');
    $('#t2_pmrksn_sts_vksnasi_ms').val('');
    $('#t2_pmrksn_sts_vksnasi_tms').val('');
    $('#t2_pmrksn_sts_vksnasi_tms_als').val('');
    $('#t2_plyn_kshtn').val('');
    $('#t2_poli_tdk_mnlr').val('');
    $('#t2_poli_mnlr').val('');
    $('#t2_kgwtdrtn_mds').val('');
    $('#t2_plyn_kshtn_rujukan').val('');
    $('#t2_pmrksn_laik_trbng').val('');
    $('#t2_laik_trbng').val('');
    $('#t2_tdk_laik_trbng').val('');
    $('#t2_tdk_laik_trbng_dgnosa').val('');
    $('#t2_ijn_org_skt').val('');
    $('#t2_org_skt_d').val('');
    $('#t2_org_skt_b').val('');
    $('#t2_org_skt_tdk_mnlr').val('');
    $('#t2_org_skt_mnlr').val('');
    $('#t2_kmtn_jnzh').val('');
    $('#t2_kmtn_jnzh_dgnosa').val('');
    $('#t2_jnzh_tdk_mnlr').val('');
    $('#t2_jnzh_mnlr').val('');
    $('#t2_jml_dsnfksi').val('');
    $('#t2_lks_dsnfksi').val('');
    $('#t2_pmrksn_snts_psw').val('');
    $('#t2_snts_psw_laik').val('');
    $('#t2_snts_psw_tdk_laik').val('');
    $('#t2_snts_psw_tdk_laik_tndkn').val('');
    $('#crg_ijn_angkt_jnzh').val('');
    $('#crg_ijn_angkt_jnzh_d').val('');
    $('#crg_ijn_angkt_jnzh_b').val('');
    $('#crg_jnzh_tdk_mnlr').val('');
    $('#crg_jnzh_mnlr').val('');
    $('#crg_jnzh_luar_ngri').val('');
    $('#crg_jnzh_dlm_ngri').val('');
    $('#crg_pmrksn_jnzh').val('');
    $('#crg_pmrksn_jnzh_d').val('');
    $('#crg_pmrksn_jnzh_b').val('');
    $('#crg_ijn_angkt_abu_jnzh').val('');
    $('#crg_ijn_angkt_abu_jnzh_d').val('');
    $('#crg_ijn_angkt_abu_jnzh_b').val('');
    ambil_data_laporan();
});

function ambil_data_laporan() {
    $.ajax({
        type: 'POST',
        url: 'Main/ambil_data_laporan',
        dataType: 'JSON',
        data: {
            id: id_sbk
        },
        success: function(data) {
            if (data != null) {
                // $('#no_st').val(data.no_st);
                $('#t1_psw_d').val(data.t1_psw_d);
                $('#t1_kru_psw_d').val(data.t1_kru_psw_d);
                $('#t1_pnp_psw_d').val(data.t1_pnp_psw_d);
                $('#t1_pnp_psw_d_suhu').val(data.t1_pnp_psw_d_suhu);
                $('#t1_psw_b').val(data.t1_psw_b);
                $('#t1_kru_psw_b').val(data.t1_kru_psw_b);
                $('#t1_pnp_psw_b').val(data.t1_pnp_psw_b);
                $('#t1_pmrksn_sts_vksnasi').val(data.t1_pmrksn_sts_vksnasi);
                $('#t1_pmrksn_sts_vksnasi_ms').val(data.t1_pmrksn_sts_vksnasi_ms);
                $('#t1_pmrksn_sts_vksnasi_tms').val(data.t1_pmrksn_sts_vksnasi_tms);
                $('#t1_pmrksn_sts_vksnasi_tms_als').val(data.t1_pmrksn_sts_vksnasi_tms_als);
                $('#t1_plyn_kshtn').val(data.t1_plyn_kshtn);
                $('#t1_poli_tdk_mnlr').val(data.t1_poli_tdk_mnlr);
                $('#t1_poli_mnlr').val(data.t1_poli_mnlr);
                $('#t1_kgwtdrtn_mds').val(data.t1_kgwtdrtn_mds);
                $('#t1_plyn_kshtn_rujukan').val(data.t1_plyn_kshtn_rujukan);
                $('#t1_pmrksn_laik_trbng').val(data.t1_pmrksn_laik_trbng);
                $('#t1_laik_trbng').val(data.t1_laik_trbng);
                $('#t1_tdk_laik_trbng').val(data.t1_tdk_laik_trbng);
                $('#t1_tdk_laik_trbng_dgnosa').val(data.t1_tdk_laik_trbng_dgnosa);
                $('#t1_ijn_org_skt').val(data.t1_ijn_org_skt);
                $('#t1_org_skt_d').val(data.t1_org_skt_d);
                $('#t1_org_skt_b').val(data.t1_org_skt_b);
                $('#t1_org_skt_tdk_mnlr').val(data.t1_org_skt_tdk_mnlr);
                $('#t1_org_skt_mnlr').val(data.t1_org_skt_mnlr);
                $('#t1_kmtn_jnzh').val(data.t1_kmtn_jnzh);
                $('#t1_kmtn_jnzh_dgnosa').val(data.t1_kmtn_jnzh_dgnosa);
                $('#t1_jnzh_tdk_mnlr').val(data.t1_jnzh_tdk_mnlr);
                $('#t1_jnzh_mnlr').val(data.t1_jnzh_mnlr);
                $('#t1_vksnasi_covid').val(data.t1_vksnasi_covid);
                $('#t1_jml_dsnfksi').val(data.t1_jml_dsnfksi);
                $('#t1_lks_dsnfksi').val(data.t1_lks_dsnfksi);
                $('#t2_psw_d').val(data.t2_psw_d);
                $('#t2_kru_psw_d').val(data.t2_kru_psw_d);
                $('#t2_pnp_psw_d').val(data.t2_pnp_psw_d);
                $('#t2_pnp_psw_d_suhu').val(data.t2_pnp_psw_d_suhu);
                $('#t2_psw_b').val(data.t2_psw_b);
                $('#t2_kru_psw_b').val(data.t2_kru_psw_b);
                $('#t2_pnp_psw_b').val(data.t2_pnp_psw_b);
                $('#t2_pmrksn_sts_vksnasi').val(data.t2_pmrksn_sts_vksnasi);
                $('#t2_pmrksn_sts_vksnasi_ms').val(data.t2_pmrksn_sts_vksnasi_ms);
                $('#t2_pmrksn_sts_vksnasi_tms').val(data.t2_pmrksn_sts_vksnasi_tms);
                $('#t2_pmrksn_sts_vksnasi_tms_als').val(data.t2_pmrksn_sts_vksnasi_tms_als);
                $('#t2_plyn_kshtn').val(data.t2_plyn_kshtn);
                $('#t2_poli_tdk_mnlr').val(data.t2_poli_tdk_mnlr);
                $('#t2_poli_mnlr').val(data.t2_poli_mnlr);
                $('#t2_kgwtdrtn_mds').val(data.t2_kgwtdrtn_mds);
                $('#t2_plyn_kshtn_rujukan').val(data.t2_plyn_kshtn_rujukan);
                $('#t2_pmrksn_laik_trbng').val(data.t2_pmrksn_laik_trbng);
                $('#t2_laik_trbng').val(data.t2_laik_trbng);
                $('#t2_tdk_laik_trbng').val(data.t2_tdk_laik_trbng);
                $('#t2_tdk_laik_trbng_dgnosa').val(data.t2_tdk_laik_trbng_dgnosa);
                $('#t2_ijn_org_skt').val(data.t2_ijn_org_skt);
                $('#t2_org_skt_d').val(data.t2_org_skt_d);
                $('#t2_org_skt_b').val(data.t2_org_skt_b);
                $('#t2_org_skt_tdk_mnlr').val(data.t2_org_skt_tdk_mnlr);
                $('#t2_org_skt_mnlr').val(data.t2_org_skt_mnlr);
                $('#t2_kmtn_jnzh').val(data.t2_kmtn_jnzh);
                $('#t2_kmtn_jnzh_dgnosa').val(data.t2_kmtn_jnzh_dgnosa);
                $('#t2_jnzh_tdk_mnlr').val(data.t2_jnzh_tdk_mnlr);
                $('#t2_jnzh_mnlr').val(data.t2_jnzh_mnlr);
                $('#t2_jml_dsnfksi').val(data.t2_jml_dsnfksi);
                $('#t2_lks_dsnfksi').val(data.t2_lks_dsnfksi);
                $('#t2_pmrksn_snts_psw').val(data.t2_pmrksn_snts_psw);
                $('#t2_snts_psw_laik').val(data.t2_snts_psw_laik);
                $('#t2_snts_psw_tdk_laik').val(data.t2_snts_psw_tdk_laik);
                $('#t2_snts_psw_tdk_laik_tndkn').val(data.t2_snts_psw_tdk_laik_tndkn);
                $('#crg_ijn_angkt_jnzh').val(data.crg_ijn_angkt_jnzh);
                $('#crg_ijn_angkt_jnzh_d').val(data.crg_ijn_angkt_jnzh_d);
                $('#crg_ijn_angkt_jnzh_b').val(data.crg_ijn_angkt_jnzh_b);
                $('#crg_jnzh_tdk_mnlr').val(data.crg_jnzh_tdk_mnlr);
                $('#crg_jnzh_mnlr').val(data.crg_jnzh_mnlr);
                $('#crg_jnzh_luar_ngri').val(data.crg_jnzh_luar_ngri);
                $('#crg_jnzh_dlm_ngri').val(data.crg_jnzh_dlm_ngri);
                $('#crg_pmrksn_jnzh').val(data.crg_pmrksn_jnzh);
                $('#crg_pmrksn_jnzh_d').val(data.crg_pmrksn_jnzh_d);
                $('#crg_pmrksn_jnzh_b').val(data.crg_pmrksn_jnzh_b);
                $('#crg_ijn_angkt_abu_jnzh').val(data.crg_ijn_angkt_abu_jnzh);
                $('#crg_ijn_angkt_abu_jnzh_d').val(data.crg_ijn_angkt_abu_jnzh_d);
                $('#crg_ijn_angkt_abu_jnzh_b').val(data.crg_ijn_angkt_abu_jnzh_b);
            }
            ambil_data_permasalahan();
        },
        error: function() {
            toast('error', 'Gagal Mengambil Data Permasalahan');
        }
    });
}

function ambil_data_permasalahan() {
    $.ajax({
        type: 'POST',
        url: 'Main/ambil_data_permasalahan',
        dataType: 'JSON',
        data: {
            id: id_sbk
        },
        success: function(data) {
            permasalahan = [];
            if (data.length > 0) {
                $.each(data, function(key, val) {
                    permasalahan.push(val.poin);
                });
            }
            tampil_permasalahan();
            ambil_data_saran();
        },
        error: function() {
            toast('error', 'Gagal Mengambil Data Permasalahan');
        }
    });
}

function ambil_data_saran() {
    $.ajax({
        type: 'POST',
        url: 'Main/ambil_data_saran',
        dataType: 'JSON',
        data: {
            id: id_sbk
        },
        success: function(data) {
            saran = [];
            if (data.length > 0) {
                $.each(data, function(key, val) {
                    saran.push(val.poin);
                });
            }
            tampil_saran();
            $('#ReportModal').modal('show');
        },
        error: function() {
            toast('error', 'Gagal Mengambil Data Saran');
        }
    });
}

$('#isi_tabel_permasalahan').on('click', '#simpan_permasalahan', function() {
    if ($('#permasalahan').val() == '') {
        toast('info', 'permasalahan belum dilengkapi');
        $("#permasalahan").focus();
        return;
    }

    permasalahan.push($('#permasalahan').val());
    tampil_permasalahan();
});

function tampil_permasalahan() {
    let html = '';
    permasalahan.forEach(function callback(val, ind) {
        html += `
      <tr>
        <td>${val}</td>
        <td><button type='button' class='btn btn-danger btn-mini-round hapus_permasalahan' data-ind="${ind}"><i class='material-icons'>remove</i></button></td>
      </tr>
    `;
    });
    html += `
    <tr>
			<td><textarea class="form-control" id="permasalahan" rows="3"></textarea></td>
			<td><button type='button' class='btn btn-primary btn-mini-round' id="simpan_permasalahan"><i class='material-icons'>check</i></button></td>
    </tr>
  `;
    $('#isi_tabel_permasalahan').html(html);
}

$('#isi_tabel_permasalahan').on('click', '.hapus_permasalahan', function() {
    permasalahan.splice($(this).data('ind'), 1);
    tampil_permasalahan();
});

$('#isi_tabel_saran').on('click', '#simpan_saran', function() {
    if ($('#saran').val() == '') {
        toast('info', 'saran belum dilengkapi');
        $("#saran").focus();
        return;
    }

    saran.push($('#saran').val());
    tampil_saran();
});

function tampil_saran() {
    let html = '';
    saran.forEach(function callback(val, ind) {
        html += `
      <tr>
        <td>${val}</td>
        <td><button type='button' class='btn btn-danger btn-mini-round hapus_saran' data-ind="${ind}"><i class='material-icons'>remove</i></button></td>
      </tr>
    `;
    });
    html += `
    <tr>
			<td><textarea class="form-control" id="saran" rows="3"></textarea></td>
			<td><button type='button' class='btn btn-primary btn-mini-round' id="simpan_saran"><i class='material-icons'>check</i></button></td>
    </tr>
  `;
    $('#isi_tabel_saran').html(html);
}

$('#isi_tabel_saran').on('click', '.hapus_saran', function() {
    saran.splice($(this).data('ind'), 1);
    tampil_saran();
});

$('#simpan2').on('click', function() {
    simpan_laporan();
});

function simpan_laporan() {
    $('#simpan2').prop('disabled', true);
    $.ajax({
        url: 'Main/simpan_laporan',
        type: 'POST',
        dataType: 'JSON',
        data: {
            id: id_sbk,
            tgl: $('#tgl3').val(),
            no_st: no_st,
            t1_psw_d: $('#t1_psw_d').val(),
            t1_kru_psw_d: $('#t1_kru_psw_d').val(),
            t1_pnp_psw_d: $('#t1_pnp_psw_d').val(),
            t1_pnp_psw_d_suhu: $('#t1_pnp_psw_d_suhu').val(),
            t1_psw_b: $('#t1_psw_b').val(),
            t1_kru_psw_b: $('#t1_kru_psw_b').val(),
            t1_pnp_psw_b: $('#t1_pnp_psw_b').val(),
            t1_pmrksn_sts_vksnasi: $('#t1_pmrksn_sts_vksnasi').val(),
            t1_pmrksn_sts_vksnasi_ms: $('#t1_pmrksn_sts_vksnasi_ms').val(),
            t1_pmrksn_sts_vksnasi_tms: $('#t1_pmrksn_sts_vksnasi_tms').val(),
            t1_pmrksn_sts_vksnasi_tms_als: $('#t1_pmrksn_sts_vksnasi_tms_als').val(),
            t1_plyn_kshtn: $('#t1_plyn_kshtn').val(),
            t1_poli_tdk_mnlr: $('#t1_poli_tdk_mnlr').val(),
            t1_poli_mnlr: $('#t1_poli_mnlr').val(),
            t1_kgwtdrtn_mds: $('#t1_kgwtdrtn_mds').val(),
            t1_plyn_kshtn_rujukan: $('#t1_plyn_kshtn_rujukan').val(),
            t1_pmrksn_laik_trbng: $('#t1_pmrksn_laik_trbng').val(),
            t1_laik_trbng: $('#t1_laik_trbng').val(),
            t1_tdk_laik_trbng: $('#t1_tdk_laik_trbng').val(),
            t1_tdk_laik_trbng_dgnosa: $('#t1_tdk_laik_trbng_dgnosa').val(),
            t1_ijn_org_skt: $('#t1_ijn_org_skt').val(),
            t1_org_skt_d: $('#t1_org_skt_d').val(),
            t1_org_skt_b: $('#t1_org_skt_b').val(),
            t1_org_skt_tdk_mnlr: $('#t1_org_skt_tdk_mnlr').val(),
            t1_org_skt_mnlr: $('#t1_org_skt_mnlr').val(),
            t1_kmtn_jnzh: $('#t1_kmtn_jnzh').val(),
            t1_kmtn_jnzh_dgnosa: $('#t1_kmtn_jnzh_dgnosa').val(),
            t1_jnzh_tdk_mnlr: $('#t1_jnzh_tdk_mnlr').val(),
            t1_jnzh_mnlr: $('#t1_jnzh_mnlr').val(),
            t1_vksnasi_covid: $('#t1_vksnasi_covid').val(),
            t1_jml_dsnfksi: $('#t1_jml_dsnfksi').val(),
            t1_lks_dsnfksi: $('#t1_lks_dsnfksi').val(),
            t2_psw_d: $('#t2_psw_d').val(),
            t2_kru_psw_d: $('#t2_kru_psw_d').val(),
            t2_pnp_psw_d: $('#t2_pnp_psw_d').val(),
            t2_pnp_psw_d_suhu: $('#t2_pnp_psw_d_suhu').val(),
            t2_psw_b: $('#t2_psw_b').val(),
            t2_kru_psw_b: $('#t2_kru_psw_b').val(),
            t2_pnp_psw_b: $('#t2_pnp_psw_b').val(),
            t2_pmrksn_sts_vksnasi: $('#t2_pmrksn_sts_vksnasi').val(),
            t2_pmrksn_sts_vksnasi_ms: $('#t2_pmrksn_sts_vksnasi_ms').val(),
            t2_pmrksn_sts_vksnasi_tms: $('#t2_pmrksn_sts_vksnasi_tms').val(),
            t2_pmrksn_sts_vksnasi_tms_als: $('#t2_pmrksn_sts_vksnasi_tms_als').val(),
            t2_plyn_kshtn: $('#t2_plyn_kshtn').val(),
            t2_poli_tdk_mnlr: $('#t2_poli_tdk_mnlr').val(),
            t2_poli_mnlr: $('#t2_poli_mnlr').val(),
            t2_kgwtdrtn_mds: $('#t2_kgwtdrtn_mds').val(),
            t2_plyn_kshtn_rujukan: $('#t2_plyn_kshtn_rujukan').val(),
            t2_pmrksn_laik_trbng: $('#t2_pmrksn_laik_trbng').val(),
            t2_laik_trbng: $('#t2_laik_trbng').val(),
            t2_tdk_laik_trbng: $('#t2_tdk_laik_trbng').val(),
            t2_tdk_laik_trbng_dgnosa: $('#t2_tdk_laik_trbng_dgnosa').val(),
            t2_ijn_org_skt: $('#t2_ijn_org_skt').val(),
            t2_org_skt_d: $('#t2_org_skt_d').val(),
            t2_org_skt_b: $('#t2_org_skt_b').val(),
            t2_org_skt_tdk_mnlr: $('#t2_org_skt_tdk_mnlr').val(),
            t2_org_skt_mnlr: $('#t2_org_skt_mnlr').val(),
            t2_kmtn_jnzh: $('#t2_kmtn_jnzh').val(),
            t2_kmtn_jnzh_dgnosa: $('#t2_kmtn_jnzh_dgnosa').val(),
            t2_jnzh_tdk_mnlr: $('#t2_jnzh_tdk_mnlr').val(),
            t2_jnzh_mnlr: $('#t2_jnzh_mnlr').val(),
            t2_jml_dsnfksi: $('#t2_jml_dsnfksi').val(),
            t2_lks_dsnfksi: $('#t2_lks_dsnfksi').val(),
            t2_pmrksn_snts_psw: $('#t2_pmrksn_snts_psw').val(),
            t2_snts_psw_laik: $('#t2_snts_psw_laik').val(),
            t2_snts_psw_tdk_laik: $('#t2_snts_psw_tdk_laik').val(),
            t2_snts_psw_tdk_laik_tndkn: $('#t2_snts_psw_tdk_laik_tndkn').val(),
            crg_ijn_angkt_jnzh: $('#crg_ijn_angkt_jnzh').val(),
            crg_ijn_angkt_jnzh_d: $('#crg_ijn_angkt_jnzh_d').val(),
            crg_ijn_angkt_jnzh_b: $('#crg_ijn_angkt_jnzh_b').val(),
            crg_jnzh_tdk_mnlr: $('#crg_jnzh_tdk_mnlr').val(),
            crg_jnzh_mnlr: $('#crg_jnzh_mnlr').val(),
            crg_jnzh_luar_ngri: $('#crg_jnzh_luar_ngri').val(),
            crg_jnzh_dlm_ngri: $('#crg_jnzh_dlm_ngri').val(),
            crg_pmrksn_jnzh: $('#crg_pmrksn_jnzh').val(),
            crg_pmrksn_jnzh_d: $('#crg_pmrksn_jnzh_d').val(),
            crg_pmrksn_jnzh_b: $('#crg_pmrksn_jnzh_b').val(),
            crg_ijn_angkt_abu_jnzh: $('#crg_ijn_angkt_abu_jnzh').val(),
            crg_ijn_angkt_abu_jnzh_d: $('#crg_ijn_angkt_abu_jnzh_d').val(),
            crg_ijn_angkt_abu_jnzh_b: $('#crg_ijn_angkt_abu_jnzh_b').val(),
            permasalahan: permasalahan,
            saran: saran
        },
        success: function(data) {
            $('#simpan2').prop('disabled', false);
            $('#ReportModal').modal('hide');
            let url = `Surat/sbk/${id_sbk}`;
            window.open(url);
        },
        error: function() {
            toast('error', 'Gagal Simpan Laporan');
            $('#simpan2').prop('disabled', false);
        }
    });
}

$('#generateSBK').on('click', function() {
    $('#no_st').val('');
    ambil_data_st();
});

function ambil_data_st() {
    $.ajax({
        type: 'POST',
        url: 'Main/ambil_data_st',
        dataType: 'JSON',
        data: {
            id: id_sbk
        },
        success: function(data) {
            if (data != null) {
                $('#no_st').val(data.no_st);
            }
            $('#STModal').modal('show');
        },
        error: function() {
            toast('error', 'Gagal Mengambil Data ST');
        }
    });
}

$('#simpan3').on('click', function() {
    if ($('#no_st').val() == '') {
        toast('info', 'Nomor Surat Tugas Belum Dilengkapi');
        $('#no_st').focus();
        return;
    }
    simpan_st();
});

function simpan_st() {
    $('#simpan3').prop('disabled', true);
    $.ajax({
        url: 'Main/simpan_st',
        type: 'POST',
        dataType: 'JSON',
        data: {
            id: id_sbk,
            tgl: $('#tgl5').val(),
            no_st: $('#no_st').val()
        },
        success: function(data) {
            $('#simpan3').prop('disabled', false);
            $('#STModal').modal('hide');
            let url = `Surat/st/${id_sbk}`;
            window.open(url);
        },
        error: function() {
            toast('error', 'Gagal Simpan Nomor ST');
            $('#simpan3').prop('disabled', false);
        }
    });
}

$('#generate').on('click', function() {
    $('#ExportModal').modal('show');
});

$('#export').on('click', function() {
    $('#ExportModal').modal('hide');
    if (id_sbk == undefined) {
        toast('info', 'Laporan kegiatan belum diinputkan');
        $("#laporan").click();
        return;
    }
    let url = `Surat/sbk/${id_sbk}`;
    window.open(url);
});

$('#export2').on('click', function() {
    $('#ExportModal').modal('hide');
    if (id_sbk == undefined) {
        toast('info', 'Laporan kegiatan belum diinputkan');
        $("#laporan").click();
        return;
    }
    let url = `Surat/sbk_word/${id_sbk}`;
    window.open(url);
});

$(document).ready(function() {
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });
    $('.datepicker').bootstrapMaterialDatePicker('setDate', moment());
    $('#tgl2').html($('#tgl').val());
    $('select').selectpicker();
    ambil_data_sbk();
    ambil_data_pegawai();
    ambil_data_role();
    ambil_data_petugas();
});