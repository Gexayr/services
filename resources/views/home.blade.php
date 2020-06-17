@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.result_messages')

        <div class="row justify-content">

            @if(!$services->isEmpty())
                @csrf
                @foreach($services as $service)

                    <div class="col-md-4 service-block">
                        <div class="card">
                            <div class="card-body">
                                <h2><img src="/img/service.png" width="60" alt="service"/>{{$service->name}}</h2>
                                <label class="checkable-box service-checkbox">
                                    <input class="checkbox-input" type="checkbox" name="service"
                                           data-id="{{$service->id}}" {{$service->checked ? 'checked' : ''}}
                                        {{ !in_array($service->id, $activeServices) && !$service->checked ? 'disabled' : ''}}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>{{$service->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="col-md-10 empty-services">
                <div class="card">
                    <div class="card-body">
                        <h2>Services</h2>
                        <h6><a href="{{route('services.index')}}">Here</a> you can add service</h6>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @include('includes.modals')

@endsection
