@extends('layouts.app')

@section('content')
    <div id="reactapp"></div>
    <script>
        __questions__ = {!! json_encode($questions) !!};
    </script>
@endsection
