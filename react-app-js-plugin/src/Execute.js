import React, { useState } from "react";
import { makePayment } from "shurjopay-js";


const Execute = () => {
  const [inputs, setInputs] = useState({});
  const [loading, setLoading] = useState(false)

  const order_id = "sp315689";



  //getting data from userForm
  const handleChange = (event) => {
    const name = event.target.name;
    const value = event.target.value;
    setInputs((values) => ({ ...values, [name]: value }));
  };

  //payment function
  async function payNow(){
    setLoading(true);
 
        const makePayment_details= await makePayment(order_id, inputs);
 
          const { checkout_url } = makePayment_details;
          if (checkout_url) {
           
            window.location.href = checkout_url;
          } else {
            setLoading(false);
            alert("Something Wrong on Your Payment");
           
          }
        }
  return (
    <div>
    
    <div>
      <form onChange={handleChange} id="form">
        <div align="center" className="divlogo">
          <img
            className="logo"
            src="https://shurjopay.com.bd/dev/images/shurjoPay.png"
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
        >{loading ? (
          <div className="loader-container">
            <div className="loader"></div>
          </div>
        ) : ""}
          Pay Now
        </button>
        {/* <button
        className="spButton  js-form-btn dbutton"
      >
       Default
      </button> */}
      </div>
    </div>
   
    </div>
  );
};

export default Execute;
