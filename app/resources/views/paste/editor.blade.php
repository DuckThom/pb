@extends('layouts.master')

@section('content')
    <textarea id="editor" name="code"></textarea>
@endsection

@section('sidebar_content')
    <button id="btn-save" class="btn btn-block">Save pasta</button>

    <hr />
@endsection

@section('before_head_end')
    <link rel="stylesheet" href="/css/codemirror.css">
    <link rel="stylesheet" href="/css/solarized.css">
@endsection

@section('before_body_end')
    <script src="{{ elixir('js/codemirror.js') }}"></script>
    <script>
        window.CodeMirror = CodeMirror.fromTextArea(document.getElementById('editor'), {
            lineNumbers: true,
            theme: 'solarized dark',
            autofocus: true,

        });

        $('#btn-save').on('click', function (e) {
            window.CodeMirror.save();

            var code = $('#editor').val();

            if (code.length < 5) {
                alert('A minimum of 5 characters is required to save');
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

                    alert(json.message);
                }
            })
        });
    </script>
@endsection