<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

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
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Add Your Offer.
                </div>

                <form method="POST" action="{{Route('offers.store')}}">

                    @csrf
{{--                    <input name="_token" value="{{csrf_token()}}">--}}

                    <div class = "form-group">
                        <label for ="OfferName">Offer Name</label>
                        <input type="text" class="form-control" name ="offer_name" placeholder="Enter offer name">
                    </div>

                    <div class = "form-group">
                        <label for ="OfferPrice">Offer Price</label>
                        <input type="text" class="form-control" name ="offer_price" placeholder="Enter offer price">
                    </div>

                    <div class = "form-group">
                        <label for ="OfferDetails">Offer Details</label>
                        <input type="text" class="form-control" name ="offer_details" placeholder="Enter offer details">
                    </div>

                    <button type = "submit" class="btn btn-primary">Save Offer</button>
                </form>
            </div>
        </div>
    </body>
</html>
