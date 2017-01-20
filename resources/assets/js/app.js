var $alert = $('#alert');
var $sidebar = $('#sidebar');
var $sidebarToggle = $('#sidebar-toggle');
var $content = $('.content');

var showAlert = function (message, type) {
    $alert.html(message).addClass('alert-' + type);

    $alert.animate({ bottom: '20px' }, 400, 'swing', function () {
        $alert.delay(5000)
            .animate({ bottom: '-999px' }, 400, 'swing', function () {
                $alert.removeClass('alert-' + type).html('');
            });
    });
};

var toggleSidebar = function () {
    if ($sidebar.hasClass('show')) {
        $sidebar.removeClass('show');
        $content.removeClass('padded');
    } else {
        $sidebar.addClass('show');
        $content.addClass('padded');
    }
};

$sidebarToggle.on('click', toggleSidebar);