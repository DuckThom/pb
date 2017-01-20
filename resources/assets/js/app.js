var $alert = $('#alert');

var showAlert = function (message, type) {
    $alert.html(message).addClass('alert-' + type);

    $alert.animate({ bottom: '20px' }, 400, 'swing', function () {
        $alert.delay(5000)
            .animate({ bottom: '-999px' }, 400, 'swing', function () {
                $alert.removeClass('alert-' + type).html('');
            });
    });
}