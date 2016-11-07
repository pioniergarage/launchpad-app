@extends('layouts.master')

@section('title', $user->getName())
@section('subtitle', 'User detail')

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Users</li>
        <li class="active">{{ $user->getName() }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-star"></i>
                    <h3 class="box-title">Die letzten erhaltenen Props</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <tbody>
                        @foreach($propsReceived as $props)
                            <tr>
                                <td>{{ $props->activity }}</td>
                                <td>{{ $props->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-star"></i>
                    <h3 class="box-title">Die letzten verteilten Props</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <tbody>
                        @foreach($propsGiven as $props)
                            <tr>
                                <td>{{ $props->receiver->getName() }}</td>
                                <td>{{ $props->activity }}</td>
                                <td>{{ $props->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection