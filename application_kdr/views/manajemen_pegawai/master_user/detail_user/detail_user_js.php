<script src="<?= base_url('assets/'); ?>plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="<?= base_url('assets/'); ?>plugins/jquery-mask/jquery.mask.min.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- DatePicker Js -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- file uploads js -->
<script src="<?= base_url('assets/'); ?>plugins/fileuploads/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url('assets/'); ?>plugins/chartjs/chart.bundle.min.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?= base_url('assets/'); ?>plugins/sweet-alert/sweetalert2.all.min.js"></script>

<!-- Select2 js -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>



<!-- script Uploader -->
<script type="text/javascript">
    $('#gambar').dropify({
        messages: {
            'default': 'Drag dan drop Gambar Barang disini',
            'replace': 'Drag dan drop gambar untuk mengganti',
            'remove': 'Hapus',
            'error': 'Ooops, terjadi sesuatu, silahkan coba lagi.'
        },
        tpl: {
            clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
        },
        error: {
            'fileSize': 'File terlalu besar (3 Mb max).',
            'imageFormat': 'Format Gambar tidak Support, hanya ({{ value }} saja).'
        },
    });
</script>


<script>
    $(document).ready(function() {
        $('#edit_gambar_modal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $('.dropify-clear').click();
        });

         init_data()
    });
</script>


<!-- Tampilkan Modal Edit Gambar -->

<script>
    $(document).ready(function() {
        $('#edit_gambar_button').on('click', function() {
            $('#edit_gambar_modal').modal('show');
        });

        // Upload Gambar
        $('#edit_gambar_form').submit(function(e) {
            e.preventDefault();
            var username = $('#username').val();
            var data = new FormData(document.getElementById("edit_gambar_form"));
            data.append('username', username);
            $.ajax({
                url: '<?= base_url("manajemen_pegawai/masteruser/SetGambarBaru/"); ?>' + username,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#edit_gambar_modal').modal('hide');
                    setGambarBaru(username);
                }
            })
        });

        function setGambarBaru(username) {
            $.ajax({
                url: '<?= base_url("manajemen_pegawai/masteruser/GetGambarBaru/"); ?>' + username,
                type: "POST",
                dataType: "JSON",
                async: false,
                success: function(data) {
                    $('#gambar_user').fadeOut(2000, function() {
                        $('#gambar_user').attr('src', "<?= base_url('assets/images/users/'); ?>" + data.avatar)
                        $('#gambar_user').fadeIn(2000);
                    });
                    Swal.fire(
                        'Sukses!',
                        'Gambar telah di ubah.',
                        'success'
                    );
                }
            });

        }
    });
</script>

<!-- init data -->

<script>
function init_data()
{
    var username = "<?= $this->session->userdata('username');?>"
    $.ajax({
            url: "<?= Base_url('manajemen_pegawai/masteruser/getdetailuser'); ?>",
            type: "post",
            dataType: 'json',
            data: {
                username: username
            },
            async: false,
            beforeSend: function(data) {
                $.LoadingOverlay("show");
            },
            success: function(data) {
                $('#username').val(data.username);
                $('#nama_lengkap').val(data.nama);
                $('#gambar_user').fadeOut(10, function() {
                        $('#gambar_user').attr('src', "<?= base_url('assets/images/users/'); ?>" + data.avatar)
                        $('#gambar_user').fadeIn(2000);
                });
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
        })
}

</script>

<!-- Ganti Password -->
<script>
        $('#ubah_password').on('click', function(){
            var username = $('#username').val();
            var password_baru = $('#password_baru').val()
            var konfirm_password = $('#konfirm_password').val()
            if(password_baru !== konfirm_password){
                    Swal.fire(
                        'Oopss!',
                        'Konfirmasi password tidak sama!',
                        'error'
                    );
                    $('#konfirm_password').val('');
            }else{
            var data = new FormData(document.getElementById("form_password"));
            data.append('username', username);
            $.ajax({
                url: '<?= base_url("manajemen_pegawai/masteruser/changepassword/"); ?>' + username,
                type: "post",
                data: data,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                   if ( data == "salah")
                   {
                    Swal.fire(
                        'Oopss!',
                        'Password lama salah!',
                        'error'
                    );
                       $('#password_lama').val('');
                      $('#password_baru').val('');
                       $('#konfirm_password').val('');
                   }else{
                    Swal.fire(
                        'Sukses!',
                        'Password telah di ganti',
                        'success'
                    );
                      $('#password_lama').val('');
                      $('#password_baru').val('');
                       $('#konfirm_password').val('');
                   }
                }
            })
            }
            
        });

</script>