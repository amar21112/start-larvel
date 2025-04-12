@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                <br>
            @elseif(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                </div>
                <br>
            @endif
            <div class="content">
                <form method="POST" action="{{route('store.service.doctor')}}">

                    @csrf
                    {{--                    <input name="_token" value="{{csrf_token()}}">--}}

                    <div class = "form-group">
                        <label for ="">choose doctor</label>
                        <select class="form-control" name="doctor_id">
                            @if(isset($doctors) && $doctors->count() > 0)
                                @foreach($doctors as $doctor)

                                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class = "form-group">
                        <label for ="">choose service</label>
                        <select class="form-control" name="service_ids[]" multiple >
                            @if(isset($services) && $services->count() > 0)
                                @foreach($services as $service)

                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div>
                        <button type = "submit" class="btn btn-primary">{{__("creations.save")}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
