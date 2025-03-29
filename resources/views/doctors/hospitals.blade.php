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
               Hospitals
            </div>

            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Doctors</th>
                </tr>
                </thead>
                <tbody>
            @if(isset($hospitals) && $hospitals->count() >0)
                @foreach($hospitals as $hospital)

                    <tr>
                        <th >{{$cnt++}}</th>
                        <td>{{$hospital->name}}</td>
                        <td>{!! $hospital->address !!}</td>
                        <td>
                            <a href="{{route('doctorsOfHospital' , $hospital->id)}}" class="btn btn-success">Doctors</a>
                            <a href="{{route('delete.hospital' , $hospital->id)}}" class="btn btn-danger">delete</a>
                        </td>

                    </tr>

                @endforeach
            @else
                <tr>No hospitals foud</tr>
            @endif
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
