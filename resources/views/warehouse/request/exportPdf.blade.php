<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Generate PDF Example - ItSolutionStuff.com</title>
</head>
<body>

<table class="" width="100%" border="1px solid black">
    <tr>
        <th>#</th>
        <th>Code</th>
        <th>Name</th>
        <th>Measurement Unit</th>
        <th>Price</th>
        <th>Number</th>
        <th>Tax(%)</th>
        <th>Sum price before tax</th>
        <th>Sum price after tax</th>
    </tr>
    @foreach($order->products as $product)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->measurement_unit }}</td>
            <td>{{ $product->pivot->price }}</td>
            <td>{{ $product->pivot->number }}</td>
            <td>{{ $product->pivot->tax }}</td>
            <td>{{ $product->pivot->price * $product->pivot->number }}</td>
            <td>{{ ($product->pivot->price * $product->pivot->number * $product->pivot->tax) /100 }}</td>
        </tr>
    @endforeach
</table>
<h1 class="text-center">Info</h1>
<label class="mt-2">
    Address {{ $order->address }}
</label>
<label class="mt-2">
    Phone Number {{ $order->phone_number }}
</label>
</body>
</html>
