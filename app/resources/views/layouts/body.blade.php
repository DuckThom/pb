<body>
    @yield('after_body_open')

    <div id="sidebar">
        @include('partials.sidebar')
    </div>

    <div id="content-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>

    @yield('after_content')

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>

    @yield('before_body_end')
</body>
