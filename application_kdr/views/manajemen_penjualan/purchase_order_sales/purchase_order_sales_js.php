  <!-- Required datatable js -->
  <script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Responsive examples -->
  <script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/'); ?>plugins/datatables/responsive.bootstrap4.min.js"></script>

  <!-- bootstrap touchspin -->
  <script src="<?= base_url('assets/'); ?>plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

  <!-- Select2 js -->
  <script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
  <!-- Select2 js -->
  <script src="<?= base_url('assets/'); ?>plugins/moment/min/moment.min.js" type="text/javascript"></script>

  <!-- DatePicker Js -->
  <script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- switchery -->
  <script src="<?= base_url('assets/'); ?>plugins/switchery/switchery.min.js"></script>

  <script>
    $(document).ready(function() {

      // $(window).on("unload", function(e) {
      //   clear_data(sessionStorage.getItem("no_order"));
      // });

      cek_last_order()


      $('#modal_detail_penjualan').on('hidden.bs.modal', function(e) {
        $(this)
          .find("input,textarea,select")
          .end()
          .find("input[type=checkbox], input[type=radio]")
          .prop("checked", "")
          .end();
        $('#dummy_harga_jual').attr('readonly', true);
        $('#qty').val(1);
        $('#diskon').val(0);
        // $("#select_nama_barang").val(null).trigger('change');
        // $('#cari_barang').val('');
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


      $("#qty").keyup(function() {
        var value = $("#qty").val();
        $("#qty").val(value.replace(/[^,\d]/g, '').toString());
      });

    });
  </script>

  <!-- script sendiri   // script Radio Fitur Simple dan Adnvace
  // init hide advance search -->
  <script>
    function cek_last_order() {
      var no_order = $('#no_order').text();
      $.ajax({
        url: "<?= Base_url('manajemen_penjualan/purchaseordersales/cek_last_order'); ?>",
        type: "post",
        data: {
          no_order: no_order,
        },
        beforeSend: function() {
          $.LoadingOverlay("show");
        },
        success: function(data) {
          if (data == 1) {
            $('#status_order').text('pending order');
            $('#status_order').removeClass("badge-success").addClass("badge-danger");
            notifKeranjang();
            push_total_perhitungan(no_order, 0, 0);
            notifTotalKeranjang();
          }
        },
        complete: function() {
          $.LoadingOverlay("hide");
        }
      })
    }
    // clear keranjang
    $('#review').on('click', function() {
      $(".right-bar").toggle();
      $('.wrapper').toggleClass('right-bar-enabled');
      Swal.fire({
        title: 'Review ??',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya !'
      }).then((result) => {
        if (result.value) {
          var no_order = $('#no_order').text();
          $.ajax({
            url: "<?= Base_url('manajemen_penjualan/purchaseordersales/push_review_temp'); ?>",
            type: "post",
            data: {
              no_order: no_order,
            },
            beforeSend: function() {
              $.LoadingOverlay("show");
            },
            success: function(data) {
              window.location.href = "<?= base_url('manajemen_penjualan/reviewpurchaseorder/review/'); ?>" + no_order
            },
            complete: function() {
              $.LoadingOverlay("hide");
            }
          });
        }
      })
    })

    $('#batal').on('click', function() {
      $(".right-bar").toggle();
      $('.wrapper').toggleClass('right-bar-enabled');
      Swal.fire({
        title: 'Batalkan ??',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya !'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '<?= base_url("manajemen_penjualan/purchaseordersales/clear_keranjang_belanja/"); ?>' + $('#no_order').text(),
            success: function(data) {
              deleteMasterPo($('#no_order').text())
              $("#keranjang").empty();
              $("#jumlah_keranjang").text(0);
              $('#operatorbtn').attr('hidden', true);
              setTimeout(function() {
                location.reload(true);
              }, 5000);
              Swal.fire(
                'Deleted!',
                'Order di Batalkan!',
                'success'
              ).then((result) => {
                location.reload(true);
              });

            }
          });
        }
      })
    })

    function deleteMasterPo(no_order) {
      $.ajax({
        url: "<?= base_url('manajemen_penjualan/purchaseordersales/delete_data_po/'); ?>" + no_order,
      });
    }



    // script formatRupiah
    function normalrupiah(angka) {

      var tanparp = angka.replace(/[^0-9]+/g, "");
      var tanparp = tanparp.replace("Rp", "");
      var tanparp = tanparp.replace(",-", "");
      var tanpatitik = tanparp.split(".").join("");
      return tanpatitik;
    }

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
      const {
        value: jumlah
      } = Swal.fire({
        title: 'Berapa ' + satuan + ' ?',
        input: 'text',
        html: 'Sisa persediaan sebanyak <b>' + sisa_persediaan + ' ' + satuan + '</b>',
        showCancelButton: true,
        inputValidator: (value) => {
          if (!value) {
            return 'Jumlah penjualan harus di isi!'
          } else {
            if (isNaN(value)) {
              return 'Hanya Input Angka!!'
            } else {
              value = parseInt(value);
              sisa_persediaan = parseInt(sisa_persediaan);
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
                return 'Sisa barang tidak cukup dengan jumlah penjualan!!'
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
          url: '<?= base_url("manajemen_penjualan/purchaseordersales/get_data_pelanggan/"); ?>' + id_pelanggan.val(),
          type: "POST",
          dataType: "JSON",
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
        init_table_pelanggan();
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
    $('#searchbtn').on('click', function() {
      var input_search = $('#cari_barang');
      search(input_search.val());
    })

    function search(kata_kunci) {
      if (kata_kunci !== "") {
        $.ajax({
          url: '<?= base_url("manajemen_penjualan/purchaseordersales/get_data_barang/"); ?>' + kata_kunci,
          type: "POST",
          dataType: "JSON",
          beforeSend: function() {
            $("#result_page").LoadingOverlay('show');
          },
          error: function(e) {
            if (e.status == 400) {
              Swal.fire(
                'Spelling error',
                'Ada karakter pencarian yang tidak diperbolehkan',
                'error'
              )
            }
          },
          success: function(data) {
            if (data.jumlah_data > 0) {
              $("#result_page").empty();
              for (var i in data.data) {
                var harga_jual = formatRupiah(data.data[i].harga_satuan, 'Rp.');
                var display = '<div id="wawa" class="col-xl-3 col-md-3 col-xs-3" onclick="choose_barang(\'' + data.data[i].kode_barang + '\',\'' + data.data[i].jumlah_persediaan + '\',\'' + data.data[i].nama_satuan + '\',\'' + data.data[i].harga_satuan + '\',\'' + data.data[i].nama_barang + '\')">' +
                  '<div class="card-box widget-user">' +
                  '<div>' +
                  '<img src="<?= base_url('assets/images/barang/'); ?>' + data.data[i].gambar + '" class="img-responsive rounded-circle" alt="user">' +
                  '<div class="wid-u-info">' +
                  '<h6 class="mt-0">' + data.data[i].nama_barang + '</h6>' +
                  '<h6><span class="text-primary"><b>' + harga_jual + ' </b></span><br>stok : <b>' + formatSatuan(data.data[i].jumlah_persediaan.toString()) + ' ' + data.data[i].nama_satuan + '</b></h6>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '</div>'
                // var display2 = '<div id="result"  class="col-md-2 col-lg-2 col-sm-1"><div class="card gal-detail thumb"><a type="button" id="wawa" onclick="choose_barang(\'' + data.data[i].kode_barang + '\',\'' + data.data[i].jumlah_persediaan + '\',\'' + data.data[i].nama_satuan + '\',\'' + data.data[i].harga_satuan + '\')"><img class="img-thumbnail img-responsive" alt="profile-image" src="<?= base_url('assets/images/barang/'); ?>' + data.data[i].gambar + '" alt="Tidak ada Gambar"><h5 >' + data.data[i].nama_barang + '</h5><p class="card-text"> Harga : ' + formatRupiah(data.data[i].harga_satuan, 'Rp.') + ' stok : <b>' + formatSatuan(data.data[i].jumlah_persediaan.toString()) + ' ' + data.data[i].nama_satuan + '</b></p></a></div></div>';
                $('#result_page').append(display).fadeIn('slow');
              }
            } else {
              $("#result_page").empty();
              display_none = '<div class="col-12 text-center"><p>Data Barang ' + kata_kunci + ' tidak ditemukan </p></div>';
              $("#result_page").append(display_none);
            }
          },
          complete: function() {
            $("#result_page").LoadingOverlay("hide", true);
          }
        });
      } else {
        $("#result_page").empty();
        display_none = '<div class="col-12 text-center"><p>Cari Data Barang di Kolom Pencarian</p></div>';
        $("#result_page").append(display_none);
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

    function choose_barang(kode_barang, persediaan, satuan, harga_jual, nama_barang) {
      var input_harga_jual = $('#dummy_harga_jual');
      var label_kode_barang = $('#label_kode_barang');
      var label_nama_barang = $('#label_nama_barang');
      var sisa_persediaan = $('#sisa_persediaan');
      var sisa_satuan = $('#sisa_satuan');

      if (persediaan !== "0") {
        $("#qty").TouchSpin({
          min: 1,
          step: 1,
          maxboostedstep: 10,
          decimals: 2,
          step: 0.1,
          postfix: satuan,
          buttondown_class: "btn btn-primary",
          buttonup_class: "btn btn-primary"
        });
        $("#qty").trigger("touchspin.updatesettings", {
          max: persediaan
        });
        input_harga_jual.val(formatRupiah(harga_jual.toString(), 'Rp.'));
        label_kode_barang.text(kode_barang);
        label_nama_barang.text(nama_barang);
        sisa_persediaan.text(persediaan);
        sisa_satuan.text(satuan);
        $('#harga_jual').val(harga_jual);
        $('#dummy_diskon').val(formatRupiah('0', 'Rp.'));
        $('#modal_detail_penjualan').modal('show');
        set_data_session_no_order_sebelumnya($('#no_order').text());
      } else {
        Swal.fire(
          'Persediaan Habis',
          '',
          'error'
        );
      }
    }
    // add ke keranjang ketika tambah di klik

    $('#button-penjualan-add').on('click', function() {
      var no_order = $('#no_order').text();
      var kode_barang = $('#label_kode_barang').text();
      var jumlah = $('#qty').val();
      var harga_jual = $('#harga_jual').val();
      var diskon = $('#diskon').val();
      var persediaan = $.ajax({
        type: "POST",
        async: false,
        url: '<?= base_url("manajemen_penjualan/purchaseordersales/get_data_persediaan/"); ?>' + kode_barang,
      }).responseText;
      console.log(persediaan);
      if (jumlah == 0 || jumlah == "") {
        Swal.fire(
          'Quantitas Salah',
          'Silahkan Cek Kembali',
          'error'
        )
      } else {
        if (jumlah <= parseInt(persediaan)) {
          push_keranjang_belanja(kode_barang, jumlah, harga_jual, diskon);
          push_total_perhitungan(no_order, 0, 0);
          notifTotalKeranjang();
        } else {
          Swal.fire(
            'Quantitas Melebihi Persediaan',
            'Silahkan Cek Kembali',
            'error'
          )
        }
      }
      $('#cari_barang').val('');
      $("#result_page").empty();
      display_none = '<div class="col-12 text-center"><p>Cari Data Barang di Kolom Pencarian</p></div>';
      $("#result_page").append(display_none);
    });

    function notiftoast() {
      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-full-width",
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
      Command: toastr["success"]("Barang ditambahkan ke keranjang")
    }

    function overide_harga() {
      $('#modal_password').modal('show');
    }

    $('#button-password-add').on('click', function() {
      var password = $('#password_input').val();
      $.ajax({
        url: "<?= Base_url('manajemen_penjualan/purchaseordersales/cekPasswordDirektur'); ?>",
        type: "post",
        data: {
          password: password
        },
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

  <!-- input ke keranjang belanjaan -->

  <script>
    function push_keranjang_belanja(kode_barang, jumlah, harga_jual, diskon) {
      var no_order = $('#no_order').text();
      $.ajax({
        url: "<?= Base_url('manajemen_penjualan/purchaseordersales/push_data_barang'); ?>",
        type: "post",
        data: {
          no_order_penjualan: no_order,
          kode_barang: kode_barang,
          jumlah_penjualan: jumlah,
          harga_jual: harga_jual,
          diskon: diskon
        },
        beforeSend: function() {
          $.LoadingOverlay("show");
        },
                complete: function() {
          $.LoadingOverlay("hide", true);
        },
        success: function(data) {
          notiftoast();
          notifKeranjang();
          search($('#cari_barang').val());
        },

      })
    }

    function set_data_session_no_order_sebelumnya(no_order) {
      sessionStorage.setItem("no_order", no_order);
    }

    function push_persediaan_temporary_tambah(jumlah_penjualan, kode_barang) {
      $.ajax({
        url: "<?= Base_url('manajemen_penjualan/purchaseordersales/persediaan_temp_tambah/'); ?>",
        type: "post",
        data: {
          kode_barang: kode_barang,
          jumlah_penjualan: jumlah_penjualan,
        },
        success: function(data) {}
      })
    }

    function push_persediaan_temporary_batal(id) {
      $.ajax({
        url: "<?= Base_url('manajemen_penjualan/purchaseordersales/persediaan_temp_batal/'); ?>",
        type: "post",
        data: {
          id: id,
        },
        success: function(data) {}
      })
    }

    function total_harga_keranjang() {
      $.ajax({
        url: "<?= base_url("manajemen_penjualan/purchaseordersales/get_sum_keranjang/"); ?>" + $('#no_order').text(),
        type: "post",
        dataType: "JSON",
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
  </script>

  <!-- Notifikasi Keranjang -->

  <script>
    function notifKeranjang() {
      var no_order = $('#no_order').text();
      $.ajax({
        url: "<?= Base_url('manajemen_penjualan/purchaseordersales/notif_keranjang/'); ?>",
        type: "post",
        dataType: 'json',
        data: {
          no_order: no_order,
        },
        beforeSend: function() {
          $("#keranjang").LoadingOverlay("show");
        },
        success: function(data) {
          $("#keranjang").empty();
          if (data.jumlah > 0) {
            $('#operatorbtn').attr('hidden', false);
            $("#jumlah_keranjang").text(data.jumlah);
            for (var i in data.data) {
              var display = '<li class="list-group-item" onClick="warning_delete(\'' + data.data[i].id + '\')"><div class="card-box"><a   class="text-danger"><div class="user-list-item"><div class="icon bg-info"><i class="mdi mdi-cube"></i></div><div class="user-desc"><span class="name"><b>' + data.data[i].nama_barang + '</b></span><span class="time">' + data.data[i].jumlah_penjualan + ' ' + data.data[i].nama_satuan + '</span></div></div></a></div></li>';
              $('#keranjang').append(display).fadeIn('slow');
            }
          } else {
            $("#jumlah_keranjang").text(0);
            $('#operatorbtn').attr('hidden', true);
          }
        },
        complete: function() {
          $("#keranjang").LoadingOverlay("hide");
        },
      });
    }

    function notifTotalKeranjang() {
      var no_order = $('#no_order').text();
      $.ajax({
        url: "<?= Base_url('manajemen_penjualan/purchaseordersales/get_total_perhitungan/'); ?>",
        type: "post",
        dataType: 'json',
        data: {
          no_order: no_order,
        },
        beforeSend: function() {
          $("#total_div").LoadingOverlay("show");
        },
        success: function(data) {
          if (data !== null) {
            $('#total_div').attr('hidden', false);
            $('#total_right').text(formatRupiah(data.total_keranjang, 'Rp.'));
          } else {
            $('#total_div').attr('hidden', true);
          }
        },
        complete: function() {
          $("#total_div").LoadingOverlay("hide");
        },
      });
    }

    function warning_delete(id) {
      swal.fire({
        title: 'Apa anda yakin ?',
        text: "Data akan di hapus..",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {

          deleteData_keranjang(id);
        }
      });
    }

    function deleteData_keranjang(id) {
      var no_order = $('#no_order').text();
      $.ajax({
        url: "<?= base_url('manajemen_penjualan/purchaseordersales/delete_data_keranjang/'); ?>" + id,
        beforeSend: function() {
          $.LoadingOverlay("show");
        },
        complete: function() {
          $.LoadingOverlay("hide");
        },
        success: function(data) {
          push_total_perhitungan(no_order, 0, 0);
          notifKeranjang();
          notifTotalKeranjang();
          swal.fire(
            'Deleted!',
            'Data telah dihapus!',
            'success'
          )
        }
      });
    }

    function push_total_perhitungan(no_order, pajak, ongkir) {
      $.ajax({
        url: "<?= Base_url('manajemen_penjualan/purchaseordersales/push_total_perhitungan_sales'); ?>",
        type: "post",
        data: {
          no_order: no_order,
          pajak: pajak,
          ongkir: ongkir,
        },
        success: function(data) {

        }
      })
    }

    function clear_data(no_order) {

      $.ajax({
        url: '<?= base_url("manajemen_penjualan/purchaseordersales/clear_keranjang_belanja/"); ?>' + no_order,
        success: function(data) {
          console.log('harus nya ad sukses');
        }
      });
    }
  </script>