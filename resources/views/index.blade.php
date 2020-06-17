@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.result_messages')

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h2><a href="#" data-toggle="modal" data-target="#addService"> Add Service</a></h2>
                        @if(!$services->isEmpty())
                        <form id="setup-form">
                            @csrf
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col"></th>

                                    @foreach($services as $service)
                                    <th scope="col">{{$service->name}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $service)
                                <tr>
                                    <th scope="row"><a href="#" class="edit-service" data-toggle="modal" data-target="#editService" data-id="{{$service->id}}">{{$service->name}}</a></th>
                                    @foreach($innerServices as $innerService)
                                    <td>
                                        <label class="checkable-box">
                                            <input class="relations-checkbox" type="checkbox" name="service[{{$service->id}}][{{$innerService->id}}]"
                                                {{$service->id == $innerService->id ? 'disabled' : ''}}
                                            {{$service->hasRelations($service->id, $innerService->id) ? 'checked' : ''}}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>

    @include('includes.modals')

@endsection
