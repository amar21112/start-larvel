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
                <div class="title m-b-md">
                   Services
                </div>

                <table class="table table-striped table-dark">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($services) && $services->count() > 0)
                        @foreach($services as $service)

                            <tr>
                                <th >{{$service->id}}</th>
                                <td>{{$service->name}}</td>
                            </tr>

                        @endforeach
                    @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
