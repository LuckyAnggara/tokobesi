<!-- App js -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-loader/jquery.loading.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>

<!-- Toastr Js -->
<script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>
<!-- <script src="<?= base_url('assets/'); ?>plugins/currency/currency.js"></script> -->
<script src="<?= base_url('assets/'); ?>js/jquery.core.js"></script>
<script src="<?= base_url('assets/'); ?>js/jquery.app.js"></script>
<script src="<?= base_url('assets/'); ?>js/pesan.js"></script>

<script>
$(document).ready(function() {
    reload_pesan();
})

function read_pesan(id)
{
    $.ajax({
        url: "<?= base_url('setting/pesan/read_pesan'); ?>",
        type: "post",
        data : {
            id : id
        },
        success: function(data) {
            reload_pesan()
        }
    })
}
function reload_pesan()
{ 
    $.ajax({
        url: "<?= base_url('setting/pesan/reload_pesan'); ?>",
        type: "post",
        dataType:'JSON',
        async: false,
        success: function(data) {
            var pesan = $('#pesan_pesan')
            pesan.empty();
            for (var i in data) {
            if(data[i].is_read == 0){
                var status = '<span class="badge badge-danger">unread</span>'
            }else{
                var status = '<span class="badge badge-success">read</span>'
            }
            var display = ' <li class="list-group-item"><a type="button" onClick="read_pesan(\'' + data[i].id + '\')" '+
               'class="user-list-item">'+
               '<div class="avatar"><img src="<?= base_url("assets/images/avatar/");?>'+ data[i].avatar + '">'+
               '</div><div class="user-desc"><div class="row">'+
               '<div class="col-9"><span class="name">'+ data[i].nama +'</span> '+
               '</div>'+
               '<div class="col-3">'+ status +
               '</div>'+
               '</div>'+
               '<span class="desc">'+ data[i].pesan +'</span>'+
               '<span class="time">2 hours ago</span>'+
               '</div>'+
               '</a>'+
               '</li>'
               pesan.append(display)
            }
        }
    });
}
</script>

</body>

</html>