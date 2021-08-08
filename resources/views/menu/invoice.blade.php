<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="5;url=http://127.0.0.1:8000/menu/report">
    <title>Invoice</title>
    <style>
        .container {
            width: 300px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }
        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 300px;
            display: flex;
        }
        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header" style="margin-bottom: 30px;">
            <h2>Toko Sejahtera</h2>
            <small>Laladon Bogor</small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No Order</li>
                    <li>Cashier</li>
                    <li>Date</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> {{ $order->code }} </li>
                    <li> {{ $order->cashier_name }} </li>
                    <li> {{ \Carbon\Carbon::parse($order->created_at)->IsoFormat('D MMMM YYYY') }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Product Name</div>
            <div>Price/Qty</div>
            <div>Subtotal</div>
        </div>
        @foreach ($order->productOrder as $productOrder)
            <div class="flex-container" style="text-align: right;">
                <div style="text-align: left;">{{ $productOrder->qty }}x <span style="font-size: 14px;">{{ $productOrder->product->name }}</span></div>
                <div>Rp. {{ number_format($productOrder->product->price) }} </div>
                <div>Rp. {{ number_format($productOrder->total) }} </div>
            </div>
        @endforeach
        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div></div>
            <div>
                <ul>
                    <li>Total</li>
                    <li>Pay</li>
                    <li>Change</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>Rp. {{ number_format($order->total) }} </li>
                    <li>Rp. {{ number_format($order->pay) }} </li>
                    <li>Rp. {{ number_format($order->change) }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 50px;">
            <h3>Thank You</h3>
            <p>Please visit us again</p>
        </div>
    </div>
</body>
</html>
