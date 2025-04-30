<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LUXORA</title>
    <style>
        *{
            font-family:Arial;
        }
        .container{
            margin: auto;
        }
        .text-dark-blue{
            color: #5C3422;
            margin: auto 20px
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }
        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
        }
        .small-heading {
            font-size: 16px;
        }
        .total-heading {
            font-size: 16px;
            font-weight: 700;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }
        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #5C3422;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <table class="order-details">
        <thead>
        <tr>
            <th width="50%" colspan="2">
                <h2 class="text-start text-dark-blue">LUXORA</h2>
            </th>
            <th width="50%" colspan="2" class="text-end company-data">
                <span>Invoice Id: #ORD{{$order->id}}</span> <br>
                <span>Date: {{date('d / m / Y')}}</span> <br>
                {{-- demo address of yourShop --}}
                <span>Pin code : 360001</span> <br>
                <span>Address: "LUXORA Jewellers",125, Subhash Nagar,<br> Near Jubilee Garden, Rajkot, Gujarat</span> <br>
            </th>
        </tr>
        <tr class="bg-blue">
            <th width="50%" colspan="2">Order Details</th>
            <th width="50%" colspan="2">User Details</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Order Id:</td>
            <td>#ORD{{$order->id}}</td>

            <td>Full Name:</td>
            <td>{{\Illuminate\Support\Facades\Auth::user()->name}}</td>
        </tr>
        <tr>
            <td>Ordered Date:</td>
            <td>{{$order->created_at}}</td>

            <td>Email Id:</td>
            <td>{{\Illuminate\Support\Facades\Auth::user()->email}}</td>
        </tr>
        <tr>
            <td>Delivered On:</td>
            <td style="text-transform: capitalize">{{$order->updated_at->format('d / m / y')}}</td>

            <td>Phone:</td>
            <td>{{$order->userAddress->phone}}</td>
        </tr>
        <tr>
            <td>Payment Mode:</td>
            <td>{{$order->payment_mode}}</td>

            <td>Address:</td>
            <td> {{!! $order->userAddress->address !!}} </td>
        </tr>
        <tr>
            <td>Payment Status:</td>
            <td>Done</td>

            <td>Pin code:</td>
            <td>{{$order->userAddress->pin}}</td>
        </tr>
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th class="no-border text-start heading text-dark-blue" colspan="5">
                Order Items
            </th>
        </tr>
        <tr class="bg-blue">
            <th>Sn.</th>
            <th>Product</th>
            <th>Price</th>
            <th>Delivery Charge</th>
            <th>Express Delivery Charge</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @php
            $totalAmount = 0;
            $sn=1;
        @endphp
        @foreach($order->orderDetails as $orderItem)
        <tr>
            <td width="10%">{{$sn++}}</td>
            <td> {{$orderItem->product->name}} </td>
            <td width="10%">
                Rs. {{$orderItem->price}}
            </td>
            <td>
                Rs. {{$orderItem->delivary_charges ?? 0}}
            </td>
            <td>
{{--                @if($orderItem->is_express_delivary)--}}
                    Rs. {{$orderItem->product->express_delivary_charge ?? 0}}
{{--                @endif--}}
            </td>
            <td width="10%">{{$orderItem->quantity}}</td>
            <td width="15%" class="fw-bold"> &#8377
                Rs. {{$orderItem->delivary_charges + $orderItem->quantity * $orderItem->price}}
                @php
                    $totalAmount += ($orderItem->quantity * $orderItem->price) + $orderItem->delivary_charges;
                @endphp
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" class="total-heading">Total Amount - <small>Inc. all tax</small></td>
            <td colspan="1" class="total-heading">Rs. {{$totalAmount}}</td>
        </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with LUXORA
    </p>
</div>
</body>
</html>
