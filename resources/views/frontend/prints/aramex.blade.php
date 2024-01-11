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

        .barcode {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;

        }

        .from {
            line-height: 1.5;
        }

        .rotated-barcode {
            transform: rotate(90deg) translate(50%);
            display: flex;
            align-items: center;
            justify-content: center;

        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row header border border-black">
            <div class="col-6 mt-3">
                <img src="{{ asset('images/aramex.png') }}" alt="Aramex Logo">
                <p class="fs-5">
                    Origin - Page 1 of 1 <br>
                    JED
                </p>
            </div>

            <div class="col-6 d-flex flex-column">
                <div class="barcode p-5">
                    {!! '<img src="data:image/png;base64,' .
                        DNS1D::getBarcodePNG($order->order_code, config('app.barcode_type'), 3, 70) .
                        '" alt="barcode"   />' !!}
                </div>
                <div class="text-center fs-4">
                    {{ $order->order_code }}
                </div>
            </div>
        </div>


        <div class="row border border-black p-3">
            <div class="col-lg-4 fs-5">
                Destination :<span class="m-2"> {{ $order->destination }}</span>
            </div>
            <div class="col-8 fs-5">Pickup Date :{{ $order->pickup_date }}</div>
        </div>

        <div class="row border border-black p-3">
            <table id="details">
                <tr>
                    <td>Product Group: DOM ONP</td>
                    <td>Payment: P</td>
                    <td>Weight: {{ $order->weight }}</td>
                </tr>
            </table>
        </div>

        <div class="row border border-black ">
            <div class="col">
                <p>Weight: {{ $order->weight }} </p>
                <p>Description:{{ $order->description }}</p>
                <p>Cash on delivery: {{ $order->cash_on_delivery }}</p>
            </div>
            <div class="col">
                <p>Chargeable: {{ $order->chargeable }}</p>
                <p>Custom Value: {{ $order->custom_value }}</p>
                <p>Pieces: {{ $order->pieces }}</p>
            </div>
        </div>

        <div class="row border border-black">
            <div class="col-lg-8 ">
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

                <div class="row border border-black">
                    <div class="col-6"> <strong>Shpr Ref :</strong>{{ $order->client->client_number }} <br></div>
                    
                </div>
            </div>
            <div class="col-lg-4 container-barcode-rotated">
                <div class="barcode-container rotated-barcode">
                    {!! '<img style="height: 100%; width: 100%;" src="data:image/png;base64,' .
                        DNS1D::getBarcodePNG($order->order_code, config('app.barcode_type'), 3, 70) .
                        '" alt="barcode" />' !!}
                </div>

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
