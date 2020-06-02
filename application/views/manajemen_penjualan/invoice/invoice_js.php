<script>
    //  href="<?= base_url('laporan/invoice/tunai/') . $data_order['no_order_penjualan']; ?>" 
    $('#print_lx').on('click', function() {
        var no_order = '<?= $data_order['no_order_penjualan']; ?>'
        Swal.fire({
            title: 'Print Surat Jalan ?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya !',
            cancelButtonText: 'Tidak !',
        }).then((result) => {
            if (result.value) {
                konfirm(no_order);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.open("<?= base_url('laporan/invoice/tunai/'); ?>" + no_order);
            }
        })
    })

    async function konfirm(no_order) {
        const {
            value: text
        } = await Swal.fire({
            title: 'Input Nomor Polisi Kendaraan',
            input: 'text',
            focusConfirm: false,
            showCancelButton: false,
        })
        if (text) {
            swal.fire({
                title: 'Print ??',
                text: 'Nomor Polisi : ' + text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Print !'
            }).then((result) => {
                proses_surat_jalan(text, no_order)
            })
        } else {
            Swal.fire({
                title: 'Oopss!',
                icon: 'error',
            })
        }
    }

    function proses_surat_jalan(no_pol, no_order) {
        $.ajax({
            url: '<?= base_url("manajemen_penjualan/penjualanbarang/surat_jalan/"); ?>',
            type: "post",
            data: {
                no_pol: no_pol,
                no_order: no_order,
            },
            dataType: 'json',
            beforeSend: function(data) {
                
                $.LoadingOverlay("show");
            },
            complete: function(data) {
                $.LoadingOverlay("hide", true);
                // console.log(data.responseText);
                
                if (data.responseText !== "") {
                    window.open("<?= base_url('laporan/invoice/no_polisi/'); ?>" + no_order);
                    window.open("<?= base_url('laporan/invoice/tunai/'); ?>" + no_order);
                    
                } else {
 
                }
            },
            success: function(data) {
                // console.log(data);
               
                
                // if (data !== "") {
                //     // window.open("<?= base_url('laporan/invoice/no_polisi/'); ?>" + no_order);
                //     // window.open("<?= base_url('laporan/invoice/tunai/'); ?>" + no_order);
                    
                // } else {
 
                // }
            },
        });
    }
</script>