<!-- DataTables -->
<link href="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/'); ?>plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Select2 Css -->
<link href="<?= base_url('assets/'); ?>plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- datepicker -->
<link href="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?= base_url('assets/'); ?>plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<style type="text/css" media="print">
    @page {
        size: auto;
        /* auto is the initial value */
        margin: 0mm;
        /* this affects the margin in the printer settings */
    }

    html {
        background-color: #FFFFFF;
        margin: 0px;
        /* this affects the margin on the html before sending to printer */
    }

    body {
        border: solid 1px blue;
        margin: 10mm 15mm 10mm 15mm;
        /* margin you want for the content */
    }

    @media print {
    body, html {
        display: block;
    }
</style>