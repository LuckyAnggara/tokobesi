<?php

function warna()
{
    $my_array = array("danger", "primary", "success", "warning", "purple", "invers", "info");
    $k = array_rand($my_array);
    $v = $my_array[$k];
    return $v;
}

function urutan($urutan)
{
    if ($urutan % 2 == 0) { //Kondisi
        return "alt";
    } else {
        return "";
    }
}

function ago($timestamp)
{
    //type cast, current time, difference in timestamps
    $timestamp      = strtotime($timestamp);
    $current_time   = time();
    $diff           = $current_time - $timestamp;

    //intervals in seconds
    $intervals      = array(
        'tahun' => 31556926, 'bulan' => 2629744, 'minggu' => 604800, 'hari' => 86400, 'jam' => 3600, 'menit' => 60
    );

    //now we just find the difference
    if ($diff == 0) {
        return 'just now';
    }
    if ($diff < 60) {
        return $diff == 1 ? $diff . ' detik lalu' : $diff . ' detik lalu';
    }
    if ($diff >= 60 && $diff < $intervals['jam']) {
        $diff = floor($diff / $intervals['menit']);
        return $diff == 1 ? $diff . ' menit lalu' : $diff . ' menit lalu';
    }
    if ($diff >= $intervals['jam'] && $diff < $intervals['hari']) {
        $diff = floor($diff / $intervals['jam']);
        return $diff == 1 ? $diff . ' jam lalu' : $diff . ' jam lalu';
    }
    if ($diff >= $intervals['hari'] && $diff < $intervals['minggu']) {
        $diff = floor($diff / $intervals['hari']);
        return $diff == 1 ? $diff . ' hari lalu' : $diff . ' hari lalu';
    }
    if ($diff >= $intervals['minggu'] && $diff < $intervals['bulan']) {
        $diff = floor($diff / $intervals['minggu']);
        return $diff == 1 ? $diff . ' minggu lalu' : $diff . ' minggu lalu';
    }
    if ($diff >= $intervals['bulan'] && $diff < $intervals['tahun']) {
        $diff = floor($diff / $intervals['bulan']);
        return $diff == 1 ? $diff . ' bulan lalu' : $diff . ' bulan lalu';
    }
    if ($diff >= $intervals['tahun']) {
        $diff = floor($diff / $intervals['tahun']);
        return $diff == 1 ? $diff . ' tahun lalu' : $diff . ' tahun lalu';
    }
}

?>

<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-20">
                <button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Tanggal Terkini</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Tanggal Terakhir</a>
                    <!-- item-->
                </div>
            </div>
            <h4 class="page-title">Timeline Purchase Order : <span id="no_order"><?= $no_order; ?></span></h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->


    <div class="row">
        <div class="col-sm-12">
            <div class="timeline">
                <?php foreach ($timeline as $key => $value) : ?>
                    <article class="timeline-item <?= urutan($value['urutan']); ?>">
                        <div class="timeline-desk">
                            <div class="panel">
                                <div class="panel-body">
                                    <span class="arrow-<?= urutan($value['urutan']); ?>"></span>
                                    <span class="timeline-icon bg-<?= warna(); ?>"><i class="mdi mdi-circle"></i></span>
                                    <h4 class="text-<?= warna(); ?>"><?= ago($value['tanggal']); ?></h4>
                                    <p class="timeline-date text-muted"><small>pada : <?= date('H:i', strtotime($value['tanggal'])); ?></small></p>
                                    <hr>
                                    <p><?= nl2br($value['pesan']); ?></p>
                                    <hr>
                                    <p class="text-<?= warna(); ?>"><?= nl2br($value['nama']); ?></p>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- end row -->