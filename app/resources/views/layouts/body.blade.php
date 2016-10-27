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

    <script src="{{ elixir('js/jquery.min.js') }}"></script>
    <script src="{{ elixir('js/app.js') }}"></script>

    @yield('before_body_end')
</body>
