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
                    Doctors
                </div>

                <table class="table table-striped table-dark">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>title</th>
                        <th>gender</th>
                        <th>hospital</th>
                        <th>control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($doctors) && $doctors->count() > 0)
                        @foreach($doctors as $doctor)

                            <tr>
                                <th >{{$cnt++}}</th>
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->title}}</td>
                                <td>{{$doctor->gender}}</td>
                                <td>{{$doctor->hospital->name}}</td>
                                <td>
                                    <a href="{{route('delete.doctor' , $doctor->id)}}" class="btn btn-danger">delete</a>
                                </td>
                            </tr>

                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
