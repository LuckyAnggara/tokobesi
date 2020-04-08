<script src="<?= base_url('assets/'); ?>plugins/switchery/switchery.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- bootstrap touchspin -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- fuse search js -->
<script src="<?= base_url('assets/'); ?>plugins/fuse-js/fuse.js" type="text/javascript"></script>

<!-- Modal-Effect -->
<script src="<?= base_url('assets/'); ?>plugins/custombox/dist/custombox.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/custombox/dist/legacy.min.js"></script>

<!-- Toastr js -->
<script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>


<script>
  $(document).ready(function() {
    $('#modal_detail_pembelian').on('hidden.bs.modal', function(e) {
      $(this)
        .find("input,textarea,select")
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
      $('#qty').val(1);
      $('#diskon').val(0);
      $("#select_nama_barang").val(null).trigger('change');
      $('#cari_barang').val('');
    });
    set_data_session_no_order_sebelumnya($('#no_order_po').text());
  })


  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

  function terbilang(angka) {
    var bilangan = angka;
    var kalimat = "";
    var angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
    var kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
    var tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun');
    var panjang_bilangan = bilangan.length;

    /* pengujian panjang bilangan */
    if (panjang_bilangan > 15) {
      kalimat = "Diluar Batas";
    } else {
      /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
      for (i = 1; i <= panjang_bilangan; i++) {
        angka[i] = bilangan.substr(-(i), 1);
      }

      var i = 1;
      var j = 0;

      /* mulai proses iterasi terhadap array angka */
      while (i <= panjang_bilangan) {
        subkalimat = "";
        kata1 = "";
        kata2 = "";
        kata3 = "";

        /* untuk Ratusan */
        if (angka[i + 2] != "0") {
          if (angka[i + 2] == "1") {
            kata1 = "Seratus";
          } else {
            kata1 = kata[angka[i + 2]] + " Ratus";
          }
        }

        /* untuk Puluhan atau Belasan */
        if (angka[i + 1] != "0") {
          if (angka[i + 1] == "1") {
            if (angka[i] == "0") {
              kata2 = "Sepuluh";
            } else if (angka[i] == "1") {
              kata2 = "Sebelas";
            } else {
              kata2 = kata[angka[i]] + " Belas";
            }
          } else {
            kata2 = kata[angka[i + 1]] + " Puluh";
          }
        }

        /* untuk Satuan */
        if (angka[i] != "0") {
          if (angka[i + 1] != "1") {
            kata3 = kata[angka[i]];
          }
        }

        /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
        if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
          subkalimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " ";
        }

        /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
        kalimat = subkalimat + kalimat;
        i = i + 3;
        j = j + 1;
      }

      /* mengganti Satu Ribu jadi Seribu jika diperlukan */
      if ((angka[5] == "0") && (angka[6] == "0")) {
        kalimat = kalimat.replace("Satu Ribu", "Seribu");
      }
    }
    return kalimat + " Rupiah";
  }

  function normalrupiah(angka) {

    var tanparp = angka.replace(/[^0-9]+/g, "");
    var tanparp = tanparp.replace("Rp", "");
    var tanparp = tanparp.replace(",-", "");
    var tanpatitik = tanparp.split(".").join("");
    return tanpatitik;
  }

  function set_data_session_no_order_sebelumnya(no_order) {
    sessionStorage.setItem("no_order_po", no_order);
  }
</script>


<script>
  // init script form
  $(document).ready(function() {
    cari_versi_select2();
    $('#tanggal_transaksi').datepicker({
      autoclose: true,
      todayHighlight: true
    });
    $('#tanggal_transaksi').on('click', function() {
      console.log($('#tanggal_transaksi').val());
    });

    $(window).bind('beforeunload', function() {
      $.ajax({
        url: '<?= base_url("po/pocabang/clear_keranjang_po/"); ?>' + sessionStorage.getItem("no_order_po"),
        success: function(data) {
          console.log('clear');
        }
      });
    })

    $("#select_nama_cabang").select2({
      ajax: {
        url: 'https://pusat.bbmakmur.com/api/info/kantor/get_data_cabang',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            query: params.term, // search term
          };
        },
        processResults: function(data) {
          var results = [];
          $.each(data, function(index, item) {
            results.push({
              id: item.kode_cabang,
              text: item.nama_cabang,
            });
          });
          return {
            results: results
          };
        },
      },
      placeholder: "Pilih Nama Cabang .. "
    });
  });

  // init cari barang
  // versi select2
  $('#simple').change(function() {
    cari_versi_select2();
    $('#cari_barang').hide();
    $("#result_page").empty();
    display_none = '<div class="col-12 text-center"><p>Cari Data Barang di Kolom Pencarian</p></div>';
    $("#result_page").append(display_none);
  });
  $('#advance').change(function() {
    $("#select_nama_barang").select2('destroy').hide();
    $('#select_nama_barang').val(null).trigger('change');
    $('#cari_barang').show();
  });


  function cari_versi_select2() {
    $("#select_nama_barang").select2({
      ajax: {
        url: '<?= base_url("po/pocabang/get_data_barang_versi_select2"); ?>',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            query: params.term, // search term
          };
        },
        processResults: function(data) {
          var results = [];
          $.each(data.data, function(index, item) {
            results.push({
              id: item.kode_barang,
              text: item.kode_barang + ' - ' + item.nama_barang,
              nama_satuan: item.nama_satuan,
            });
          });
          return {
            results: results
          };
        },
      },
      templateSelection: function(data, container) {
        // Add custom attributes to the <option> tag for the selected option
        $(data.element).attr('data-kode_barang', data.id);
        $(data.element).attr('data-nama_satuan', data.nama_satuan);
        return data.text;
      },
      placeholder: "Pencarian Barang, menggunakan Nama Barang atau Kode Barang .."
    }).on('select2:select', function(evt) {
      var kode_barang = $("#select_nama_barang option:selected").data('kode_barang');
      console.log(kode_barang)
      var satuan = $("#select_nama_barang option:selected").data('nama_satuan');
      choose_barang(kode_barang, satuan);
    });
  }
</script>

<!-- alert klik cari barang dan choose barang -->

<script>
  $('#dummy_harga_beli').on('keyup', function() {
    var input_harga_beli = $('#dummy_harga_beli');
    input_harga_beli.val(formatRupiah(input_harga_beli.val().toString(), 'Rp.'));
    $('#harga_beli').val(normalrupiah(input_harga_beli.val()));
  });

  $('#dummy_diskon').on('keyup', function() {
    var diskon = $('#dummy_diskon');
    diskon.val(formatRupiah(diskon.val().toString(), 'Rp.'));
    $('#diskon').val(normalrupiah(diskon.val()));
  });

  function choose_barang(kode_barang, satuan) {
    var input_harga_beli = $('#dummy_harga_beli');
    var label_kode_barang = $('#label_kode_barang');
    var label_satuan = $('#satuan');
    $("#qty").TouchSpin({
      min: 1,
      max: 9999999,
      step: 1,
      maxboostedstep: 10,
      decimals: 1,
      step: 0.1,
      postfix: satuan,
      buttondown_class: "btn btn-primary",
      buttonup_class: "btn btn-primary",
      postfix: satuan
    });

    input_harga_beli.val(formatRupiah("0", 'Rp.'));
    label_kode_barang.text(kode_barang);
    $('#dummy_diskon').val(formatRupiah('0', 'Rp.'));
    $('#modal_detail_pembelian').modal('show');
    $('#select_nama_barang').val(null).trigger('change');
  }

  $('#button-pembelian-add').on('click', function() {
    var no_order_po = $('#no_order_po').text();
    var kode_barang = $('#label_kode_barang').text();
    var jumlah = $('#qty').val();
    var harga_beli = $('#harga_beli').val();
    push_keranjang_po(kode_barang, jumlah, harga_beli);
    $('#select_nama_barang').val(null).trigger('change');
  });

  function warning_delete(id) {
    var no_order_po = $('#no_order_po').text();
    swal.fire({
      title: 'Apa anda yakin?',
      text: "Data akan di hapus dari Keranjang",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        swal.fire(
          'Deleted!',
          'Data telah dihapus!',
          'success'
        )
        deleteData_pembelian(id);
        push_total_perhitungan(no_order_po, 0);
        total_harga_keranjang();
        set_grand_total();
        // set_grand_total();
        if ($('#total_pembelian').text() == "Rp. 0") {
          $('#proses_button').attr('disabled', true);
          $('#grand_total_div').attr('hidden', true).fadeOut(1000);
        }
      }
    });
  }

  function deleteData_pembelian(id) {
    $.ajax({
      url: "<?= base_url('po/pocabang/delete_data_keranjang/'); ?>" + id,
      beforeSend: function() {
        $.LoadingOverlay("show");
      },
      complete: function() {
        $.LoadingOverlay("hide");
      },
      success: function(data) {
        $('#datatable-keranjang-po').DataTable().ajax.reload();
      }
    });
  }
</script>

<!-- Script Push Ke Keranjang Pembelian -->

<script>
  function push_keranjang_po(kode_barang, jumlah, harga_beli) {
    var cabang = $('#select_nama_cabang  option:selected').val();
    var no_order_po = $('#no_order_po').text();
    var tanggal_transaksi = $('#tanggal_transaksi').val();
    $('#proses_button').attr('disabled', false);
    $('#grand_total_div').attr('hidden', false);
    $.ajax({
      url: "<?= Base_url('po/pocabang/push_data_barang'); ?>",
      type: "post",
      data: {
        no_order_po: no_order_po,
        kode_barang: kode_barang,
        tanggal_transaksi: tanggal_transaksi,
        jumlah_pembelian: jumlah,
        harga_beli: harga_beli,
      },
      beforeSend: function() {
        $.LoadingOverlay("show");
      },
      complete: function() {
        $.LoadingOverlay("hide");
      },
      success: function(data) {
        $('#datatable-keranjang-po').DataTable().ajax.reload();
        push_total_perhitungan(no_order_po, 0);
        total_harga_keranjang();
        set_grand_total();
      }
    })
  }

  function total_harga_keranjang() {

    $.ajax({
      url: "<?= base_url("po/pocabang/get_sum_keranjang/"); ?>" + $('#no_order_po').text(),
      type: "post",
      dataType: "JSON",
      async: false,
      success: function(data) {
        if (data.total_harga == null) {
          $('#total_pembelian').text(formatRupiah('0', 'Rp.'));
        } else {
          $('#total_pembelian').text(formatRupiah(data.total_pembelian.toString(), 'Rp.'));
          $('#sub-total').text(formatRupiah((data.total_pembelian).toString(), 'Rp.'));
          //  $('#ongkir').val(formatRupiah(data.diskon, 'Rp.'));
          $('#grand_total').text(formatRupiah(data.total_harga, 'Rp.'));
        }
      }
    });
  }

  $('#apply_ongkir').on('click', function() {
    var ongkir = document.getElementById('ongkir');
    if (ongkir.value !== "") {
      var no_order_po = $('#no_order_po').text();
      var total_ongkir = normalrupiah($('#ongkir').val());
      push_total_perhitungan(no_order_po, total_ongkir);
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Biaya lainnya Belum di Isi!',
      });
    }
  });

  var ongkir = document.getElementById('ongkir');
  ongkir.addEventListener('keyup', function(e) {
    ongkir.value = formatRupiah(this.value, 'Rp. ');
    var ongkir_dummy = normalrupiah(ongkir.value);
  });

  function push_total_perhitungan(no_order, ongkir) {
    $.ajax({
      url: "<?= Base_url('po/pocabang/push_total_perhitungan'); ?>",
      type: "post",
      data: {
        no_order_po: no_order,
        ongkir: ongkir,
      },
      cache: false,
      success: function(data) {
        set_grand_total();
      }
    })
  }

  function push_grand_total(diskon, pajak) {
    var total_pembelian = normalrupiah($('#total_pembelian').text());
    var no_order_po = $('#no_order_po').text();
    var total1 = parseInt(total_pembelian) - diskon // data total setelah diskon
    var total2 = Math.round(total1 * (pajak / 100)); // data total setalah di tambah pajak 10%
    var grand_total = total1 + total2 // data grand_total setalah Pajak
    $.ajax({
      url: "<?= Base_url('po/pocabang/push_grand_total'); ?>",
      type: "post",
      data: {
        no_order_po: no_order_po,
        total_pembelian: total_pembelian,
        diskon: diskon,
        grand_total: grand_total
      },
      cache: false,
      async: false,
      success: function(data) {

      }
    })
  }

  function set_grand_total() {

    var total_pembelian = $('#total_pembelian');
    var no_order_po = $('#no_order_po').text();
    var diskon = $('#diskon');
    var ongkir = $('#ongkir'); // val
    var grand_total = $('#grand_total');

    $.ajax({
      url: '<?= base_url("po/pocabang/get_total_perhitungan/"); ?>' + no_order_po,
      type: "POST",
      dataType: "JSON",
      async: false,
      success: function(data) {
        // matematika
        // total order - diskon
        var total1 = parseInt(data.total_keranjang) - parseInt(data.diskon) // data total setelah diskon
        var total2 = total1 + parseInt(data.pajak) // data total setalah di tambah pajak 10%
        var total3 = total2 + parseInt(data.ongkir) // data grand_total setalah Pajak

        total_pembelian.text(formatRupiah(data.total_keranjang, 'Rp.'));
        diskon.text(formatRupiah(data.diskon, 'Rp.'));
        ongkir.val(formatRupiah(data.ongkir, 'Rp.'));
        //total_ongkir.val(formatRupiah(data.ongkir, 'Rp.'));
        //total_setelah_pajak.text(formatRupiah(total2.toString(), 'Rp.'));
        grand_total.text(formatRupiah(data.grand_total.toString(), 'Rp.'));
      }
    });
  }
</script>

<!-- Update Datatable Pembelian -->

<script>
  $(document).ready(function() {

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };

    //Init Datatabel Master Stock Persediaan
    var table = $('#datatable-keranjang-po').DataTable({
      "oLanguage": {
        sProcessing: "Sabar yah...",
        sZeroRecords: "Tidak ada Data..."
      },
      "searching": false,
      "processing": true,
      "ordering": false,
      "serverSide": true,
      "lengthChange": false,
      "paging": false,
      "ajax": {
        "url": '<?= base_url("po/pocabang/get_data_keranjang/"); ?>' + $('#no_order_po').text(),
        "type": "POST",
      },
      "columnDefs": [{
          targets: 0,
          render: function(data, type, full, meta) {
            return "";
          }
        },
        {
          data: "nama_barang",
          targets: 1,
          render: function(data, type, full, meta) {
            return data;
          }
        },
        {
          data: "harga_beli",
          targets: 2,
          render: function(data, type, full, meta) {
            var display = formatRupiah(data, 'Rp.');
            return display;
          }
        },
        {
          data: "jumlah_pembelian",
          targets: 3,
          render: function(data, type, full, meta) {
            var display = formatSatuan(data);
            return display;
          }
        },
        {
          data: "total_harga",
          targets: 4,
          render: function(data, type, full, meta) {
            var display = formatRupiah(data, 'Rp.');
            return display;
          }
        },
        {
          //title: "Action",
          data: "id",
          targets: 5,
          render: function(data, type, full, meta) {
            var display = '<a type="button" onClick="warning_delete(\'' + data + '\')" data-button="' + data + '" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Click untuk melakukan Hapus Data"><i class="fa fa-trash"></i> </a>';
            return display;
          }
        }
      ],
      "rowCallback": function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
      }
    });

    function formatSatuan(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

  });

  // push keranjang belanja
</script>

<!-- confirm -->

<script>
  $('#proses_button').on('click', function() {
    var nama_cabang = $('#select_nama_cabang').text();
    var tanggal = $('#tanggal_transaksi').val();
    var cek_keranjang = $('#total_pembelian').text();

    if (tanggal == "") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Tanggal Belum di Isi!'
      });
    } else if (nama_cabang == "") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Data Cabang Belum di Pilih!'
      });
    } else if (cek_keranjang == "Rp. 0") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Keranjang Pembelian Masih Kosong'
      });
    } else {
      Swal.fire({
        title: 'Apakah Anda Sudah Yakin?',
        text: "Data PO akan di Kirim ke Cabang : " + nama_cabang,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Proses !',
        cancelButtonText: 'Batal !',
      }).then((result) => {
        if (result.value) {
          proses();
        }
      })
    }
  });

  function proses() {
    var no_order_po = $('#no_order_po').text();
    var tanggal_transaksi = $('#tanggal_transaksi').val();
    var cabang = $('#select_nama_cabang  option:selected').val();
    var keterangan = $('#keterangan').text();
    $.ajax({
      url: "<?= Base_url('po/pocabang/proses'); ?>",
      type: "post",
      data: {
        no_order_po: no_order_po,
        cabang: cabang,
        tanggal_transaksi: tanggal_transaksi,
        keterangan: keterangan
      },
      beforeSend: function() {
        $.LoadingOverlay("show");
      },
      success: function(data) {
        if (data == 1) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Double Input / Nomor Order Sudah Ada!!',
            footer: '<button type="button" onClick="help()">Klik Saya untuk Mengatasi ini</button>'
          })
        } else {
          kirim();
          //   setTimeout(function() {
          //     window.location.replace("<?= base_url('manajemen_pembelian/daftartransaksipembelian/'); ?>")
          //   }, 3000);
          //   Swal.fire(
          //     'Proses!',
          //     'Data telah di Proses.',
          //     'success'
          //   ).then((result) => {
          //     if (result.value) {
          //       window.location.replace("<?= base_url('manajemen_pembelian/daftartransaksipembelian/'); ?>")
          //     }
          //   })
          // }
        }
      },
      complete: function(data) {
        $.LoadingOverlay("hide");
        $('.btn').attr('disabled', 'true');
        $('#datatable-keranjang-po').empty()
        // Hide image container
      }
    })
  }

  function url_tujuan(kode_cabang_tujuan) {
    var result;
    $.ajax({
      url: 'https://pusat.bbmakmur.com/api/info/kantor/get_url_cabang',
      type: "post",
      async: false,
      data: {
        kode_cabang: kode_cabang_tujuan
      },
      dataType: 'json',
      success: function(data) {
        result = data;
      }
    })
    return result;
  }

  function kirim() {
    var data = {};
    var no_order_po = $('#no_order_po').text();
    var kode_perusahaan = $('#kode_perusahaan').text();
    var tujuan = $('#select_nama_cabang  option:selected').val();
    var url = url_tujuan(tujuan)
    var aww = get_data_untuk_dikirim(no_order_po)
    data = aww;
    data['kode_perusahaan'] = kode_perusahaan
    data['tujuan'] = tujuan
    console.log(url)
    console.log(aww)
    if (url !== "") {
      $.ajax({
        url: 'https://' + url + '/api/po/receive',
        type: "post",
        data: data,
        beforeSend: function() {
          $.LoadingOverlay("show");
        },
        success: function(data) {
          if (data == 'sukses') {
            ubah_status(no_order_po)
            Swal.fire(
              'Terikirim!',
              'Silahkan hubungi tujuan untuk konfirmasi lebih lanjut.',
              'success'
            )
          } else {
            Swal.fire(
              'Oopss!',
              'Silahkan ulangi!',
              'error'
            )
          }
        },
        complete: function(data) {
          $.LoadingOverlay("hide");
        }
      })
    } else {
      Swal.fire(
        'Konseksi Error!',
        'PO belum terkirim, silahkan mengirim ulang di Menu Daftar PO Cabang!',
        'error'
      )
    }

  }

  function get_data_untuk_dikirim(no_order_po) {
    var result = {}
    $.ajax({
      url: "<?= base_url('po/pocabang/get_data_po'); ?>",
      type: "post",
      dataType: 'json',
      data: {
        no_order_po: no_order_po,
      },
      async: false,
      success: function(data) {
        result['no_order_po'] = data.no_order_po;
        result['tanggal_transaksi'] = data.tanggal_transaksi;
        result['total_pembelian'] = data.total_pembelian;
        result['biaya_lainnya'] = data.biaya_lainnya;
        result['grand_total'] = data.grand_total;
        result['keterangan'] = data.keterangan;
      }
    })
    return result;
  }

  function ubah_status(no_order_po) {
    $.ajax({
      url: "<?= base_url('po/pocabang/ubah_status_po'); ?>",
      type: "post",
      dataType: 'json',
      data: {
        no_order_po: no_order_po,
      },
    })
  }

  function help() {
    Swal.fire({
      icon: 'info',
      title: 'How',
      html: 'Silahkan cek terlebih dahulu ke Database Purchase Order Cabang' +
        'Jika nomor order <b>sudah ada</b>, sedangkan ini bukan duplikat entry' +
        'silahkan hubungi tim IT'
    })
  }
</script>