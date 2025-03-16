<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
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
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    {{__("creations.edit_your_offer")}}
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                    <br>
                @endif

                <form method="POST" action="{{Route('offers.update' , $offer->id)}}">

                    @csrf
{{--                    <input name="_token" value="{{csrf_token()}}">--}}

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
                        <button type = "submit" class="btn btn-primary">{{__("creations.save")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
