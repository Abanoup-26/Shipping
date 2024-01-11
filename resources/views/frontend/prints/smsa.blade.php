<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container {
            width: 600px;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        .from {
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row header border border-black">
            <div class="col-6 mt-3">
                <img src="{{ asset('images/Smsa.png') }}" alt="Smsa Express Logo">
            </div>
        </div>

        <div class="row border border-black ">
            <div class="col-lg-6 fs-5">
                Shipper :<span class="m-2"> {{ $order->destination }}</span>
            </div>
            <div class="col-6 fs-5 text-end">+966562631045</div>
        </div>

        <div class="row border border-black ">
            <div class="from ">
                From : {!! $order->from !!}
            </div>
        </div>

        <div class="row border border-black">
            <div>
                To :{!! $order->to !!}
            </div>
        </div>

        <div class="row border border-black ">
            <div class="text-center p-2">
                <div class="fs-4">Trk {{ $order->order_code }} </div>
                {!! '<img src="data:image/png;base64,' .
                    DNS1D::getBarcodePNG($order->order_code, config('app.barcode_type'), 3, 70) .
                    '" alt="barcode"   />' !!}
            </div>
        </div>

        <div class="row border border-black ">

            <div class="col-6">
                <p><strong>REF:</strong> {{ $order->client->client_number }}</p>
                <p>Weight: {{ $order->weight }} </p>
                <p>Chargeable: {{ $order->chargeable }}</p>
                <p>Custom Value: {{ $order->custom_value }}</p>
                <p>Description:{{ $order->description }}</p>
            </div>
            <div class="col text-center">
                <p>Pieces: {{ $order->pieces }}</p>
            </div>
            <div class="col text-end">
                {{ $order->pickup_date }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
