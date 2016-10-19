<body>
    <div class="content">
        <pre><code>@yield('code')</code></pre>
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
        hljs.initHighlightingOnLoad();
    </script>
</body>
