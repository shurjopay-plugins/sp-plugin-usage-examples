<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="PaymentForm.aspx.cs" Inherits="shurjopayWebform.PaymentForm" Async="true" %>
 <!-- 
 Author: Wali Mosnad Ayshik
 Description: This page handles the payment form for ShurjoPay integration.
 Date: September 2024
 -->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>ShurjoPay Payment Form for .NET Web Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <form id="form1" runat="server" class="container mt-5">
        <h2 class="text-center mb-4">ShurjoPay Payment Form</h2>
        <div class="form-group">
            <label for="txtAmount">Amount:</label>
            <asp:TextBox ID="txtAmount" runat="server" CssClass="form-control" ReadOnly="true" Text="100.00"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtOrderId">Order ID:</label>
            <asp:TextBox ID="txtOrderId" runat="server" CssClass="form-control" ReadOnly="true" Text="11223344"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtDiscountAmount">Discount Amount:</label>
            <asp:TextBox ID="txtDiscountAmount" runat="server" CssClass="form-control" ReadOnly="true" Text="0"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtClientIp">Client IP:</label>
            <asp:TextBox ID="txtClientIp" runat="server" CssClass="form-control" ReadOnly="true" Text="116.212.111.186"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCustomerName">Customer Name:</label>
            <asp:TextBox ID="txtCustomerName" runat="server" CssClass="form-control" Text="Wali Mosnad Ayshik"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCustomerPhone">Customer Phone:</label>
            <asp:TextBox ID="txtCustomerPhone" runat="server" CssClass="form-control" Text="01775503498"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCustomerEmail">Customer Email:</label>
            <asp:TextBox ID="txtCustomerEmail" runat="server" CssClass="form-control" Text="Ayshikmee@gmail.com"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCustomerAddress">Customer Address:</label>
            <asp:TextBox ID="txtCustomerAddress" runat="server" CssClass="form-control" Text="Dhaka,Bangladesh"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCustomerCity">Customer City:</label>
            <asp:TextBox ID="txtCustomerCity" runat="server" CssClass="form-control" Text="Dhaka"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCustomerState">Customer State:</label>
            <asp:TextBox ID="txtCustomerState" runat="server" CssClass="form-control" Text="Kuril"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCustomerPostcode">Customer Postcode:</label>
            <asp:TextBox ID="txtCustomerPostcode" runat="server" CssClass="form-control" Text="2100"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCurrency">Currency:</label>
            <asp:TextBox ID="txtCurrency" runat="server" CssClass="form-control" ReadOnly="true" Text="BDT"></asp:TextBox>
        </div>
        <div class="form-group">
            <label for="txtCustomerCountry">Customer Country:</label>
            <asp:TextBox ID="txtCustomerCountry" runat="server" CssClass="form-control" Text="Bangladesh"></asp:TextBox>
        </div>
        <asp:Button ID="btnPayNow" runat="server" Text="Pay Now" CssClass="btn btn-primary btn-block" OnClick="btnPayNow_Click" />
        <br />
        <asp:Label ID="lblMessage" runat="server" Text="" ForeColor="Red" CssClass="d-block text-center mt-3"></asp:Label>
    </form>
</body>
</html>
