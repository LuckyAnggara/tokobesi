<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Required datatable js -->

<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/buttons.print.min.js"></script>

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
        url: '<?= base_url("manajemen_persediaan/returpersediaan/get_data_barang"); ?>',
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
            });
          });
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
      total_saldo(data);
    })
  }
</script>
<!-- Set Data -->
<script>
  function setData(kode_barang) {
    $.ajax({
      url: "<?= Base_url('manajemen_persediaan/returpersediaan/get_detail_barang'); ?>",
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
      "oLanguage": {
        sProcessing: "Sabar yah...",
        sZeroRecords: "Tidak ada Data..."
      },
      "fixedColumns": true,
      "lengthChange": true,
      "searching": true,
      "buttons": ['copy', 'excel', 'pdf', 'print'],
      "dom": 'Bfrtip',
      "processing": true,
      "serverSide": false,
      "ordering": false,
      "ajax": {
        "url": '<?= base_url("manajemen_persediaan/returpersediaan/get_detail_retur/"); ?>',
        "type": "POST",
        data: {
          kode_barang: kode_barang
        }
      },
      "columnDefs": [{
        data: "tanggal",
        width: 50,
        targets: 0,
        render: function(data, type, full, meta) {
          return data;
        }
      }, {
        data: "nomor_faktur",
        width: 50,
        targets: 1,
        render: function(data, type, full, meta) {
          return data;
        }
      }, {
        data: "jumlah_retur",
        width: 30,
        targets: 2,
        render: function(data, type, full, meta) {
          return data;
        }
      }, {
        data: "saldo",
        width: 30,
        targets: 3,
        render: function(data, type, full, meta) {
          return data;
        }
      }, {
        data: "keterangan",
        width: 200,
        targets: 4,
        render: function(data, type, full, meta) {
          return data;
        }
      }, {
        data: {
          "id": "id",
          "saldo": "saldo"
        },
        targets: 5,
        width: 50,
        render: function(data, type, full, meta) {
          var display = '<a type="button" onClick = "view_modal(\'' + data.id + '\',\'' + data.saldo + '\')" class="btn btn-icon waves-effect waves-light btn-primary btn-sm"><i class="fa fa-exchange" ></i> </a>';
          return display;
        }
      }]
    });

  }

  function total_saldo(kode_barang) {
    $.ajax({
      url: '<?= base_url("manajemen_persediaan/returpersediaan/total_saldo/"); ?>',
      type: "POST",
      dataType: "JSON",
      data: {
        kode_barang: kode_barang
      },
      success: function(data) {
        $('#total_saldo').val(formatSatuan(data.toString()));
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

  var harga_pokok = document.getElementById('harga_pokok');
  harga_pokok.addEventListener('keyup', function(e) {
    var data = $('#harga_pokok').val();
    harga_pokok.value = formatRupiah(this.value, 'Rp. ');
  });

  var qty = document.getElementById('jumlah');
  qty.addEventListener('keyup', function(e) {
    var saldo = parseInt($('#saldo_retur_barang').text());
    if (this.value > saldo) {
      Swal.fire({
        icon: 'error',
        title: 'Over',
        text: 'Nominal pembayaran melebihi saldo Piutang !!',
      });
      qty.value = '';
    }

  });

  // push keranjang belanja
</script>

<!-- modal -->
<script>
  function view_modal(id, saldo) {
    $('#saldo_retur_barang').text(saldo);
    $('#id_retur_barang').text(id);
    $('#add_data').modal('show')
  }
</script>

<script>
  $(document).ready(function() {
    $('#submitForm').submit(function(e) {
      var id = $('#id_retur_barang').text();
      e.preventDefault();
      var data = new FormData(document.getElementById("submitForm"));
      data.append('id', id);
      $.ajax({
        url: "<?= Base_url('manajemen_persediaan/returpersediaan/push_retur'); ?>",
        type: "post",
        data: data,
        async: false,
        processData: false,
        contentType: false,
        beforeSend: function() {
          $("#submitForm").loading();
        },
        success: function(data) {
          $('#datatable-kartu-persediaan').DataTable().ajax.reload();
          var kode_barang = $("#select_nama_barang option:selected").val();
          total_saldo(kode_barang)
          Swal.fire(
            'Sukses!',
            'Persediaan telah di Transfer.',
            'success'
          )
          $("#submitForm").loading('stop');
          $('#add_data').modal('hide');
        }
      })


    });
  });
</script>