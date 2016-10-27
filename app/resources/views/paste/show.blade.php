@extends('layouts.master')

@section('content')
    <textarea id="code" name="code">{{ $paste->content }}</textarea>
@endsection

@section('sidebar_content')
    <a class="btn btn-block" href="/">New pasta</a>
    <button id="btn-copy"
            data-clipboard-action="copy"
            data-clipboard-text="{{ secure_url($paste->slug) }}"
            class="btn btn-block">Copy url</button>

    <dl>
        <dt>Created at</dt>
        <dd>{{ $paste->created_at->format('Y-m-d h:i') }}</dd>

        <dt>Creator</dt>
        <dd>{{ $paste->creator }}</dd>
    </dl>
@endsection

@section('before_head_end')
    <link rel="stylesheet" href="/css/codemirror.css">
    <link rel="stylesheet" href="/css/solarized.css">
@endsection

@section('before_body_end')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js"></script>
    <script src="{{ elixir('js/clipboard.min.js') }}"></script>
    <script src="{{ elixir('js/codemirror.js') }}"></script>
    <script src="/js/addons/mode/loadmode.js"></script>
    <script>
        var clipboard = new Clipboard('#btn-copy');

        clipboard.on('success', function(e) {
            showAlert('Link copied!', 'success');
            e.clearSelection();
        });
    </script>
    <script>
        var $code = $('#code').val();

        window.code = CodeMirror.fromTextArea(document.getElementById('code'), {
            lineNumbers: true,
            gutters: ["highlights", "CodeMirror-linenumbers"],
            theme: 'solarized dark',
            autofocus: false,
            readOnly: 'nocursor',
            value: code,
            extraGutterSize: 4
        });

        CodeMirror.modeURL = '/js/modes/%N/%N.js';

        var detectedLanguage = ($code.indexOf("\<\?php") === -1 ? hljs.highlightAuto($code).language : 'php');

        if (['c', 'cs', 'cpp'].indexOf(detectedLanguage) > -1) {
            mode = 'clike';
        } else if (['bash', 'sh', 'zsh'].indexOf(detectedLanguage) > -1) {
            mode = 'shell';
        } else {
            mode = detectedLanguage;
        }

        // Set highlighting
        CodeMirror.autoLoadMode(window.code, mode);
        code.setOption('mode', mode);
    </script>
    <script>
        function setHighlight (highlight, lineHandle) {
            var marker = null;

            if (highlight) {
                window.code.getDoc().addLineClass(lineHandle, 'background', 'highlighted');

                marker = document.createElement("div");
                marker.style.color = "#fdf6e3";
                marker.className = 'gutter-highlight';
                marker.innerHTML = "▶";
            } else {
                window.code.getDoc().removeLineClass(lineHandle, 'background', 'highlighted');
            }

            return marker;
        }

        function hashToArray () {
            var currentHash = window.location.hash.replace("#", "");
            return currentHash.split(',');
        }

        function checkHighlights () {
            var lines = hashToArray();

            window.code.getDoc().eachLine(function (line) {
                var lineInfo = window.code.lineInfo(line);
                var index = $.inArray((lineInfo.line+1).toString(), lines);

                window.code.setGutterMarker(line, 'highlights', setHighlight((index > -1), line));
            });
        }

        function updateHash (line) {
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

        window.code.on('gutterClick', function (cm, line, gutter, event) {
            updateHash(line+1);
        });

        $(document).ready(function () {
            checkHighlights();
        });
    </script>
@endsection