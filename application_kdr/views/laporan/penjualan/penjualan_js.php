<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>


<script src="<?= base_url('assets/'); ?>plugins/moment/moment.js"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-daterangepicker/daterangepicker.js"></script>




<!-- script init -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tanggal').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
            format: 'MM/DD/YYYY',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
        });
    });

    $(document).ready(function() {
        $('#tanggal_retur').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
            format: 'MM/DD/YYYY',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-secondary',
            cancelClass: 'btn-primary',
        });
    });

    // $('#utang_form').submit(function(e) {
    //     e.preventDefault();
    //     var data = new FormData(document.getElementById("utang_form"));
    //     $.ajax({
    //         // url: '<?= base_url("laporan/utangpiutang/laporan_utang/"); ?>',
    //         // type: "post",
    //         data: data,
    //         // async:false,
    //         // processData: false,
    //         // contentType: false,
    //         beforeSend: function() {
    //             $.LoadingOverlay("show");
    //         },
    //         complete: function(data) {
    //             $.LoadingOverlay("hide");
    //         },
    //         // success: function(data) {
    //         //     window.open(this.url, '_blank');
    //         // }
    //     })
    // })
</script>