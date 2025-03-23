@extends('layouts.app')

@section('content')
    <div class="alert alert-success" id="msg_success" role="alert" style="display: none;">
        Offer updated successfully
    </div>

    <div class="alert alert-danger" id="msg_fail" role="alert" style="display: none;">
        fail offer updating
    </div>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    {{__("creations.edit_your_offer")}}
                </div>

                <form method="POST"  id="offer_form_update" enctype="multipart/form-data">

{{--                    <input name="_token" value="{{csrf_token()}}">--}}
                    <div class = "form-group">
                        <input type="text" class="form-control" name ="offer_id" value="{{$offer->id}}" style="display: none">
                    </div>

                    <div class = "form-group">
                        <label for ="OfferName">{{__("creations.offer_name_ar")}}</label>
                        <input type="text" class="form-control" name ="name_ar" value="{{$offer->name_ar}}" placeholder="Enter offer name">
                        @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class = "form-group">
                        <label for ="OfferName">{{__("creations.offer_name_en")}}</label>
                        <input type="text" class="form-control" name ="name_en" value="{{$offer->name_en}}" placeholder="Enter offer name">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class = "form-group">
                        <label for ="OfferPrice">{{__("creations.offer_price")}}</label>
                        <input type="text" class="form-control" name ="offer_price" value="{{$offer->offer_price}}" placeholder="Enter offer price">
                        @error('offer_price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class = "form-group">
                        <label for ="OfferDetails">{{__("creations.offer_details_ar")}}</label>
                        <input type="text" class="form-control" name ="detail_ar" value="{{$offer->detail_ar}}" placeholder="Enter offer details">
                        @error('detail_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class = "form-group">
                        <label for ="OfferDetails">{{__("creations.offer_details_en")}}</label>
                        <input type="text" class="form-control" name ="detail_en" value="{{$offer->detail_en}}"  placeholder="Enter offer details">
                        @error('detail_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div>
                        <button id="update_offer"  class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

@endsection
@section('scripts')
    <script>
        $(document).on('click','#update_offer', function (e){
            e.preventDefault();

            var formData = new FormData($('#offer_form_update')[0]);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                    type: 'POST',
                    enctype : 'multipart/form-data',
                    url: "{{route('ajaxOfferUpdate')}}",
                    data : formData ,
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
