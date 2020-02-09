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
  <!-- Select2 js -->
  <script src="<?= base_url('assets/'); ?>plugins/moment/min/moment.min.js" type="text/javascript"></script>

  <!-- DatePicker Js -->
  <script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <!-- fuse search js -->
  <script src="<?= base_url('assets/'); ?>plugins/fuse-js/fuse.js" type="text/javascript"></script>

  <!-- Modal-Effect -->
  <script src="<?= base_url('assets/'); ?>plugins/custombox/dist/custombox.min.js"></script>
  <script src="<?= base_url('assets/'); ?>plugins/custombox/dist/legacy.min.js"></script>

  <!-- Toastr js -->
  <script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>

  <!-- switchery -->
  <script src="<?= base_url('assets/'); ?>plugins/switchery/switchery.min.js"></script>

  <script src="<?= base_url('assets/'); ?>plugins/jquery-loader/jquery.loading.js"></script>


  <!-- Fungsi Checkout -->
  <script>
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
  </script>

  <script>
    $('#checkout').on('click', function() {
      var data_label_chekcout = $('#data_label_chekcout');
      var nama_pelanggan = $('#nama_pelanggan');
      var no_order = $('#no_order').text();
      $('#tanggal_jatuh_tempo').datepicker({
        autoclose: true,
        todayHighlight: true,
        showOn: "button",
        minDate: moment(),
        inline: true,
        changeMonth: true,
        changeYear: true,
      });

      $('#tanggal_faktur').datepicker({
        autoclose: true,
        todayHighlight: true,
        showOn: "button",
        minDate: moment(),
        inline: true,
        changeMonth: true,
        changeYear: true,
      });
      set_grand_total(no_order);
      data_label_chekcout.text('Checkout Nomor Order : ' + no_order);
      $('#checkout_modal').modal('show');

    });

    function set_grand_total(no_order) {
      var total_checkout = $('#total_checkout'); // text
      var total_diskon = $('#checkout_discount'); // text
      var total_pajak = $('#total_pajak'); // text
      var total_ongkir = $('#ongkir'); // val
      var total_setelah_pajak = $('#total_setelah_pajak'); //total setelah diskon dan pajak
      var grand_total = $('#checkout_grand_total'); // text
      var terbilang_total_checkout = $('#total_checkout_terbilang');
      var terbilang_setelah_pajak = $('#total_setelah_pajak_terbilang');
      var terbilang_grand_total = $('#checkout_grand_total_terbilang');
      var diskon_text = $('#diskon_text');
      var dummy_dp = $('#dummy_dp');
      var dp = $('#dp');

      $.ajax({
        url: '<?= base_url("Manajemen_Penjualan/PurchaseOrderAdmin/get_total_perhitungan/"); ?>' + no_order,
        type: "POST",
        dataType: "JSON",
        async: false,
        success: function(data) {
          // matematika
          // total order - diskon
          var total1 = parseInt(data.total_penjualan) - parseInt(data.diskon) // data total setelah diskon
          var total2 = total1 + parseInt(data.pajak_masukan) // data total setalah di tambah pajak 10%
          var total3 = total2 + parseInt(data.ongkir) // data grand_total setalah Pajak

          var diskon = (parseInt(data.diskon) / parseInt(data.total_penjualan)) * 100;


          total_checkout.text(formatRupiah(data.total_penjualan, 'Rp.'));
          total_diskon.text(formatRupiah(data.diskon, 'Rp.'));
          total_pajak.val(formatRupiah(data.pajak_masukan, 'Rp.'));
          total_ongkir.val(formatRupiah(data.ongkir, 'Rp.'));
          total_setelah_pajak.text(formatRupiah(total2.toString(), 'Rp.'));
          grand_total.text(formatRupiah(total3.toString(), 'Rp.'));
          diskon_text.text(diskon);

          dummy_dp.val(formatRupiah("0", 'Rp.'));
          dp.val(0);

          // terbilang

          terbilang_total_checkout.text(terbilang(data.total_penjualan));
          terbilang_setelah_pajak.text(terbilang(total2.toString()));
          terbilang_grand_total.text(terbilang(total3.toString()));

          if (total_pajak.val() !== "Rp. 0") {
            tutup_tombol_pajak();
          }
        }
      });
    }

    var ongkir_satuan = document.getElementById('ongkir');
    ongkir_satuan.addEventListener('keyup', function(e) {
      ongkir_satuan.value = formatRupiah(this.value, 'Rp. ');
      var ongkir_dummy = normalrupiah(ongkir_satuan.value);
    });


    // format DP ke Rupiah dan Isi Persentasi
    var dp = document.getElementById('dummy_dp');
    dp.addEventListener('keyup', function(e) {
      dp.value = formatRupiah(this.value, 'Rp. ');

      $('#dp').val(normalrupiah(dp.value));
      // presentasi

      var grand_total_normal = normalrupiah($('#checkout_grand_total').text());

      var presentase = (($('#dp').val() / grand_total_normal) * 100).toFixed(1);
      $('#apply_dp').text(presentase + '%');

      if (presentase > 100) {
        Swal.fire({
          icon: 'error',
          title: 'Over Price',
          text: 'Down Payment (DP) melebihi Total Harga !!',
        });
        dp.value = formatRupiah("0", 'Rp. ');
        $('#dp').val(normalrupiah(dp.value));
      }

    });

    $('#apply_ongkir').on('click', function() {
      var ongkir = document.getElementById('ongkir');
      if (ongkir.value !== "") {

        // push ker tabel total perhitungan untuk ditambah kan ongkir

        var no_order = $('#no_order').text();
        var total_diskon = normalrupiah($('#checkout_discount').text());
        var total_ongkir = normalrupiah($('#ongkir').val());
        var pajak = normalrupiah($('#total_pajak').val());
        var total_keranjang = normalrupiah($('#total_keranjang').text());
        var grand_total = parseInt(total_keranjang) - parseInt(total_diskon);
        grand_total = grand_total + parseInt(total_ongkir);


        push_total_perhitungan(no_order, pajak, total_ongkir);

      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Ongkir Belum di Isi!',
        });
      }
    });

    function push_total_perhitungan(no_order, pajak, ongkir) {
      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PurchaseOrderAdmin/push_total_perhitungan'); ?>",
        type: "post",
        data: {
          no_order: no_order,
          pajak: pajak,
          ongkir: ongkir,
        },
        cache: false,
        async: false,
        success: function(data) {
          set_grand_total(no_order);
        },

      })
    }

    function tutup_tombol_pajak() {
      $('#div_cari-pajak').empty();
      var display = '<button id="pajak-edit" onClick="batal_pajak();" name="pajak-edit" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-history"></i></button>'
      $('#div_cari-pajak').append(display);
    }

    function apply_pajak() {

      var no_order = $('#no_order').text();

      var total_checkout = normalrupiah($('#total_checkout').text()); // text
      var total_diskon = normalrupiah($('#checkout_discount').text()); // text
      var total_ongkir = normalrupiah($('#ongkir').val());



      var pajak = (total_checkout - total_diskon) * 0.10;

      console.log(pajak);

      push_total_perhitungan(no_order, pajak, total_ongkir);
      tutup_tombol_pajak();
    }

    function batal_pajak() {
      var no_order = $('#no_order').text();
      var total_ongkir = normalrupiah($('#ongkir').val());


      var display2 = '<button id="apply_pajak" onClick="apply_pajak();" name="apply_pajak" class="btn btn-dark waves-effect waves-light" type="button"><i class="fa fa-check"></i></button>'
      $('#div_cari-pajak').empty();

      $('#div_cari-pajak').append(display2);

      push_total_perhitungan(no_order, 0, total_ongkir);
    };



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
  </script>

  <!-- bayar_checkout -->

  <script>
    $('#bayar_checkout').on('click', function() {
      var tanggal_faktur = $('#tanggal_faktur').val();
      var no_order_penjualan = $('#no_order').text();
      var nama_pelanggan = $('#nama_pelanggan').val();
      var id_pelanggan = $('#id_pelanggan').val()
      var alamat = $('#alamat').val()
      var nomor_telepon = $('#nomor_telepon').val()
      var isDisabled = $('#id_pelanggan').is(':disabled');
      var tanggal_jatuh_tempo = $('#tanggal_jatuh_tempo').val();
      var dp = $('#dp').val();

      if (tanggal_faktur == "") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Tanggal faktur belum di Isi!!',
        }).then((result) => {
          $('#tanggal_faktur').focus();
        });
      } else {
        if ($("#check_pembayaran").is(':checked')) {
          var status = 0
          if (tanggal_jatuh_tempo == "") {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Tanggal jatuh tempo belum di Isi!!',
            });

          } else {
            proses();
          }
        } else {
          var status = 1
          if (nama_pelanggan == "") {
            warning_pelanggan_kosong();
          } else {
            proses();
          }
        }
      }


      function proses() {
        Swal.fire({
          title: 'Proses ??',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Proses!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= Base_url('Manajemen_Penjualan/PurchaseOrderAdmin/bayar_checkout/'); ?>",
              type: "post",
              data: {
                tanggal_faktur: tanggal_faktur,
                no_order_penjualan: no_order_penjualan,
                id_pelanggan: id_pelanggan,
                nama_pelanggan: nama_pelanggan,
                alamat: alamat,
                nomor_telepon: nomor_telepon,
                status: status, // lunas
                // untuk kredit
                down_payment: dp,
                tanggal_jatuh_tempo: tanggal_jatuh_tempo
              },
              cache: false,
              async: false,
              beforeSend: function() {
                // Show image container
                $.LoadingOverlay("show");
              },
              success: function(data) {
                if (data == "error") {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ada Kesalahan!',
                  });

                  revertProsesError();
                } else {
                  Swal.fire({
                    title: 'Paid!!',
                    text: "Order " + no_order_penjualan + " telah di bayar!",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cetak Faktur ?'
                  }).then((result) => {
                    if (result.value) {
                      window.location.replace("<?= base_url('Manajemen_Penjualan/PenjualanBarang/Invoice/'); ?>" + no_order_penjualan)
                    }
                  });
                  $('#checkout_modal').modal('hide');
                  sessionStorage.setItem("no_order", 'xxx');
                }

              },
              complete: function(data) {
                // Hide image container
                $.LoadingOverlay("hide");
              }
            });
          }
        })

      }
    });

    function revertProsesError() {
      $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/revert_error/'); ?>",
        cache: false,
        async: false,
        success: function(data) {
          if (data == "error") {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Ada Kesalahan! Silahkan Refresh Halaman',
            });
          }
        }
      });
    }

    function init_table_pelanggan() {
      var table = $('#datatable-master-pelanggan').DataTable({
        destroy: true,
        paging: true,
        "oLanguage": {
          sProcessing: "Sabar yah...",
          sZeroRecords: "Tidak ada Data..."
        },
        "info": false,
        "order": true,
        "searching": true,
        "ajax": {
          "url": '<?= base_url("Manajemen_Data/MasterPelanggan/getData/"); ?>',
          "type": "POST",
        },
        "columnDefs": [{
            data: "id_pelanggan",
            targets: 0,
            render: function(data, type, full, meta) {
              return data;
            }
          },
          {
            data: "nama_pelanggan",
            targets: 1,
            render: function(data, type, full, meta) {
              return data;
            }
          }
        ],
      });
    }
  </script>

  <!-- Tunai $ Kredit -->

  <script>
    $('#check_pembayaran').change(function() {
      if (this.checked) {
        if ($('#id_pelanggan').is(':disabled') == false) {
          var id_pelanggan = "";
        } else {
          var id_pelanggan = $('#id_pelanggan').val();
        }

        var cek = cek_pelanggan(id_pelanggan);
        if (parseInt(cek) > 0) {
          $('#kredit_div').attr('hidden', false).fadeIn(500);
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Bukan Pelanggan, tidak bisa di beri Kredit!',
          });
          $('#check_pembayaran').prop('checked', false);
        }

      } else {
        $('#kredit_div').attr('hidden', true).fadeOut(5000);
      }
    });

    function cek_pelanggan(id_pelanggan = "") {
      return $.ajax({
        url: "<?= Base_url('Manajemen_Penjualan/PenjualanBarang/cek_pelanggan/'); ?>" + id_pelanggan,
        type: "post",
        dataType: "text",
        async: false
      }).responseText;
    }
  </script>


  <!-- RETURN & REJECT SCRIPT -->

  <script>
    async function reject() {
      var no_order = $('#no_order').text();
      const {
        value: text
      } = await Swal.fire({
        input: 'textarea',
        inputPlaceholder: 'Type your message here...',
        inputAttributes: {
          'aria-label': 'Type your message here'
        },
        showCancelButton: true
      })
      if (text) {
        Swal.fire({
          title: 'Reject ??',
          text: 'Pesan anda : ' + text,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Proses!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= Base_url('Manajemen_Penjualan/PurchaseOrderAdmin/reject/'); ?>",
              data: {
                no_order: no_order,
                pesan: text
              },
              type: "post",
              async: false,
              beforeSend: function() {
                $.LoadingOverlay("show");
              },
              complete: function() {
                $.LoadingOverlay("hide");
              },
              success: function(data) {
                setTimeout(function() {
                  location.reload(true);
                }, 3000);
                Swal.fire({
                  icon: 'success',
                  title: 'Pesanan di Reject!!',
                  text: 'Silahkan Hubungi Sales',
                }).then((result) => {
                  location.reload(true);
                });
              }
            })
          }
        })
      } else {
        Swal.fire({
          title: 'Silahkan tulis pesan di Kolom Pesan',
          icon: 'error',
        })
      }
    }
    $('#reject').on('click', function() {
      reject();
    })

    async function return_order() {
      var no_order = $('#no_order').text();
      const {
        value: text
      } = await Swal.fire({
        input: 'textarea',
        inputPlaceholder: 'Type your message here...',
        inputAttributes: {
          'aria-label': 'Type your message here'
        },
        showCancelButton: true
      })
      if (text) {
        Swal.fire({
          title: 'Return to Sales ??',
          text: 'Pesan anda : ' + text,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Proses!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= Base_url('Manajemen_Penjualan/PurchaseOrderAdmin/return/'); ?>",
              data: {
                no_order: no_order,
                pesan: text
              },
              type: "post",
              async: false,
              beforeSend: function() {
                $.LoadingOverlay("show");
              },
              complete: function() {
                $.LoadingOverlay("hide");
              },
              success: function(data) {
                setTimeout(function() {
                  location.reload(true);
                }, 3000);
                Swal.fire({
                  icon: 'success',
                  title: 'Pesanan di Kembalikan ke Sales!!',
                  text: 'Silahkan Hubungi Sales',
                }).then((result) => {
                  location.reload(true);
                });
              }
            })
          }
        })
      } else {
        Swal.fire({
          title: 'Silahkan tulis pesan di Kolom Pesan',
          icon: 'error',
        })
      }
    }

    $('#return').on('click', function() {
      return_order();
    })
  </script>