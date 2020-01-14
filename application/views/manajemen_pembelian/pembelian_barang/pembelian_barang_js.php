<script src="<?= base_url('assets/'); ?>plugins/switchery/switchery.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/responsive.bootstrap4.min.js"></script>

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
</script>


<script>
  // init script form
  $(document).ready(function() {
    cari_versi_select2();
    $('#tanggal_transaksi').datepicker({
      autoclose: true,
      todayHighlight: true
    });
    $.ajax({
      url: '<?= base_url("Manajemen_Pembelian/PembelianBarang/clear_keranjang_pembelian/"); ?>' + sessionStorage.getItem("no_order_pembelian"),
    });

    $("#select_nama_supplier").select2({
      ajax: {
        url: '<?= base_url("Manajemen_Pembelian/PembelianBarang/get_data_supplier"); ?>',
        type: "post",
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          var results = [];
          for (var i in data) {
            results.push({
              "id": data[i].kode_supplier,
              "text": data[i].nama_supplier
            });
          };
          return {
            results: results
          };
        },
      },
      placeholder: "Pilih Nama Supplier .. "
    });
  });

  // init cari barang
  // versi select2
  $('#cari_barang').hide();
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

  $('#check_type').change(function() {
    if (this.checked) {
      $("#select_nama_barang").select2('destroy').hide();
      $('#select_nama_barang').val(null).trigger('change');
      $('#cari_barang').show();
    } else {
      cari_versi_select2();
      $('#cari_barang').hide();
      $("#result_page").empty();
      display_none = '<div class="col-12 text-center"><p>Cari Data Barang di Kolom Pencarian</p></div>';
      $("#result_page").append(display_none);
    }
  })

  function cari_versi_select2() {
    $("#select_nama_barang").select2({
      ajax: {
        url: '<?= base_url("Manajemen_Pembelian/PembelianBarang/get_data_barang_versi_select2"); ?>',
        type: "post",
        dataType: 'json',
        delay: 250,
        // data: function(params) {
        //   return {
        //     search_term: params.term
        //   };
        // },
        processResults: function(data) {
          var results = [];
          for (var i in data.data) {
            results.push({
              "id": data.data[i].tipe_barang + '-' + data.data[i].kode_barang + '-' + data.data[i].nama_barang + '-' + data.data[i].nama_satuan + '-' + data.data[i].jumlah_persediaan + '-' + data.data[i].jumlah_keranjang + '-' + data.data[i].status_jual,
              "text": data.data[i].kode_barang + ' - ' + data.data[i].nama_barang
            });
          };
          return {
            results: results
          };
        },
      },
      placeholder: "Pencarian Barang, menggunakan Nama Barang atau Kode Barang .."
    }).on('select2:select', function(evt) {
      var data = $("#select_nama_barang option:selected").val();
      str = data.split("-");
      var tipe_barang = str[0]
      var kode_barang = str[1];
      var nama_barang = str[2];
      var nama_satuan = str[3];
      var jumlah_persediaan = str[4];
      var jumlah_keranjang = str[5];
      var status_jual = str[6];
      choose_barang(tipe_barang, kode_barang, nama_barang, nama_satuan, jumlah_persediaan, jumlah_keranjang, status_jual);
    });
  }

  // versi advance ada gambar
  var input_search = $('#cari_barang');
  input_search.on('keyup', function() {
    search(input_search.val());
  })

  function search(kata_kunci) {
    if (kata_kunci !== "") {
      $.ajax({
        url: '<?= base_url("Manajemen_Pembelian/PembelianBarang/get_data_barang/"); ?>' + kata_kunci,
        type: "POST",
        dataType: "JSON",
        async: false,
        success: function(data) {
          if (data.jumlah_data > 0) {
            $("#result_page").empty();
            for (var i in data.data) {
              var display2 = '<div id="result"  class="col-md-6 col-lg-3"><div class="card gal-detail thumb"><a type="button" id="wawa" onclick="choose_barang(\'' + data.data[i].tipe_barang + '\',\'' + data.data[i].kode_barang + '\',\'' + data.data[i].nama_barang + '\',\'' + data.data[i].nama_satuan + '\',\'' + data.data[i].jumlah_persediaan + '\',\'' + data.data[i].jumlah_keranjang + '\',\'' + data.data[i].status_jual + '\')" ><img class="img-thumbnail img-responsive" alt="profile-image" src="<?= base_url('assets/images/barang/'); ?>' + data.data[i].gambar + '" alt="Tidak ada Gambar"><h5 >' + data.data[i].nama_barang + '</h4><p class="card-text">' + data.data[i].keterangan + '</p></a></div></div>';
              // var display = '<div id="result" class="col-md-6 col-lg-3"><div class="card"><a id="wawa" onclick="choose_barang(\'' + data.data[i].kode_barang + '\',\'' + data.data[i].nama_barang + '\',\'' + data.data[i].satuan + '\',\'' + data.data[i].jumlah_persediaan + '\',\'' + data.data[i].jumlah_keranjang + '\')"><img class="card-img-top img-fluid" src="<?= base_url('assets/images/barang/'); ?>' + data.data[i].gambar + '" alt="Tidak ada Gambar"><div class="card-body"><h4 class="card-title">' + data.data[i].nama_barang + '</h4></div><div class="card-body"><p class="card-text">' + data.data[i].keterangan + '</p></div></div></a></div>'
              $('#result_page').append(display2).fadeIn('slow');
            }
          } else {
            $("#result_page").empty();
            display_none = '<div class="col-12 text-center"><p>Data Barang ' + kata_kunci + ' tidak ditemukan </p></div>';
            $("#result_page").append(display_none);
          }
        }
      });
    } else {
      $("#result_page").empty();
      display_none = '<div class="col-12 text-center"><p>Cari Data Barang di Kolom Pencarian</p></div>';
      $("#result_page").append(display_none);
    }
  }
</script>

<!-- alert klik cari barang dan choose barang -->

<script>
  function choose_barang(tipe_barang, kode_barang, nama_barang, nama_satuan, jumlah_persediaan, jumlah_keranjang, status_jual) {
    quantityalert(kode_barang, nama_satuan, jumlah_persediaan, jumlah_keranjang);
  }

  function quantityalert(kode_barang, satuan, sisa_persediaan, jumlah_keranjang) {
    Swal.mixin({
      input: 'text',
      inputAttributes: {
        autocomplete: 'off',
        autocapitalize: 'off',
        autocorrect: 'off',
        id: 'input_label'
      },
      confirmButtonText: 'Submit &rarr;',
      showCancelButton: true,
      inputValidator: (value) => {
        if (!value) {
          return 'Jumlah pembelian dan harga harus di isi!'
        } else {
          if (isNaN(value)) {
            return 'Hanya Input Angka!!'
          }
        }
      }
    }).queue([{
        title: 'Berapa ' + satuan + ' ?',
      },
      {
        title: 'Harga Beli Per Item ?',
      },
    ]).then((result) => {
      if (result.value) {
        var data = result.value
        push_keranjang_pembelian(data[0], data[1], kode_barang);
        set_data_session_no_order_sebelumnya($('#no_order_pembelian').text());
        $('#select_nama_barang').val(null).trigger('change');
        $('#cari_barang').val('');
        $("#result_page").empty();
        display_none = '<div class="col-12 text-center"><p>Cari Data Barang di Kolom Pencarian</p></div>';
        $("#result_page").append(display_none);
      }
    })
    // const {
    //   value: jumlah
    // } = Swal.fire({
    //   title: 'Berapa ' + satuan + ' ?',
    //   input: 'text',
    //   inputPlaceholder: 'Berapa ' + satuan + ' ?',
    //   // html: 'Sisa persediaan sebanyak <b>' + sisa_persediaan + ' ' + satuan + '</b>',
    //   showCancelButton: true,
    //   inputValidator: (value) => {
    //     if (!value) {
    //       return 'Jumlah pembelian harus di isi!'
    //     } else {
    //       if (isNaN(value)) {
    //         return 'Hanya Input Angka!!'
    //       } else {
    //         value = parseInt(value);
    //         sisa_persediaan = parseInt(sisa_persediaan);
    //         console.log(value >= sisa_persediaan);
    //         push_keranjang_pembelian(value, kode_barang);
    //         $('#select_nama_barang').val(null).trigger('change');
    //         $('#cari_barang').val('');
    //         $("#result_page").empty();
    //         display_none = '<div class="col-12 text-center"><p>Cari Data Barang di Kolom Pencarian</p></div>';
    //         $("#result_page").append(display_none);
    //       }
    //     }
    //   }
    // });

  }

  function warning_delete(id) {


    swal.fire({
      title: 'Apa anda yakin akan hapus data ini dari Keranjang Pembelian?',
      text: "Data akan di hapus dari Keranjang Pembelian..",
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
        total_harga_keranjang();
        if ($('#checkbox').prop('checked') == true) {
          push_grand_total(normalrupiah($('#diskon').text()), 10);
        } else {
          push_grand_total(normalrupiah($('#diskon').text()), 0);
        }
        set_grand_total();
        if ($('#total_pembelian').text() == "Rp. 0") {
          $('#confim_button').attr('disabled', true);
          $('#grand_total_div').attr('hidden', true).fadeOut(1000);
        }
      }
    });
  }

  function deleteData_pembelian(id) {
    $.ajax({
      url: "<?= base_url('Manajemen_Pembelian/PembelianBarang/delete_data_keranjang/'); ?>" + id,
      async: false,
      success: function(data) {
        $('#datatable-keranjang-pembelian').DataTable().ajax.reload();
      }
    });
  }
</script>

<!-- Script Push Ke Keranjang Pembelian -->

<script>
  function push_keranjang_pembelian(jumlah, harga, kode_barang) {
    var kode_supplier = $('#select_nama_supplier  option:selected').val();
    var no_order_pembelian = $('#no_order_pembelian').text();
    var tanggal_transaksi = $('#tanggal_transaksi').val();

    $('#confim_button').attr('disabled', false);
    $('#grand_total_div').attr('hidden', false);
    $.ajax({
      url: "<?= Base_url('Manajemen_Pembelian/PembelianBarang/push_data_barang'); ?>",
      type: "post",
      data: {
        no_order_pembelian: no_order_pembelian,
        kode_barang: kode_barang,
        tanggal_transaksi: tanggal_transaksi,
        jumlah_pembelian: jumlah,
        harga_beli: harga,
      },
      cache: false,
      async: false,
      success: function(data) {
        $('#datatable-keranjang-pembelian').DataTable().ajax.reload();
        total_harga_keranjang();
        if ($('#checkbox').prop('checked') == true) {
          push_grand_total(0, 10);
        } else {
          push_grand_total(0, 0);
        }
        set_grand_total();
      }
    })
  }

  function total_harga_keranjang() {

    $.ajax({
      url: "<?= base_url("Manajemen_Pembelian/PembelianBarang/get_sum_keranjang/"); ?>" + $('#no_order_pembelian').text(),
      type: "post",
      dataType: "JSON",
      async: false,
      success: function(data) {
        if (data.total_harga == null) {
          $('#total_pembelian').text(formatRupiah('0', 'Rp.'));
        } else {
          $('#total_pembelian').text(formatRupiah(data.total_harga, 'Rp.'));
        }
      }
    });
  }

  function push_grand_total(diskon, pajak) {
    var total_pembelian = normalrupiah($('#total_pembelian').text());
    var no_order_pembelian = $('#no_order_pembelian').text();
    var total1 = parseInt(total_pembelian) - diskon // data total setelah diskon
    var total2 = Math.round(total1 * (pajak / 100)); // data total setalah di tambah pajak 10%
    var grand_total = total1 + total2 // data grand_total setalah Pajak
    $.ajax({
      url: "<?= Base_url('Manajemen_Pembelian/PembelianBarang/push_grand_total'); ?>",
      type: "post",
      data: {
        no_order_pembelian: no_order_pembelian,
        total_pembelian: total_pembelian,
        diskon: diskon,
        pajak_keluaran: total2,
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
    var no_order_pembelian = $('#no_order_pembelian').text();
    var diskon = $('#diskon');
    var pajak_keluaran = $('#pajak_keluaran');
    var grand_total = $('#grand_total');
    var terbilang_grand_total = $('#terbilang_grand_total');

    $.ajax({
      url: '<?= base_url("Manajemen_Pembelian/PembelianBarang/get_total_perhitungan/"); ?>' + no_order_pembelian,
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
        pajak_keluaran.text(formatRupiah(data.pajak, 'Rp.'));
        //total_ongkir.val(formatRupiah(data.ongkir, 'Rp.'));
        //total_setelah_pajak.text(formatRupiah(total2.toString(), 'Rp.'));
        grand_total.text(formatRupiah(data.grand_total.toString(), 'Rp.'));
        terbilang_grand_total.text(terbilang(data.grand_total.toString()));
      }
    });
  }

  $('#checkbox').change(function() {
    if (this.checked) {
      push_grand_total(normalrupiah($('#diskon').text()), 10);
      set_grand_total();
    } else {
      push_grand_total(normalrupiah($('#diskon').text()), 0);
      set_grand_total();
    }

  });

  function normalrupiah(angka) {

    var tanparp = angka.replace(/[^0-9]+/g, "");
    var tanparp = tanparp.replace("Rp", "");
    var tanparp = tanparp.replace(",-", "");
    var tanpatitik = tanparp.split(".").join("");
    return tanpatitik;
  }

  function set_data_session_no_order_sebelumnya(no_order) {
    sessionStorage.setItem("no_order_pembelian", no_order);
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
    var table = $('#datatable-keranjang-pembelian').DataTable({
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
        "url": '<?= base_url("Manajemen_Pembelian/PembelianBarang/get_data_keranjang/"); ?>' + $('#no_order_pembelian').text(),
        "type": "POST",
      },
      "columnDefs": [{
          // title: "No",
          data: "kode_barang",
          targets: 0,
          render: function(data, type, full, meta) {
            return data;
          }
        },
        {
          // title: "Nama Barang",
          data: "nama_barang",
          targets: 1,
          render: function(data, type, full, meta) {
            return data;

          }
        },
        {
          //title: "Harga Beli",
          data: "harga_beli",
          targets: 2,
          render: function(data, type, full, meta) {
            var display = formatRupiah(data, 'Rp.');
            return display;
          }
        },
        {
          //title: "Jumlah",
          data: "jumlah_pembelian",
          targets: 3,
          render: function(data, type, full, meta) {
            var display = formatSatuan(data);
            return display;
          }
        },
        {
          //title: "Total",
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

    function formatSatuan(angka) {
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
      return rupiah;
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
  $('#confim_button').on('click', function() {
    var nomor_transaksi = $('#nomor_transaksi').val();
    var nama_supplier = $('#select_nama_supplier').text();
    var tanggal_transaksi = $('#tanggal_transaksi').val();
    var cek_keranjang = $('#total_pembelian').text();

    if (nomor_transaksi == "") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Nomor Transaksi Belum di Isi!'
      });
    } else if (tanggal_transaksi == "") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Tanggal Transaksi Belum di Isi!'
      });
    } else if (nama_supplier == "") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Data Supplier Belum di Pilih!'
      });
    } else if (cek_keranjang == "Rp. 0") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Keranjang Pembelian Masih Kosong'
      });
    } else {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      swalWithBootstrapButtons.fire({
        title: 'Apakah Anda Sudah Yakin?',
        text: "Data Pembelian akan di Proses",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Proses!',
        cancelButtonText: 'Tidak !',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          proses_pembelian();
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Batal',
            'Silahkan cek kembali Data Pembeliannya :)',
            'error'
          )
        }
      })
    }
  });

  function proses_pembelian() {
    var nomor_transaksi = $('#nomor_transaksi').val();
    var no_order_pembelian = $('#no_order_pembelian').text();
    var kode_supplier = $('#select_nama_supplier').val();
    var tanggal_transaksi = $('#tanggal_transaksi').val();

    $.ajax({
      url: "<?= Base_url('Manajemen_Pembelian/PembelianBarang/proses_pembelian'); ?>",
      type: "post",
      data: {
        no_order_pembelian: no_order_pembelian,
        nomor_transaksi: nomor_transaksi,
        tanggal_transaksi: tanggal_transaksi,
        kode_supplier: kode_supplier,
      },
      cache: false,
      async: false,
      success: function(data) {
        if (data == 1) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Double Input / Nomor Transaksi Sudah Ada!!',
            footer: '<button type="button" onClick="help()">Klik Saya untuk Mengatasi ini</button>'
          })
        } else {
          Swal.fire(
            'Proses!',
            'Data telah di Proses.',
            'success'
          )
        }
      }
    })

  }

  function help() {
    Swal.fire({
      icon: 'info',
      title: 'How',
      html: 'Silahkan cek terlebih dahulu ke Database Pembelian' +
            'Jika nomor transaksi <b>sudah ada</b>, sedangkan ini bukan duplikat entry'+
            'silahkan tambahkan angka dibelakang nomor transaksi yang sama tersebut'
    })
  }
</script>