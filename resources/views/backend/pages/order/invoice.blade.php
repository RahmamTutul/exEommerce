<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    body {
        background: grey;
        margin-top: 120px;
        margin-bottom: 120px;
    }
</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">

                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice #{{$orders['id']}}</p>
                            <p class="text-muted"> {{date('F j, y | g:i, a',strtotime($orders['created_at']))}}</p>
                            <span>
                            <?php
                                echo DNS1D::getBarcodeHTML('4445645656', 'C93');
                            ?>
                            </span>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1">{{$userDetails['name']}}</p>
                            <p>+88 {{$userDetails['mobile']}}</p>
                            <p class="mb-1">{{$userDetails['address']}}</p><br>
                            <p>
                                @php
                                     echo DNS1D::getBarcodeHTML($userDetails['address'], 'C39');
                                @endphp
                            </p>
                            <p class="mb-1">{{$userDetails['pinCode']}}</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">VAT: </span> 12% (Include Total)</p>
                            <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> {{$orders['payment_method']}}</p>
                            <p class="mb-1"><span class="text-muted">Name: </span> {{$userDetails['name']}}</p>
                            @php
                                echo DNS1D::getBarcodeHTML($userDetails['name'], 'C39');
                            @endphp
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Name</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">size</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders['orders_products'] as $order)
                                        <tr>
                                            <td>{{ $order['id']}}</td>
                                            <td>{{ $order['product_name']}}</td>
                                            <td>{{ $order['product_size']}}</td>
                                            <td>{{ $order['product_qty']}}</td>
                                            <td>{{ $order['product_price']}}</td>
                                            <td>{{ $orders['grand_total']}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light"> {{$orders['grand_total'] + 50}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Delivery Charge</div>
                            <div class="h2 font-weight-light">50 /-</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h2 font-weight-light"> {{$orders['grand_total']}} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">EX-COMMERCE.COM</a></div>

</div>


