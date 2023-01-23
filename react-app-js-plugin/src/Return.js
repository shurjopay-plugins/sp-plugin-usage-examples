import React, { useState } from "react";
import { Link } from "react-router-dom";
import { verifyPayment } from "shurjopay-js";

const Return = () => {
  const [details, setDetails] = useState({});
  async function status() {
    //getting order id from url
    const url_string = window.location.href.toLowerCase();
    const url = new URL(url_string);
    const order_id = url.searchParams.get("order_id");
    
     
      //payment verification and handle promise data 
      //parameter order_id to call verifyPayment function
      const verify_status= await verifyPayment(order_id);
   
        for (const values of verify_status) {
          setDetails(values);
        }
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
