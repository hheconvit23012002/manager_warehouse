<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoá đơn</title>
    <style>
        h4 {
            margin: 0;
        }
        .w-full {
            width: 100%;
        }
        .w-half {
            width: 50%;
            display: table-cell;
            vertical-align: bottom;
        }
        .w-70{
            width: 70%;
            display: table-cell;
            vertical-align: bottom;
        }
        table {
            width: 100%;
            border-spacing: 0;
        }
        table.products {
            font-size: 0.875rem;
        }
        table.products tr {
            background-color: rgb(96 165 250);
        }
        table.products th {
            color: #ffffff;
            padding: 0.5rem;
        }
        table tr.items {
            background-color: rgb(241 245 249);
        }
        table tr.items td {
            padding: 0.5rem;
        }
        .info-company{
            font-size: 20px;
            margin: 0;
        }
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .product-table th {
            background-color: #f2f2f2;
        }

        .product-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .product-table tbody tr:hover {
            background-color: #ddd;
        }
        .m-0{
            margin: 0;
        }
    </style>
</head>

<body>
    <h1 style="align-items: center; text-align: center; font-size: 30px">Invoice</h1>
    <table class="w-full" >
        <tr>
            <td class="w-70" >
                <div >
                    <div style="margin-bottom: 6px; ">
                        <p class="info-company" style="color: red">{{ $order->seller->name }}</p>
                        <p class="info-company" style="color: #6f42c1">Address : {{ $order->seller->address }}</p>
                    </div>
                    <div>
                        <p class="info-company">{{ $order->requester->name }}</p>
                        <p class="info-company">Address : {{ $order->requester->address }}</p>
                    </div>
                </div>
            </td>
            <td class="" style="width: 30%">
                <img
                    style="
                      border-radius: 450%;
                      width: 200px;"
                    src="data:image/png;base64,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"
                    alt="Logo của bên bán">
            </td>
        </tr>
    </table>
    <table class="w-full" style="margin: 20px 0">
        <tr>
            <td class="w-half" >
                <div>
                    <h4>Lieferanschrift:</h4>
                    <p class="info-company" style="margin-bottom: 0;">{{ $order->shipping_address }}</p>
                </div>
            </td>
            <td>
                <h2>RECHNUNG</h2>
                <div style="padding-left: 12px;">
                    <span>Bitte stets angeben !</span>
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <p class="m-0"><i>Datum:</i></p>
                                <p class="m-0"><i>Kunden-Nr:</i></p>
                                <p class="m-0"><i>Rechnungsnr:</i></p>
                            </td>
                            <td>
                                <p class="m-0">{{ $now }}</p>
                                <p class="m-0">{{ $order->requester->code ?? "" }}</p>
                                <p class="m-0">{{ $order->code }}</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <span>leiferdatum entspricht Rechnungsdatum</span>
                </div>
            </td>
        </tr>
    </table>
    <div class="table-container">
        <table class="product-table">
            <thead>
            <tr>
                <th>Art.-Nr.</th>
                <th>Artikel</th>
                <th>Abgabem.</th>
                <th>Verrechnungsm</th>
                <th>Preis (€)</th>
                <th>Betrag (€)</th>
                <th>MwSt</th>
                <th>Sum Last</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
                <tr>
                    <td>{{ $product->code ?? ""}}</td>
                    <td>{{ $product->name ?? ""}}</td>
                    <td>{{ $product->pivot->number ?? ""}}</td>
                    <td>{{ $product->measurement_unit ?? ""}}</td>
                    <td>{{ $product->pivot->price ?? ""}}</td>
                    <td>{{ ($product->pivot->price * $product->pivot->number) ?? 0}}</td>
                    <td>{{ (($product->pivot->price * $product->pivot->number)* $product->pivot->tax / 100) . ' (' . $product->pivot->tax .'%)'}}</td>
                    <td>{{ (($product->pivot->price * $product->pivot->number)* (1 - $product->pivot->tax / 100)) ?? 0}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">Zahlungsbetrag</td>
                <td>{{ $order->products->sum(function($product) {
                        return $product->pivot->price * $product->pivot->number;
                    }) }}  </td>
                <td>{{ $order->products->sum(function($product) {
                        return ($product->pivot->price * $product->pivot->number)* $product->pivot->tax / 100;
                    }) }} </td>
                <td>
                    {{ $order->products->sum(function($product) {
                        return ($product->pivot->price * $product->pivot->number)* (1 - $product->pivot->tax / 100);
                    }) }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
