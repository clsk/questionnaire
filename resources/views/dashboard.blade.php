@extends('layouts.app')

@section('content')
    <div id="reactapp"></div>
    <script>
        __summary__ = {!! json_encode($summary) !!};
    </script>
@endsection
