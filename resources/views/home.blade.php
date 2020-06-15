@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.result_messages')

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h2>Services</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.modals')

@endsection
