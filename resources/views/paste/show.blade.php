@extends('layouts.master')

@section('code')
    @foreach(explode("\n", $code) as $line)
<div data-prefix="{{ $loop->iteration }}">{{ $line }}&nbsp;</div>
    @endforeach
@endsection