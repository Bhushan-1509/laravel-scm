@extends('layouts.tabler')

@section('content')
    <div class="container">
        <div>
            {!! $chart->container() !!}
        </div>

        <!-- Load the charting library and initialize the chart -->
{{--        <div>--}}
{{--            {!! $chart->container() !!}--}}
{{--        </div>--}}
    </div>

    {!! $chart->script() !!}
@endsection
