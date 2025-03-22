@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="alert alert-success" id="msg_success" role="alert" style="display: none;">
            Offer created successfully
        </div>

        <div class="alert alert-danger" id="msg_fail" role="alert" style="display: none;">
            fail offer creating
        </div>

        <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                {{__("creations.add_your_offer")}}
            </div>
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
            <form method="POST" id="saveOfferForm" enctype="multipart/form-data">

                @csrf
                {{--                    <input name="_token" value="{{csrf_token()}}">--}}
                <div class = "form-group">
                    <label for ="OfferName">{{__("creations.photo")}}</label>
                    <input type="file" class="form-control" name ="photo" placeholder="choice photo">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class = "form-group">
                    <label for ="OfferName">{{__("creations.offer_name_ar")}}</label>
                    <input type="text" class="form-control" name ="name_ar" placeholder="Enter offer name">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class = "form-group">
                    <label for ="OfferName">{{__("creations.offer_name_en")}}</label>
                    <input type="text" class="form-control" name ="name_en" placeholder="Enter offer name">
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class = "form-group">
                    <label for ="OfferPrice">{{__("creations.offer_price")}}</label>
                    <input type="text" class="form-control" name ="offer_price" placeholder="Enter offer price">
                    @error('offer_price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class = "form-group">
                    <label for ="OfferDetails">{{__("creations.offer_details_ar")}}</label>
                    <input type="text" class="form-control" name ="detail_ar" placeholder="Enter offer details">
                    @error('detail_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class = "form-group">
                    <label for ="OfferDetails">{{__("creations.offer_details_en")}}</label>
                    <input type="text" class="form-control" name ="detail_en" placeholder="Enter offer details">
                    @error('detail_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div>
                    <button id="save_offer"  class="btn btn-primary">{{__("creations.save")}}</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click','#save_offer', function (e){
            e.preventDefault();

            var formData = new FormData($('#saveOfferForm')[0]);

            $.ajax({
                    type: 'POST',
                    enctype : 'multipart/form-data',
                    url: "{{route('ajaxOfferStore')}}",
                    data :formData,
                    processData: false,
                    contentType: false,
                    cache:false,
                    success:function (data){
                        if(data.status === true){
                            $('#msg_success').show();
                        }
                        if(data.status === false){
                            $('#msg_fail').show();
                        }
                    },
                    error:function (reject){

                    }

                }
            )
        });

    </script>
@endsection
