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
        placeholder: "Pencarian Barang, menggunakan Nama Barang atau Kode Barang .."
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
        console.log(data);
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
                console.log(data.data[i]);
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
      console.log(sisa_persediaan)

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
  </script>

  <!-- Script Push Ke Keranjang Pembelian -->

  <script>
    function push_keranjang_pembelian(jumlah, harga, kode_barang) {
      var kode_supplier = $('#select_nama_supplier  option:selected').val();
      var no_order_pembelian = $('#no_order_pembelian').text();

      $('#simpan_checkout').attr('disabled', false);
      $.ajax({
        url: "<?= Base_url('Manajemen_Pembelian/PembelianBarang/push_data_barang'); ?>",
        type: "post",
        data: {
          no_order_pembelian: no_order_pembelian,
          kode_barang: kode_barang,
          jumlah_pembelian: jumlah,
          harga_beli: harga,
        },
        cache: false,
        async: false,
        success: function(data) {
          $('#datatable-keranjang-pembelian').DataTable().ajax.reload();
        }
      })
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
            title: "No",
            data: "kode_barang",
            targets: 0,
            render: function(data, type, full, meta) {
              return data;
            }
          },
          {
            title: "Nama Barang",
            data: "nama_barang",
            targets: 1,
            render: function(data, type, full, meta) {
              return data;
            }
          },
          {
            title: "Harga Beli",
            data: "harga_beli",
            targets: 2,
            render: function(data, type, full, meta) {
              //var display = formatRupiah(data.toString(), 'Rp.');
              return data;
            }
          },
          {
            title: "Jumlah",
            data: "jumlah_pembelian",
            targets: 3,
            render: function(data, type, full, meta) {
              var display = formatSatuan(data);
              return display;
            }
          },
          {
            title: "Total",
            data: "total_harga",
            targets: 4,
            render: function(data, type, full, meta) {
              //var display = formatRupiah(data.toString(), 'Rp.');
              return data;
            }
          },
          {
            title: "Action",
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

    })
  </script>