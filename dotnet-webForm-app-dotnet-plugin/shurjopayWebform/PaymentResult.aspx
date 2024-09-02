<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="PaymentResult.aspx.cs" Inherits="shurjopayWebform.PaymentResult" Async="true" %>
    <!-- 
    Author: Wali Mosnad Ayshik
    Description: This page handles the payment form for ShurjoPay integration.
    Date: September 2024
    -->
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }
        i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
        ._failed .checkmark {
            color: #F00;
        }
        ._failed h1 {
            color: #F00;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 4px;
            background-color: #88B04B;
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 700;
        }
        .button:hover {
            background-color: #76a34a;
        }
    </style>
</head>
<body>
    <asp:PlaceHolder ID="PlaceHolderMessage" runat="server"></asp:PlaceHolder>
</body>
</html>
