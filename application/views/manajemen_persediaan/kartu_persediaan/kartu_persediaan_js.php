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

  <!-- fuse search js -->
  <script src="<?= base_url('assets/'); ?>plugins/fuse-js/fuse.js" type="text/javascript"></script>

  <!-- Modal-Effect -->
  <script src="<?= base_url('assets/'); ?>plugins/custombox/dist/custombox.min.js"></script>
  <script src="<?= base_url('assets/'); ?>plugins/custombox/dist/legacy.min.js"></script>

  <!-- Toastr js -->
  <script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
  <!-- Init -->
  <script>
    $(document).ready(function() {
      cari_versi_select2()
    })
  </script>
  <!-- Kode Barang -->
  <script>
    function cari_versi_select2() {
      $("#select_nama_barang").select2({
        ajax: {
          url: '<?= base_url("Manajemen_Persediaan/KartuPersediaan/get_data_barang_versi_select2"); ?>',
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
                "id": data.data[i].kode_barang,
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
        setData(data);
        setTable(data);
        setSaldoAkhir(data);
      })
    }
  </script>
  <!-- Set Data -->
  <script>
    function setData(kode_barang) {
      $.ajax({
        url: "<?= Base_url('Manajemen_Persediaan/KartuPersediaan/getDetailBarang'); ?>",
        type: "post",
        data: {
          kode_barang: kode_barang
        },
        dataType: "JSON",
        cache: false,
        async: false,
        beforeSend: function() {
          $("#barang_div").loading();
        },
        success: function(data) {
          console.log(data.nama_barang)
          $('#nama_barang').val(data.nama_barang);
          $('#metode').val(data.metode_hpp);
          $('#satuan').val(data.nama_satuan);
          $("#barang_div").loading('stop');
        }
      });
    }


    function setTable(kode_barang) {
      //Init Datatabel Master Stock Persediaan
      var table = $('#datatable-kartu-persediaan').DataTable({
        destroy: true,
        "oLanguage": {
          sProcessing: "Mohon di tunggu...",
          sZeroRecords: "Tidak ada Data..."
        },
        "searching": false,
        "processing": true,
        "lengthChange": true,
        "ordering": false,
        "paging": true,
        "ajax": {
          "url": '<?= base_url("Manajemen_Persediaan/KartuPersediaan/get_data_ajax/"); ?>',
          "type": "POST",
          data: {
            kode_barang: kode_barang
          }
        },
        "columnDefs": [{
            data: "detail",
            targets: 0,
            render: function(data, type, full, meta) {
              return data.tanggal_transaksi;
            }
          }, {
            data: "detail",
            targets: 1,
            render: function(data, type, full, meta) {
              if (data.trans_type == "saldo awal") {
                var display = "<b>" + data.nomor_transaksi + "</b>"
              } else {
                display = data.nomor_transaksi;
              }
              return display;
            }
          }, {
            data: "detail",
            targets: 2,
            render: function(data, type, full, meta) {
              if (data.trans_type == "masuk") {
                var display = "<a class='text-primary'>" + formatSatuan(data.qty) + " </a>"
                return display;
              } else {
                return "-";
              }
            }
          }, {
            data: "detail",
            targets: 3,
            render: function(data, type, full, meta) {
              if (data.trans_type == "keluar") {
                var display = "<a class='text-danger'>" + formatSatuan(data.qty) + " </a>"
                return display;
              } else {
                return "-";
              }
            }
          },
          {
            data: "detail",
            targets: 4,
            render: function(data, type, full, meta) {
              // console.log(data.tanggal_transaksi);
              return "<b>" + formatSatuan(data.saldo) + "</b>";
            }
          },
          {
            data: "detail",
            targets: 5,
            render: function(data, type, full, meta) {
              // console.log(data.tanggal_transaksi);
              return data.trans_type.toUpperCase();
            }
          }
        ]
      });

    }

    function setSaldoAkhir(kode_barang) {
      $.ajax({
        url: '<?= base_url("Manajemen_Persediaan/KartuPersediaan/get_data_ajax/"); ?>',
        type: "POST",
        dataType: "JSON",
        data: {
          kode_barang: kode_barang
        },
        success: function(data) {
          var display = data.data[data.data.length - 1].detail.saldo;
          $('#saldo_akhir').val(formatSatuan(display));
        }
      });
    }

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

    // push keranjang belanja
  </script>