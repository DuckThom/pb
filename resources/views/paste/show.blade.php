@extends('layouts.master')

@section('code')
    @foreach(explode("\n", $code) as $line)
        <?php $prefix = str_pad($loop->iteration, (strlen($loop->count) < 3 ? 3 : strlen($loop->count)), " ", STR_PAD_LEFT); ?>
<div data-prefix="{{ $prefix }}">{{ ($line ?: "&nbsp;") }}</div>
    @endforeach
@endsection