import React, { useState } from "react";
import { Link } from "react-router-dom";
import { authentication, verifyPayment } from "./Shurjopay.js";

const Return = () => {
  const [details, setDetails] = useState({});
  async function status() {
    //getting order id from url
    const url_string = window.location.href.toLowerCase();
    const url = new URL(url_string);
    const order_id = url.searchParams.get("order_id");
    //getting token for verifyPayment
    authentication().then(function (token_details) {
      const { token, token_type } = token_details;
      //payment verification and handle promise data 
      //parameter token_type, token, order_id to call verifyPayment function
      verifyPayment(token_type, token, order_id).then(async function (
        verify_status
      ) {
        for (const values of verify_status) {
          setDetails(values);
        }
      });
    });
  }
  window.onload = () => status();
  return (
    <div>
      <h1 align="center">Payment Slip</h1>
      <table id="customers">
        <tbody>
          <tr>
            <td>Name</td>
            <td>{details.name}</td>
          </tr>
          <tr>
            <td>Address</td>
            <td>{details.address}</td>
          </tr>
          <tr>
            <td>Order Id:</td>
            <td>{details.customer_order_id}</td>
          </tr>
          <tr>
            <td>Currency</td>
            <td>{details.currency}</td>
          </tr>
          <tr>
            <td>Discount Percentage:</td>
            <td>{details.disc_percent}</td>
          </tr>
          <tr>
            <td>Amount:</td>
            <td>{details.amount}</td>
          </tr>
          <tr>
            <td>Status:</td>
            <td>{details.sp_message}</td>
          </tr>
          <tr>
            <td>Payment Method</td>
            <td>{details.method}</td>
          </tr>
          <tr>
            <td>Transaction ID:</td>
            <td>{details.bank_trx_id}</td>
          </tr>
          <tr>
            <td>Invoice No</td>
            <td>{details.invoice_no}</td>
          </tr>
          <tr>
            <td>Date &amp; Time:</td>
            <td>{details.date_time}</td>
          </tr>
        </tbody>
      </table>
      <br />{" "}
      <div align="center">
        <Link to="/payment"> Back to Home </Link>
      </div>
    </div>
  );
};

export default Return;
