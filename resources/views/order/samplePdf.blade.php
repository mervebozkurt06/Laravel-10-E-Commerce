<!DOCTYPE html>
<html>

<head>
    <title>laravel-pdf</title>
    <style>
        table tr th {
            background-color: #04AA6D;
            color: white;
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>

<body>
<h3>Order Items PDF </h3>
<table>
    <thead>

    <tr>
        <th class="center">#</th>
        <th>Product</th>
        <th>Description</th>
        <th class="right">Unit Cost</th>
        <th class="center">Qty</th>
        <th class="right">Total</th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $key=>$value)
        <tr>
            <td class="center">{{$value['id']}}</td>
            <td class="center">{{$value['name']}}</td>
            <td class="center">{{$value['description']}}</td>
            <td class="center">{{$value['price']}}</td>
            <td class="center">{{$value['quantity']}}</td>
            <td class="center">{{$value['total']}}</td>
        </tr>
    @endforeach


    </tbody>
</table>
</body>

</html>
