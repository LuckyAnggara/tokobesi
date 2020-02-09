$(document).ready(function () { // CALL FUNCTION SHOW PRODUCT

    var pusher = new Pusher('a198692078b54078587e', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        if (data.message === 'sales') {
            notiftoast();
            playAudio();
        }
    });

    function notiftoast() {

        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "100",
            "hideDuration": "500",
            "timeOut": "2000",
            "extendedTimeOut": "500",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        Command : toastr["info"]("Order Baru dari Sales", "Order Baru !!")

    }
    function playAudio() {
        var url = "assets/sound/notif.mp3"
        new Audio(url).play();
        console.log('play');
    }
    function play() {
        var audio = document.getElementById("audio");
        audio.play();
    }


});