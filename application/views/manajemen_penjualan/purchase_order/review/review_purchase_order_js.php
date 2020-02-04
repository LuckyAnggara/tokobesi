<!-- bootstrap touchspin -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Moment js -->
<script src="<?= base_url('assets/'); ?>plugins/moment/min/moment.min.js" type="text/javascript"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- switchery -->
<script src="<?= base_url('assets/'); ?>plugins/switchery/switchery.min.js"></script>

<script src="<?= base_url('assets/'); ?>plugins/jquery-loader/jquery.loading.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>


<script>
    $(document).ready(function() {
        $("#qty").TouchSpin({
            verticalbuttons: true,
            buttondown_class: "btn btn-primary",
            buttonup_class: "btn btn-primary",
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $("#qty").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('#qty').prev('.bootstrap-touchspin-prefix').remove();
        }
    });


    function setData() {
        var no_order = window.location.hash.substr(1);
        console.log(no_order);
        // $.ajax({
        //     url: "<?= Base_url('Manajemen_Penjualan/ReviewPurchaseOrder/setDataReview'); ?>",
        //     type: "post",
        //     data: {
        //         no_order_penjualan: no_order,
        //     },
        //     cache: false,
        //     async: false,
        //     beforeSend: function() {
        //         $("#loading").loading();
        //     },
        //     success: function(data) {
        //         $('#loading').loading('stop');
        //     }
        // });
    }
</script>