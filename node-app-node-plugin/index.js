// Importing required packages and modules
const express = require("express");
const cors = require("cors");
const randomString = require("./utilities");
const {
  merchant_order,
  payment_request,
  payment_details,
} = require("./controller");
const { MerchantOrder, Transactions } = require("./models");

// Initializing the express application
const app = express();

// Configuring the application
require("dotenv").config();
const port = process.env.PORT || 5000;

// Adding middleware for CORS and JSON body parsing
app.use(cors());
app.use(express.json());

// initialized shurjopay instance
const shurjopay = require("shurjopay")();

// Setting up shurjopay credentials from the environment variables
with (process.env) {
  shurjopay.config(
    SP_ENDPOINT,
    SP_USERNAME,
    SP_PASSWORD,
    SP_PREFIX,
    SP_RETURN_URL
  );
}

// This endpoint confirms an order by creating a new merchant order in the database with a unique order ID.
app.post("/confirm-order", (req, res) => {
  const order_id = `aps-${randomString(10)}`;
  try {
    const orderDetails = req.body;
    if (!orderDetails.amount) {
      res.status(400).send({ status: false, error: "Order price not Found" });
    } else {
      const payload = {
        ...orderDetails,
        order_id,
      };
      merchant_order(payload);
      res.status(200).send({
        status: true,
        message: "Confirm order Successfully",
        data: [payload],
      });
    }
  } catch (error) {
    console.error(error);
    res.status(400).send({ status: false, error: error.message });
  }
});

// This endpoint taking payment for a specific order ID using ShurjoPay plugin.
app.post("/take-payment/:id", async (req, res) => {
  try {
    const my_order_id = req.params.id;
    const orderDetails = await MerchantOrder.findOne({
      where: { my_order_id: my_order_id },
    });
    if (!orderDetails) {
      throw new Error(`Order not found for id ${my_order_id}`);
    }
    const payload = {
      ...JSON.parse(orderDetails.tx_init_req),
      client_ip: req.ip,
    };
    shurjopay.makePayment(
      payload,
      (response_data) => {
        payment_request(response_data);
        res.status(200).send(response_data);
      },
      (error) => {
        shurjopay.log(`${error.message} credential`, "error");
        res.status(400).send({ status: false, error: error.message });
      }
    );
  } catch (err) {
    shurjopay.log(err.message, "error");
    res.status(400).send({ status: false, error: err.message });
  }
});

// This endpoint verifies the payment with the given transaction ID
app.post("/verify-payment/:id", (req, res) => {
  const sp_trxn_id = req.params.id;
  try {
    shurjopay.verifyPayment(
      sp_trxn_id,
      (response_data) => {
        payment_details(sp_trxn_id, response_data);
        res.status(200).send(response_data);
      },
      (error) => {
        shurjopay.log(error.message, "error");
        res.status(400).send({ status: false, error: error.message });
      }
    );
  } catch (err) {
    shurjopay.log(err.message, "error");
    res.status(400).send({ status: false, error: err.message });
  }
});

// This endpoint stands for Instant Payment Notification(IPN) with the given transaction ID
app.post("/payment-status-update", (req, res) => {
  //you can send sp_order_id by query or body or params
  const sp_trxn_id = req.query.sp_order_id;
  try {
    shurjopay.verifyPayment(
      sp_trxn_id,
      async (response_data) => {
        const orderDetails = await Transactions.findOne({
          where: { sp_trxn_id: sp_trxn_id },
        });
        if (!orderDetails) {
          throw new Error(`Order not found for id ${sp_trxn_id}`);
        }
        if (orderDetails.tx_status !== response_data.transaction_status) {
          payment_details(sp_trxn_id, response_data);
        }

        res.status(200).send(response_data);
      },
      (error) => {
        shurjopay.log(error.message, "error");
        res.status(400).send({ status: false, error: error.message });
      }
    );
  } catch (err) {
    shurjopay.log(err.message, "error");
    res.status(400).send({ status: false, error: err.message });
  }
});

//This endpoint retrieves the payment details for a specific email address from the database.
app.get("/my-payment", (req, res) => {
  const email = req.query.email;
  try {
    Transactions.findOne({
      where: { email: email },
      attributes: { exclude: ['tx_init_res', 'tx_vrfy_res'] },
    }).then((result) => {
      res.status(200).send(result);
    });
  } catch (err) {
    res.status(400).send({ status: false, error: err.message });
  }
});

app.get("/", (req, res) => {
  res.send("server is running");
});

app.listen(port, () => {
  console.log("Server running at port", port);
});
