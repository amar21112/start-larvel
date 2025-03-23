@extends('layouts.app')

@section('content')
    <div class="alert alert-success" id="msg_success_delete" role="alert" style="display: none;">
        Offer deleted successfully
    </div>

    <div class="alert alert-danger" id="msg_fail_delete" role="alert" style="display: none;">
        fail offer deleting
    </div>

    <div class="alert alert-danger" id="msg_fail_edit" role="alert" style="display: none;">
        fail offer editing
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }} </a>
                    </li>
            @endforeach

        </div>
    </nav>

    <table class="table">
        <thead>
        <tr>

            {{--                <th scope="col">#</th>--}}
            <th scope="col">{{__("creations.offer_name")}}</th>
            <th scope="col">{{__("creations.offer_price")}}</th>
            <th scope="col">{{__("creations.offer_details")}}</th>
            <th scope="col">{{__("creations.offer_photo")}}</th>
            <th scope="col">{{__("creations.operation")}}</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($offers as $offer)

            <tr class="offer_data_{{$offer->id}}">
                {{--                        <td>{{$offer->id}}</td>--}}
                <td>{{$offer->name}}</td>
                <td>{{$offer->offer_price}}</td>
                <td>{{$offer->detail}}</td>
                <td><img style="width: 50px; height: auto;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <td>
                    <a href="{{route('ajaxOfferEdit' , $offer->id)}}" class="update_button btn btn-success">update</a>
                    <a offer_id="{{$offer->id}}"  class="delete_button btn btn-danger">delete</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection

@section('scripts')
<script>
    $(document).on('click' , '.delete_button' ,function (e){
     e.preventDefault();
    var id = $(this).attr('offer_id');
     $.ajax({
             type: 'post',
             url: '{{Route('ajaxOfferDelete')}}',
             data:{
                    '_token':'{{csrf_token()}}',
                    id
             },
            success:function (data){
                if(data.status === true){
                    $('#msg_success').show();
                    $('.offer_data_'+data.id).remove();
                }
                if(data.status === false){
                    $('#msg_fail').show();
                }
            },
             error:function (reject){

             }

         }
     )
    })

</script>
@endsection
