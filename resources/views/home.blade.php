@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            @component('menus.menus')
            @endcomponent

            <div class="col">
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
