<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <table style="width: 700px;">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><img src="{{asset('assets/frontend/images/logo.png')}}" alt=""></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Hello {{$name}}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Your Order #{{$order_id}} is one step ahead from delivered! Be patient!</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Order NO: {{$order_id}}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>Name </td>
                            <td>Code </td>
                            <td>Color</td>
                            <td>Size</td>
                            <td>Quantity</td>
                            <td>Price</td>
                        </tr>
                        @foreach ($orderDetails['orders_products'] as $product)
                        <tr>
                            <td>{{$product['product_name']}}</td>
                            <td>{{$product['product_code']}}</td>
                            <td>{{$product['product_color']}}</td>
                            <td>{{$product['product_size']}}</td>
                            <td>{{$product['product_qty']}}</td>
                            <td>{{$product['product_price']}}</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
            </tr>
        </table>
</body>
</html>
