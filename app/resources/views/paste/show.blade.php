@extends('layouts.master')

@section('content')
    <div class="code">
        @foreach($paste->getLines() as $line)
            <?php $prefix = (strlen($loop->count) < 5 ? str_pad($loop->iteration, 5, " ", STR_PAD_LEFT) : str_pad($loop->iteration, strlen($loop->count), " ", STR_PAD_LEFT)); ?>
<div data-line="{{ $loop->iteration }}" data-prefix="{{ $prefix }}">{{ $line }}&nbsp;</div>
        @endforeach
    </div>
@endsection

@section('sidebar_content')
    <a class="btn btn-block" href="/">New paste</a>
    <button class="btn btn-block">Copy url</button>
    <button class="btn btn-block">Fork on GitHub</button>
    <button class="btn btn-block">Fork on Kopy.io</button>

    <hr />

    <dl>
        <dt>Created at</dt>
        <dd>{{ $paste->created_at->format('Y-m-d H:m') }}</dd>

        <dt>Creator</dt>
        <dd>{{ $paste->creator }}</dd>
    </dl>
@endsection

@section('before_body_end')
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
@endsection