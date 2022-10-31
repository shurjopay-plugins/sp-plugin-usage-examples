<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>ShurjopayV3 Integration (Laravel-personal-project)</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/3.3/examples/jumbotron-narrow/">

    <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/3.3/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/3.3/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
    <script src="https://getbootstrap.com/docs/3.3/assets/js/ie-emulation-modes-warning.js"></script>


</head>

<body>

    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                    <li role="presentation"><a href="#">About</a></li>
                    <li role="presentation"><a href="#">Contact</a></li>
                </ul>
            </nav>
            <h3 class="text-muted">ShurjopayV3 Integration (Laravel-Rayhan-khan Ridoy)</h3>
        </div>

        <div class="jumbotron">
            <img src="{{ asset('images/shurjopay-payment-gateway-integration.png') }}" width="100%"
                alt="shurjopay-image">
            <br>
            <br>

            <form method="POST" action="{{ url('/paymentGateway') }}">
                @csrf
                <div class="form-group text-center" style="margin-top: 10px;">
                    <table border="1" align="center">
                        <tr>
                            <th></th>
                            <th></th>

                        </tr>
                        <tr>
                            <td>
                                <span>currency </span>
                            </td>

                            <td>
                                :<input type="text" name="currency" value="{{old('currency')}}" placeholder="Enter currency">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>amount </span>
                            </td>
                            <td>
                                :<input type="text" name="amount" value="{{old('amount')}}" placeholder="Enter amount">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>order_id </span>
                            </td>
                            <td>
                                :<input type="text" name="order_id" value="{{old('order_id')}}" placeholder="Enter order_id">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>discsount_amount </span>
                            </td>
                            <td>
                                :<input type="text" name="discsount_amount" value="{{old('discsount_amount')}}" placeholder="Enter discsount_amount">
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <span>disc_percent </span>
                            </td>
                            <td>
                                :<input type="text" name="disc_percent" value="{{old('disc_percent')}}" placeholder="Enter disc_percent">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>client_ip </span>
                            </td>
                            <td>
                                :<input type="text" name="client_ip" value="{{old('client_ip')}}" placeholder="Enter client_ip">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>customer_name </span>
                            </td>
                            <td>
                                :<input type="text" name="customer_name" value="{{old('customer_name')}}" placeholder="Enter customer_name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>customer_phone </span>
                            </td>
                            <td>
                                :<input type="text" name="customer_phone" value="{{old('customer_phone')}}" placeholder="Enter customer_phone">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>customer_email </span>
                            </td>
                            <td>
                                :<input type="text" name="customer_email" value="{{old('customer_email')}}" placeholder="Enter customer_email">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span>customer_address </span>
                            </td>
                            <td>
                                :<input type="text" name="customer_address" value="{{old('customer_address')}}" placeholder="Enter customer_address">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>customer_city </span>
                            </td>
                            <td>
                                :<input type="text" name="customer_city" value="{{old('customer_city')}}" placeholder="Enter customer_city">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>customer_state </span>
                            </td>
                            <td>
                                :<input type="text" name="customer_state" value="{{old('customer_state')}}" placeholder="Enter customer_state">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>customer_postcode </span>
                            </td>
                            <td>
                                :<input type="text" name="customer_postcode" value="{{old('customer_postcode')}}" placeholder="Enter name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>customer_country </span>
                            </td>
                            <td>
                                :<input type="text" name="customer_country" value="{{old('customer_country')}}" placeholder="Enter customer_country">
                            </td>
                        </tr>

                    </table>
                    <input type="submit" class="btn btn-success" value="Pay Now">
                </div>
            </form>



        </div>



        <footer class="footer">
            <p>&copy; 6-10-2022 RAYHAN KHAN RIDOY</p>
        </footer>

    </div>

    <script src="https://getbootstrap.com/docs/3.3/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>
