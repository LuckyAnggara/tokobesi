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

  <!-- fuse search js -->
  <script src="<?= base_url('assets/'); ?>plugins/fuse-js/fuse.js" type="text/javascript"></script>

  <!-- Modal-Effect -->
  <script src="<?= base_url('assets/'); ?>plugins/custombox/dist/custombox.min.js"></script>
  <script src="<?= base_url('assets/'); ?>plugins/custombox/dist/legacy.min.js"></script>

  <!-- Toastr js -->
  <script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>


  <!-- script sendiri   // script Radio Fitur Simple dan Adnvace
  // init hide advance search -->
  <script>
    $(document).ready(function() {

      $('#modal_detail_penjualan').on('hidden.bs.modal', function(e) {
        $(this)
          .find("input,textarea,select")
          .end()
          .find("input[type=checkbox], input[type=radio]")
          .prop("checked", "")
          .end();
        $('#dummy_harga_jual').attr('readonly',true);
        $('#qty').val(1);
      });

      $('#modal_password').on('hidden.bs.modal', function(e) {
        $(this)
          .find("input,textarea,select")
          .val('')
          .end()
          .find("input[type=checkbox], input[type=radio]")
          .prop("checked", "")
          .end();
      });


      $("#qty").TouchSpin({
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
      });

      $("#qty").keyup(function() {
        console.log('ss');
        var value = $("#qty").val();
        $("#qty").val(value.replace(/[^,\d]/g, '').toString());
      });

      $.ajax({
        url: '<?= base_url("Manajemen_Penjualan/PenjualanBarang/clear_keranjang_belanja/"); ?>' + sessionStorage.getItem("no_order"),
      });
    });
    $('#cari_barang').hide();
    $('#simple').change(function() {
      $("#select_nama_barang").select2({
        ajax: {
          url: '<?= base_url("Manajemen_Penjualan/PenjualanBarang/get_data_barang_versi_select2"); ?>',
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
                "id": data.data[i].kode_barang + '-' + data.data[i].harga_satuan,
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
        var kode_barang = str[0]
        var harga_jual = str[1];
        choose_barang(harga_jual);

        //choose_barang(tipe_barang, kode_barang, nama_barang, nama_satuan, jumlah_persediaan, jumlah_keranjang, status_jual);

      });
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

    // script formatRupiah
    function normalrupiah(angka) {

      var tanparp = angka.replace(/[^0-9]+/g, "");
      var tanparp = tanparp.replace("Rp", "");
      var tanparp = tanparp.replace(",-", "");
      var tanpatitik = tanparp.split(".").join("");
      return tanpatitik;
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

    function quantityalert(kode_barang, satuan, sisa_persediaan, jumlah_keranjang) {
      console.log(sisa_persediaan)
      const {
        value: jumlah
      } = Swal.fire({
        title: 'Berapa ' + satuan + ' ?',
        input: 'text',
        html: 'Sisa persediaan sebanyak <b>' + sisa_persediaan + ' ' + satuan + '</b>',
        showCancelButton: true,
        inputValidator: (value) => {
          if (!value) {
            return 'Jumlah pembelian harus di isi!'
          } else {
            if (isNaN(value)) {
              return 'Hanya Input Angka!!'
            } else {
              value = parseInt(value);
              sisa_persediaan = parseInt(sisa_persediaan);
              console.log(value >= sisa_persediaan);
              if (value <= sisa_persediaan) {
                push_keranjang_belanja(value, kode_barang);
                push_persediaan_temporary_tambah(value, kode_barang);
                set_data_session_no_order_sebelumnya($('#no_order').text());
                $('#select_nama_barang').val(null).trigger('change');
                $('#cari_barang').val('');
                $("#result_page").empty();
                display_none = '<div class="col-12 text-center"><p>Cari Data Barang di Kolom Pencarian</p></div>';
                $("#result_page").append(display_none);
              } else {
                return 'Sisa barang tidak cukup dengan jumlah pembelian!!'
              }
            }
          }
        }
      });

    }
  </script>


  <!-- fetch data ke id pelanggan, jika pake fitur cari -->
  <script>
    function batal_pelanggan() {
      console.log('asdasd');
      $('#id_pelanggan').attr('disabled', false).val('');
      $('#nama_pelanggan').attr('disabled', false).val('');
      $('#alamat').attr('disabled', false).val('');
      $('#nomor_telepon').attr('disabled', false).val('');
      $('#div_cari-button').empty();
      $('#id_pelanggan_help').text('Kosong kan jika tidak ada ID Pelanggan');
      display = '<button id="cari-button" name="cari-button" onClick="cari_pelanggan();" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-search"></i></button>'
      $('#div_cari-button').append(display);
    };

    function tutup_tombol_cari() {
      $('#id_pelanggan').attr('disabled', true);
      $('#nama_pelanggan').attr('disabled', true);
      $('#alamat').attr('disabled', true);
      $('#nomor_telepon').attr('disabled', true);
      $('#div_cari-button').empty();
      $('#id_pelanggan_help').text('');
      display = '<button id="cari-edit" onClick="batal_pelanggan();" name="cari-edit" class="btn btn-success waves-effect waves-light" type="button"><i class="fa  fa-edit "></i></button>'
      $('#div_cari-button').append(display);
    }

    function cari_pelanggan() {
      var id_pelanggan = $('#id_pelanggan');
      var nama_pelanggan = $('#nama_pelanggan');
      var alamat = $('#alamat');
      var nomor_telepon = $('#nomor_telepon');
      if (id_pelanggan.val() !== "") {
        $.ajax({
          url: '<?= base_url("Manajemen_Penjualan/PenjualanBarang/get_data_pelanggan/"); ?>' + id_pelanggan.val(),
          type: "POST",
          dataType: "JSON",
          async: false,
          success: function(data) {
            if (data !== null) {
              nama_pelanggan.val(data.nama_pelanggan);
              alamat.val(data.alamat);
              nomor_telepon.val(data.nomor_telepon);
              tutup_tombol_cari();
            } else {
              alert_data_pelanggan("tidak_ada");
              nama_pelanggan.val(null);
              alamat.val(null);
              nomor_telepon.val(null);
            }
          }
        });
      } else {
        $('#pelanggan_modal').modal('show');
      }

    };

    function alert_data_pelanggan(status) {
      switch (status) {
        case "kosong":
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'ID Pelanggan kosong!!',
            // footer: '<a href>Kenapa Bisa begini?</a>'
          });
          break;
        case "tidak_ada":
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'ID Pelanggan Tidak ditemukan!!',
            // footer: '<a href>Kenapa Bisa begini?</a>'
          });
      }
    }
  </script>

  <!-- Script Pencarian Barang Fitur Gambar -->

  <script>
    var input_search = $('#cari_barang');
    input_search.on('keyup', function() {
      search(input_search.val());
    })

    function search(kata_kunci) {
      if (kata_kunci !== "") {
        $.ajax({
          url: '<?= base_url("Manajemen_Penjualan/PenjualanBarang/get_data_barang/"); ?>' + kata_kunci,
          type: "POST",
          dataType: "JSON",
          async: false,
          success: function(data) {
            if (data.jumlah_data > 0) {
              $("#result_page").empty();
              for (var i in data.data) {
                console.log(data.data[i]);
                var display2 = '<div id="result"  class="col-md-6 col-lg-3"><div class="card gal-detail thumb"><a type="button" id="wawa" onclick="choose_barang(\'' + data.data[i].harga_satuan + '\')" ><img class="img-thumbnail img-responsive" alt="profile-image" src="<?= base_url('assets/images/barang/'); ?>' + data.data[i].gambar + '" alt="Tidak ada Gambar"><h5 >' + data.data[i].nama_barang + '</h4><p class="card-text">' + data.data[i].keterangan + '</p></a></div></div>';
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


    function choose_barang2(tipe_barang, kode_barang, nama_barang, nama_satuan, jumlah_persediaan, jumlah_keranjang, status_jual) {
      if (status_jual == 0) {
        status_jual_alert(nama_barang, status_jual);
      } else {
        if (tipe_barang == 3) {
          quantityalert(kode_barang, "", 9999);
        } else {
          if (jumlah_persediaan == 0) {
            persediaan_habis(nama_barang, nama_satuan, jumlah_persediaan);
          } else {
            quantityalert(kode_barang, nama_satuan, jumlah_persediaan, jumlah_keranjang);
          }

        }

      }

    }

    $('#dummy_harga_jual').on('keyup', function() {
      var input_harga_jual = $('#dummy_harga_jual');
      input_harga_jual.val(formatRupiah(input_harga_jual.val().toString(), 'Rp.'));
      $('#harga_jual').val(normalrupiah(input_harga_jual.val()));
    });

    $('#dummy_diskon').on('keyup', function() {
      var diskon = $('#dummy_diskon');
      diskon.val(formatRupiah(diskon.val().toString(), 'Rp.'));
      $('#diskon').val(normalrupiah(diskon.val()));
    });

    function choose_barang(harga_jual) {
      var input_harga_jual = $('#dummy_harga_jual');
      input_harga_jual.val(formatRupiah(harga_jual.toString(), 'Rp.'));
      $('#harga_jual').val(harga_jual);
      $('#dummy_diskon').val(formatRupiah('0', 'Rp.'));
      $('#modal_detail_penjualan').modal('show');
    }

    function overide_harga() {
      $('#modal_password').modal('show');
    }

    $('#button-password-add').on('click', function() {
      var password = $('#password_input').val();
      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/cekPasswordDirektur'); ?>",
        type: "post",
        data: {
          password: password
        },
        cache: false,
        async: false,
        success: function(data) {
          if (data == 0) {
            Swal.fire(
              'Password Salah',
              'Silahkan Ulangi',
              'error'
            )
          } else {
            $('#dummy_harga_jual').attr('readonly', false);
          }
        }
      });
    })
  </script>

  <!-- Script Pencarian Barang Fitur Select2 -->
  <script>
    $(document).ready(function() {
      $('#select_nama_barang').select2({
        ajax: {
          url: '<?= base_url("Manajemen_Penjualan/PenjualanBarang/get_data_barang_versi_select2"); ?>',
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
                "id": data.data[i].kode_barang + '-' + data.data[i].harga_satuan,
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
        var kode_barang = str[0]
        var harga_jual = str[1];
        choose_barang(harga_jual);

        //choose_barang(tipe_barang, kode_barang, nama_barang, nama_satuan, jumlah_persediaan, jumlah_keranjang, status_jual);
        // if (jumlah_persediaan == 0) {
        //   persediaan_habis(nama_barang, satuan, jumlah_persediaan);
        // } else {
        //   quantityalert(kode_barang, satuan, jumlah_persediaan, jumlah_keranjang);
        // }

      });
    });
  </script>

  <!-- input ke keranjang belanjaan -->

  <script>
    function push_keranjang_belanja(jumlah, kode_barang) {
      var id_pelanggan = $('#id_pelanggan').val();
      var no_order = $('#no_order').text();

      $('#simpan_checkout').attr('disabled', false);
      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/push_data_barang'); ?>",
        type: "post",
        data: {
          no_order_penjualan: no_order,
          id_pelanggan: id_pelanggan,
          jumlah_pembelian: jumlah,
          kode_barang: kode_barang
        },
        cache: false,
        async: false,
        success: function(data) {
          $('#datatable-keranjang-penjualan').DataTable().ajax.reload();
          total_harga_keranjang();
        }
      })
    }

    function set_data_session_no_order_sebelumnya(no_order) {
      sessionStorage.setItem("no_order", no_order);
      console.log(sessionStorage.getItem("no_order"));
    }

    function push_persediaan_temporary_tambah(jumlah_pembelian, kode_barang) {
      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/persediaan_temp_tambah/'); ?>",
        type: "post",
        data: {
          kode_barang: kode_barang,
          jumlah_pembelian: jumlah_pembelian,
        },
        cache: false,
        async: false,
        success: function(data) {}
      })
    }

    function push_persediaan_temporary_batal(id) {
      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/persediaan_temp_batal/'); ?>",
        type: "post",
        data: {
          id: id,
        },
        cache: false,
        async: false,
        success: function(data) {}
      })
    }

    function total_harga_keranjang() {
      $.ajax({
        url: "<?= base_url("Manajemen_Penjualan/PenjualanBarang/get_sum_keranjang/"); ?>" + $('#no_order').text(),
        type: "post",
        dataType: "JSON",
        async: false,
        success: function(data) {
          if (data.total_harga == null) {
            total = 0;
            $('#terbilang_keranjang').text('Nol Rupiah');
          } else {
            total = formatRupiah(data.total_harga, 'Rp.');
            $('#terbilang_keranjang').text(terbilang(data.total_harga));
          }
          $('#total_keranjang').text(total);

        }
      })
    }
  </script>

  <!-- Update Data Table Keranjang -->
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
      var table = $('#datatable-keranjang-penjualan').DataTable({
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
          "url": '<?= base_url("Manajemen_Penjualan/PenjualanBarang/get_data_keranjang/"); ?>' + $('#no_order').text(),
          "type": "POST",
        },
        "columnDefs": [{
            data: "kode_barang",
            targets: 0,
            render: function(data, type, full, meta) {
              return data;
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
            data: "harga_satuan",
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
  <!-- fungsi alert persediaan abis dan hapus data di keranjang -->

  <script>
    function persediaan_habis(nama_barang, satuan, jumlah_persediaan) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'PERSEDIAAN! ' + nama_barang + ' KOSONG!',
      });
      $('#select_nama_barang').val(null).trigger('change');
    }

    function status_jual_alert(nama_barang, status_jual) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Status Barang ' + nama_barang + ' Tidak Dijual!',
      });
      $('#select_nama_barang').val(null).trigger('change');
    }

    function warning_delete(id) {
      swal.fire({
        title: 'Apa anda yakin akan hapus data ini dari Keranjang Belanja?',
        text: "Data akan di hapus dari Keranjang Belanja..",
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
          push_persediaan_temporary_batal(id);
          deleteData_keranjang(id);
          total_harga_keranjang();

        }
      });
    }

    function deleteData_keranjang(id) {
      $.ajax({
        url: "<?= base_url('Manajemen_Penjualan/PenjualanBarang/delete_data_keranjang/'); ?>" + id,
        async: false,
        success: function(data) {
          $('#datatable-keranjang-penjualan').DataTable().ajax.reload();
          total_harga_keranjang();
        }
      });
    }
  </script>

  <!-- Fungsi Checkout -->

  <script>
    $('#checkout').on('click', function() {
      var data_label_chekcout = $('#data_label_chekcout');
      var nama_pelanggan = $('#nama_pelanggan');
      var total_keranjang = normalrupiah($('#total_keranjang').text());
      var no_order = $('#no_order').text();

      if (nama_pelanggan.val() !== "") {
        if ($('#total_keranjang').text() !== "Rp. 0") {
          data_label_chekcout.text('Checkout Nomor Order : ' + no_order);
          push_total_perhitungan(no_order, total_keranjang, 0, 0, 0, total_keranjang);
          $('#checkout_modal').modal('show');
        } else {
          warning_keranjang_kosong();
        }
      } else {
        warning_pelanggan_kosong();
      }
    });

    function push_total_perhitungan(no_order, total_keranjang, diskon, pajak, ongkir, grand_total) {
      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/push_total_perhitungan'); ?>",
        type: "post",
        data: {
          no_order_penjualan: no_order,
          total_keranjang: total_keranjang,
          diskon: diskon,
          pajak: pajak,
          ongkir: ongkir,
          grand_total: grand_total
        },
        cache: false,
        async: false,
        success: function(data) {
          view_modal_checkout(no_order);
        }
      })
    }

    function view_modal_checkout(no_order) {
      var total_checkout = $('#total_checkout'); // text
      var total_diskon = $('#checkout_discount'); // text
      var total_pajak = $('#checkout_pajak'); // text
      var total_ongkir = $('#ongkir'); // val
      var total_setelah_pajak = $('#total_setelah_pajak'); //total setelah diskon dan pajak
      var grand_total = $('#checkout_grand_total'); // text
      var terbilang_total_checkout = $('#total_checkout_terbilang');
      var terbilang_setelah_pajak = $('#total_setelah_pajak_terbilang');
      var terbilang_grand_total = $('#checkout_grand_total_terbilang');
      var diskon_text = $('#diskon_text');

      $.ajax({
        url: '<?= base_url("Manajemen_Penjualan/PenjualanBarang/get_total_perhitungan/"); ?>' + no_order,
        type: "POST",
        dataType: "JSON",
        async: false,
        success: function(data) {
          // matematika
          // total order - diskon
          var total1 = parseInt(data.total_keranjang) - parseInt(data.diskon) // data total setelah diskon
          var total2 = total1 + parseInt(data.pajak) // data total setalah di tambah pajak 10%
          var total3 = total2 + parseInt(data.ongkir) // data grand_total setalah Pajak

          var diskon = (parseInt(data.diskon) / parseInt(data.total_keranjang)) * 100;


          total_checkout.text(formatRupiah(data.total_keranjang, 'Rp.'));
          total_diskon.text(formatRupiah(data.diskon, 'Rp.'));
          total_pajak.text(formatRupiah(data.pajak, 'Rp.'));
          total_ongkir.val(formatRupiah(data.ongkir, 'Rp.'));
          total_setelah_pajak.text(formatRupiah(total2.toString(), 'Rp.'));
          grand_total.text(formatRupiah(total3.toString(), 'Rp.'));
          diskon_text.text(diskon);

          // terbilang

          terbilang_total_checkout.text(terbilang(data.total_keranjang));
          terbilang_setelah_pajak.text(terbilang(total2.toString()));
          terbilang_grand_total.text(terbilang(total3.toString()));

        }
      });
    }

    var ongkir_satuan = document.getElementById('ongkir');
    ongkir_satuan.addEventListener('keyup', function(e) {
      ongkir_satuan.value = formatRupiah(this.value, 'Rp. ');
      var ongkir_dummy = normalrupiah(ongkir_satuan.value);
    });

    $('#apply_ongkir').on('click', function() {
      var ongkir = document.getElementById('ongkir');
      if (ongkir.value !== "") {

        // push ker tabel total perhitungan untuk ditambah kan ongkir

        var no_order = $('#no_order').text();
        var total_diskon = normalrupiah($('#checkout_discount').text());
        var total_ongkir = normalrupiah($('#ongkir').val());
        var total_keranjang = normalrupiah($('#total_keranjang').text());
        var grand_total = parseInt(total_keranjang) - parseInt(total_diskon);
        grand_total = grand_total + parseInt(total_ongkir);


        push_total_perhitungan(no_order, total_keranjang, total_diskon, 0, total_ongkir, grand_total);

      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Ongkir Belum di Isi!',
        });
      }
    });

    function warning_pelanggan_kosong() {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Data Pelanggan Masih Kosong!',
      })
    }

    function warning_keranjang_kosong() {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Keranjang Belanjaan Masih Kosong!',
        // footer: '<a href>Why do I have this issue?</a>'
      })
    }

    $('#apply_promo').on('click', function() {
      var kode_diskon = $('#promo_code').val();

      if (kode_diskon !== "") {
        $.ajax({
          url: '<?= base_url("Manajemen_Penjualan/PenjualanBarang/get_diskon/"); ?>' + kode_diskon,
          type: "POST",
          dataType: "JSON",
          async: false,
          success: function(data) {
            if (data == null) {

              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kode Promo / Diskon Salah!!!',
              });

              var no_order = $('#no_order').text();
              var total_diskon = normalrupiah($('#checkout_discount').text());
              var total_ongkir = normalrupiah($('#ongkir').val());
              var total_keranjang = normalrupiah($('#total_keranjang').text());
              var grand_total = parseInt(total_keranjang) - parseInt(total_diskon);
              grand_total = grand_total + parseInt(total_ongkir);

              push_total_perhitungan(no_order, total_keranjang, 0, 0, total_ongkir, grand_total);


            } else {
              var no_order = $('#no_order').text();
              var total_ongkir = normalrupiah($('#ongkir').val());
              var total_keranjang = normalrupiah($('#total_keranjang').text());
              var grand_total = parseInt(total_keranjang) + parseInt(total_ongkir);
              var total_diskon = parseInt(total_keranjang) * (parseInt(data.potongan) / 100)
              var grand_total = parseInt(total_keranjang) - parseInt(total_diskon);
              grand_total = grand_total + parseInt(total_ongkir);

              push_total_perhitungan(no_order, total_keranjang, total_diskon, 0, total_ongkir, grand_total);
            }

          }
        })

      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Kode Promo Belum di Isi!!!',
        });
        var no_order = $('#no_order').text();
        var total_ongkir = normalrupiah($('#ongkir').val());
        var total_keranjang = normalrupiah($('#total_keranjang').text());
        var grand_total = parseInt(total_keranjang) + parseInt(total_ongkir);

        push_total_perhitungan(no_order, total_keranjang, 0, 0, total_ongkir, grand_total);
      }

    })
  </script>

  <!-- script simpan dan bayar chekcout -->

  <script>
    $('#simpan_checkout').on('click', function() {
      var no_order = $('#no_order').text();
      var nama_pelanggan = $('#nama_pelanggan').val();
      var id_pelanggan = $('#id_pelanggan').val()
      var alamat = $('#alamat').val()
      var nomor_telepon = $('#nomor_telepon').val()
      var isDisabled = $('#id_pelanggan').is(':disabled');
      if (nama_pelanggan == "") {
        warning_pelanggan_kosong();
      } else {
        if (isDisabled == false) {
          simpan_order(no_order, '', nama_pelanggan, alamat, nomor_telepon);
        } else {
          simpan_order(no_order, id_pelanggan);
        }
      }
    });

    function simpan_order(no_order, id_pelanggan, nama_pelanggan, alamat, nomor_telepon) {
      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/simpan_order/'); ?>",
        type: "post",
        data: {
          no_order_penjualan: no_order,
          id_pelanggan: id_pelanggan,
          nama_pelanggan: nama_pelanggan,
          alamat: alamat,
          nomor_telepon: nomor_telepon,
          status: 0,
        },
        cache: false,
        async: false,
        success: function(data) {
          // toastr.success('Data Belanja Telah tersimpan #' + no_order);
          Command: toastr["success"]('Nomor Order Telah tersimpan #' + no_order)
          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
        }

      });
    }
  </script>

  <!-- bayar_checkout -->

  <script>
    $('#bayar_checkout').on('click', function() {
      var no_order = $('#no_order').text();
      var nama_pelanggan = $('#nama_pelanggan').val();
      var id_pelanggan = $('#id_pelanggan').val()
      var alamat = $('#alamat').val()
      var nomor_telepon = $('#nomor_telepon').val()
      var isDisabled = $('#id_pelanggan').is(':disabled');
      if (nama_pelanggan == "") {
        warning_pelanggan_kosong();
      } else {
        if (isDisabled == false) {
          simpan_order(no_order, '', nama_pelanggan, alamat, nomor_telepon);
        } else {
          simpan_order(no_order, id_pelanggan);
        }
      }

      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/bayar_checkout/'); ?>" + no_order,
        type: "post",
        data: {
          no_order: no_order,
        },
        cache: false,
        async: false,
        success: function(data) {

          Swal.fire({
            title: 'Paid!!',
            text: "Order " + no_order + " telah di bayar!",
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Cetak Faktur ?'
          }).then((result) => {
            if (result.value) {
              window.location.replace("<?= base_url('Manajemen_Penjualan/PenjualanBarang/Invoice/'); ?>" + no_order)
            }
          })


        }
      });
    })
  </script>