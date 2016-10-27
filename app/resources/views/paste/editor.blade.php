@extends('layouts.master')

@section('content')
    <textarea id="editor" name="code"></textarea>
@endsection

@section('sidebar_content')
    <button id="btn-save" class="btn btn-block">Save pasta</button>
@endsection

@section('before_head_end')
    <link rel="stylesheet" href="/css/codemirror.css">
    <link rel="stylesheet" href="/css/solarized.css">
@endsection

@section('before_body_end')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js"></script>
    <script src="{{ elixir('js/codemirror.js') }}"></script>
    <script src="/js/addons/mode/loadmode.js"></script>
    <script src="/js/addons/edit/closebrackets.js"></script>
    <script src="/js/addons/selection/active-line.js"></script>
    <script>
        function savePaste () {
            window.editor.save();

            var code = $('#editor').val();

            if (code.length < 5) {
                showAlert('A minimum of 5 characters is required to save', 'error');
                return;
            }

            $.ajax({
                url: '/save',
                data: { code: code },
                method: 'post',
                dataType: 'json',
                success: function (response) {
                    document.location.replace(response.url);
                },
                error: function (response) {
                    var json = response.responseJSON;

                    showAlert(json.message, 'error');
                }
            });
        }

        window.editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
            lineNumbers: true,
            theme: 'solarized dark',
            autofocus: true,
            autoCloseBrackets: true
        });

        CodeMirror.modeURL = '/js/modes/%N/%N.js';

        $(document).on("keydown", function(e) {
            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                e.preventDefault();
                savePaste();
            }
        });
    </script>
    <script>
        var prevLineCount = window.editor.getDoc().lineCount();
        window.editor.on('changes', function () {
            var lineCount = window.editor.getDoc().lineCount();

            if (lineCount != prevLineCount) {
                window.editor.save();

                var mode;
                var code = $('#editor').val();
                var detectedLanguage = (code.indexOf("\<\?php") === -1 ? hljs.highlightAuto(code).language : 'php');

                prevLineCount = lineCount;

                if (['c', 'cs', 'cpp'].indexOf(detectedLanguage) > -1) {
                    mode = 'clike';
                } else {
                    mode = detectedLanguage;
                }

                if (mode != editor.getOption('mode')) {
                    console.log("Set language to '" + mode + "'");

                    // Set highlighting
                    CodeMirror.autoLoadMode(window.editor, mode);
                    editor.setOption('mode', mode);
                }
            }
        }.bind(window.editor));

        $('#btn-save').on('click', function (e) {
            savePaste();
        });
    </script>
@endsection