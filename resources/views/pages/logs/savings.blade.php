@extends('adminlte::page')

@section('title', 'Savings Logs')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endsection

@section('content_header')
    <h1>Savings Complete Activity Logs</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10">
            <table class="table table-stripped table-bordered">
                    <thead style="background: aqua">
                        <tr>
                            <th>DATE/TIME</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activity_logs as $logs)
                            <tr>
                                <td>{{$logs->created_at->format('M d Y H:i:s A D')}}</td>
                                <td>{{$logs->actions}}</td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
    </div>
    <div class="col-md-6 col-sm-12" style="margin-bottom:20px">
            {!! $activity_logs->render() !!}
       
       </div>
</div>

 
@endsection

@section('js')

@endsection