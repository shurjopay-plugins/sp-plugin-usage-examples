import React, { useState } from "react";
import { authentication, makePayment } from "./Shurjopay.js";
const Execute = () => {
  const [inputs, setInputs] = useState({});
  const [ip, setIp] = useState(" ");

  const order_id = "sp315689";

  //getting ip from user machine
  fetch("https://checkip.amazonaws.com/")
    .then((res) => res.text())
    .then((ip) => setIp(ip));

  //getting data from userForm
  const handleChange = (event) => {
    const name = event.target.name;
    const value = event.target.value;
    setInputs((values) => ({ ...values, [name]: value }));
  };

  //payment function
  const payNow = () => {
    //handle promise to get authentication data
    authentication().then(function (token_details) {
      const { token, token_type, store_id } = token_details;
       
       //provide token_type, token, store_id, order_id, form data, ip as parameter
       //handle promise to get checkout Url
      makePayment(token_type, token, store_id, order_id, inputs, ip).then(
        async function (makePayment_details) {
          const { checkout_url } = makePayment_details;
          if (checkout_url) {
            window.location.href = checkout_url;
          } else {
            alert("Please Input Valid Information");
          }
        }
      );
    });
  };
  return (
    <div>
      <form onChange={handleChange} id="form">
        <div align="center" className="divlogo">
          <img
            className="logo"
            src="https://d298h3gigxsryg.cloudfront.net/exhibitors/dUJ4EZNavnCYAn942NzQRVaQWbWk6gloHQtSr10a.png"
            alt=""
          />
        </div>
        <div className="container-form-userName container-form-input">
          <label htmlFor="amount">
            {" "}
            Amount<span className="text-danger">*</span>
          </label>
          <input type="number" placeholder="Amount" name="amount" required />
        </div>
        <div className="container-form-userName container-form-input">
          <label htmlFor="customer_name">
            Customer Name<span className="text-danger">*</span>
          </label>
          <input
            type="text"
            placeholder="Customer Name"
            name="customer_name"
            required
          />
        </div>
        <div className="container-form-userName container-form-input">
          <label htmlFor="customer_phone">
            Customer Phone No<span className="text-danger">*</span>
          </label>
          <input
            type="tel"
            placeholder="Mobile Number"
            name="customer_phone"
            required
          />
        </div>
        <div className="container-form-userName container-form-input">
          <label htmlFor="customer_city">
            Customer City<span className="text-danger">*</span>
          </label>
          <input type="text" placeholder="City" name="customer_city" required />
        </div>
        <div className="container-form-userName container-form-input">
          <label htmlFor="customer_address">
            Customer Address<span className="text-danger">*</span>
          </label>
          <input
            type="text"
            placeholder="Address"
            name="customer_address"
            required
          />
        </div>
        <div className="container-form-userName container-form-input">
          <label htmlFor="customer_post_code">
            Postal Code<span className="text-danger">*</span>
          </label>
          <input
            type="number"
            placeholder="Zip"
            name="customer_post_code"
            required
          />
        </div>
        <div className="container-form-userPassword container-form-input">
          <label htmlFor="customer_email">
            Customer Email<span className="text-danger">*</span>
          </label>
          <input
            type="text"
            placeholder="Email"
            name="customer_email"
            required
          />
        </div>
        <div className="container-form-userPassword container-form-input">
          <label htmlFor="currency">
            Currency<span className="text-danger">*</span>
          </label>
          <select name="currency" required>
            <option value>Please Select One</option>
            <option value="BDT">BDT</option>
            <option value="USD">USD</option>
          </select>
        </div>
      </form>
      <div align="center">
        {/* className="grid-container" */}
        <button
          className="spButton  js-form-btn"
          onClick={() => payNow()}
          id="payButton"
        >
          Pay Now
        </button>
        {/* <button
        className="spButton  js-form-btn dbutton"
      >
       Default
      </button> */}
      </div>
    </div>
  );
};

export default Execute;
