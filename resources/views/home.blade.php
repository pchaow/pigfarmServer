@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Menu</div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">หน้าหลัก</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">รายงานประสิทธิภาพ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">ค้นหาสุกร</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <example-chart-1></example-chart-1>
                <example-component></example-component>

                <div class="card mb-3">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">


                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
