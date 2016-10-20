<body>
    <div class="content">
        <div class="code">@yield('code')</div>
    </div>

    <div class="sidebar">
        <div class="title">PastaBin</div>

        <div class="footer">
            <h2>Powered by</h2>

            <ul class="powered-by">
                <li>Lumen</li>
                <li>Fiche</li>
                <li>highlight.js</li>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js"></script>
    <script>
        $('div.code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    </script>
    <script>
        function hashToArray() {
            var currentHash = window.location.hash.replace("#", "");
            return currentHash.split(',');
        }

        function checkHighlights() {
            var lines = hashToArray();

            $('.code > div').each(function (i, el) {
                var $el = $(el);
                var line = $el.data('line');

                if ($.inArray(line.toString(), lines) > -1) {
                    $el.addClass('target');
                } else {
                    $el.removeClass('target');
                }
            });
        }

        function updateHash(line) {
            var lines = hashToArray();
            var index = $.inArray(line.toString(), lines);

            if (index > -1) {
                lines.splice(index, 1);
            } else {
                lines.push(line);
            }

            window.location.hash = lines.join().replace(/^,/, "");

            checkHighlights();
        }

        $('.code > div').on('click', function (evt) {
            var line = $(this).data('line');

            updateHash(line);
        });

        $(document).ready(function () {
            checkHighlights();
        });
    </script>
</body>
