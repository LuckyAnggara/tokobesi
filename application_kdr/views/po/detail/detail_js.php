<script>
    $('#print_lx').on('click', function() {
        var no_order_po = "<?= $data_po['no_order_po']; ?>"
        window.open("<?= base_url('po/pocabang/print_lx/'); ?>" + no_order_po);
    })
</script>