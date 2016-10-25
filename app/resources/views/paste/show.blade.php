@extends('layouts.master')

@section('code')
    @foreach($paste->getLines() as $line)
        <?php $prefix = (strlen($loop->count) < 5 ? str_pad($loop->iteration, 5, " ", STR_PAD_LEFT) : str_pad($loop->iteration, strlen($loop->count), " ", STR_PAD_LEFT)); ?>
<div data-line="{{ $loop->iteration }}" data-prefix="{{ $prefix }}">{{ $line }}&nbsp;</div>
    @endforeach
@endsection