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

  <script>
    $(document).ready(function() {
      //Init Datatabel Master Stock Persediaan
      var table = $('#datatable-kartu-persediaan').DataTable({
        "oLanguage": {
          sProcessing: "Mohon di tunggu...",
          sZeroRecords: "Tidak ada Data..."
        },
        "searching": false,
        "processing": true,
        "ordering": false,
        "lengthChange": true,
        "paging": true,
        "ajax": {
          "url": '<?= base_url("Manajemen_Persediaan/KartuPersediaan/get_data_ajax/"); ?>',
          "type": "POST",
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
            return data.nomor_transaksi;
          }
        }, {
          data: "detail",
          targets: 2,
          render: function(data, type, full, meta) {
            if (data.trans_type == "Masuk") {
              var display = "<a class='text-primary'>" + data.qty + " </a>"
              return display;
            } else {
              return "";
            }
          }
        }, {
          data: "detail",
          targets: 3,
          render: function(data, type, full, meta) {
            if (data.trans_type == "Masuk") {
              var display = "<a class='text-primary'>" + formatRupiah(data.harga_beli.toString(), 'Rp.') + " </a>"
              return display
            } else {
              return "";
            }
          }
        }, {
          data: "detail",
          targets: 4,
          render: function(data, type, full, meta) {
            var total = data.harga_beli * data.qty;
            if (data.trans_type == "Masuk") {
              var display = "<a class='text-primary'>" + formatRupiah(data.harga_beli.toString(), 'Rp.') + " </a>"
              return display
            } else {
              return "";
            }
          }
        }, {
          data: "detail",
          targets: 5,
          render: function(data, type, full, meta) {
            if (data.trans_type == "Keluar") {
              var display = "<a class='text-danger'>" + data.qty + " </a>"
              return display;
            } else {
              return "";
            }
          }
        }, {
          data: "detail",
          targets: 6,
          render: function(data, type, full, meta) {
            if (data.trans_type == "Keluar") {
              var display = "<a class='text-danger'>" + formatRupiah(data.harga_beli.toString(), 'Rp.') + " </a>"
              return display
            } else {
              return "";
            }
          }
        }, {
          data: "detail",
          targets: 7,
          render: function(data, type, full, meta) {
            var total = data.harga_beli * data.qty;
            var display = "<a class='text-danger'>" + formatRupiah(total.toString(), 'Rp.') + " </a>"
            if (data.trans_type == "Keluar") {
              return display
            } else {
              return "";
            }
          }
        }, {
          data: "detail",
          targets: 8,
          render: function(data, type, full, meta) {
            // console.log(data.tanggal_transaksi);
            return data.saldo;
          }
        }, {
          data: "detail",
          targets: 9,
          render: function(data, type, full, meta) {
            // console.log(data.tanggal_transaksi);
            return data.harga_beli;
          }
        }, {
          data: "detail",
          targets: 10,
          render: function(data, type, full, meta) {
            // console.log(data.tanggal_transaksi);
            return data.harga_beli * data.saldo;
          }
        }, ],
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