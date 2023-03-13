const express = require("express");
const cors = require("cors");
const app = express();
require("dotenv").config();
const port = process.env.PORT || 5000;
app.use(cors());
app.use(express.json());

const sp_factory = require("shurjopay");
const shurjopay = sp_factory();

const sqlite3 = require("sqlite3").verbose();

// open the database
let db = new sqlite3.Database("./sp.db", sqlite3.OPEN_READWRITE, (err) => {
  if (err) {
    console.error(err.message);
  }

  console.log("Database Connected Successfully.");
});

//  The minimum config/environment variables that your site need to maintain(config related to shurjopay)
const spConfig = {
  client_id: process.env.SP_CLIENT_ID,
  client_secret: process.env.SP_CLIENT_SECRET,
  client_key_prefix: process.env.SP_CLIENT_KEY_PREFIX,
};

//When you use this application in live with live Credential, please uncomment shurjopay.islive()
// shurjopay.is_live();
shurjopay.configure_merchant(
  spConfig.client_id,
  spConfig.client_secret,
  spConfig.client_key_prefix
);

const merchant_order_table = (data) => {
  const create_MO_Table = `CREATE TABLE IF NOT EXISTS  merchant_order (
    order_id TEXT PRIMARY KEY, sp_order_id TEXT, status TEXT
  )`;
  db.run(create_MO_Table, (err) => {
    if (err) {
      console.error(err.message);
    } 
    const checkOrderIdQuery =
      "SELECT order_id FROM  merchant_order WHERE order_id = ?";
    const insertOrderQuery = `INSERT INTO  merchant_order ( order_id  , sp_order_id, status) VALUES (?, ?,?)`;
    try {
      const { customer_order_id } = data;
      db.get(checkOrderIdQuery, customer_order_id, (err, row) => {
        if (err) {
          console.log(err);
        } else if (row) {
          console.log(`Data with Order_id ${customer_order_id} already exists`);
        } else {
          const values = [data.customer_order_id, data.sp_order_id, null];
          db.run(insertOrderQuery, values, (err) => {
            if (err) {
              console.log(err);
            } else {
              console.log("Payment Initiate Successfully");
            }
          });
        }
      });
    } catch (error) {
      console.log(error);
    }
  });
};
const sp_payment_table = (response_data) => {
  const createTable = `CREATE TABLE IF NOT EXISTS sp_payments (
    id INTEGER PRIMARY KEY, order_id TEXT, currency TEXT, amount BLOB, payable_amount BLOB,discsount_amount BLOB, disc_percent BLOB, received_amount BLOB,usd_amt BLOB, usd_rate BLOB,card_holder_name TEXT,card_number TEXT,phone_no TEXT, bank_trx_id TEXT, invoice_no TEXT, bank_status TEXT,customer_order_id TEXT, sp_code TEXT,sp_message TEXT,name TEXT,email TEXT, address TEXT, city TEXT, value1 BLOB, value2 BLOB,value3 BLOB,value4 BLOB, transaction_status TEXT, method TEXT, date_time TEXT
  )`;
  db.run(createTable, (err) => {
    if (err) {
      console.error(err.message);
    } 
    const checkIdQuery = "SELECT id FROM sp_payments WHERE id = ?";
    const insertPaymentQuery = `INSERT INTO sp_payments (id,order_id,currency,amount,payable_amount,discsount_amount,disc_percent,received_amount,usd_amt,usd_rate,card_holder_name,card_number,phone_no,bank_trx_id,invoice_no,bank_status,customer_order_id,sp_code,sp_message,name,email,address,city,value1,value2,value3,value4,transaction_status,method,date_time) VALUES (?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?)`;
    try {
      response_data.forEach((data) => {
        const { id } = data;
        db.get(checkIdQuery, id, (err, row) => {
          if (err) {
            console.log(err);
          } else if (row) {
            console.log(`Data with id ${id} already exists`);
          } else {
            const values = [
              data.id,
              data.order_id,
              data.currency,
              data.amount,
              data.payable_amount,
              data.discsount_amount,
              data.disc_percent,
              data.received_amount,
              data.usd_amt,
              data.usd_rate,
              data.card_holder_name,
              data.card_number,
              data.phone_no,
              data.bank_trx_id,
              data.invoice_no,
              data.bank_status,
              data.customer_order_id,
              data.sp_code,
              data.sp_message,
              data.name,
              data.email,
              data.address,
              data.city,
              data.value1,
              data.value2,
              data.value3,
              data.value4,
              data.transaction_status,
              data.method,
              data.date_time,
            ];
            db.run(insertPaymentQuery, values, (err) => {
              if (err) {
                console.log(err);
              } else {
                console.log("Payment Update Successfully");
              }
            });
          }
        });
      });
    } catch (error) {
      console.log(error);
    }
  });
};

const update_sp_payment_table = (data) => {
  db.all(`SELECT * FROM sp_payments`, (err) => {
    if (err) {
      throw err;
    }
    const idToUpdate = data.id;
    const keys = Object.keys(data);
    const values = Object.values(data);

    const sql = `UPDATE sp_payments SET ${keys
      .map((key) => `${key} = ?`)
      .join(", ")}WHERE id = ?`;
    db.run(sql, [...values, idToUpdate], function (err) {
      if (err) {
        console.log(err.message);
      } else {
        console.log(`Payment updated sp_payment_table`);
      }
    });
  });
};

const update_merchant_order_table = (data) => {
  const sql = `UPDATE merchant_order SET status= ? WHERE order_id=? `;
  const params = [data.sp_message, data.customer_order_id];
  db.run(sql, params, function (err) {
    if (err) {
      console.log(err.message);
    } else {
      console.log(sql)
      console.log(`Payment updated merchant_order_table`);
    }
  });
};

app.post("/take-payment", (req, res) => {
  const orderDetails = req.body;
  const payload={
    ...orderDetails,
    client_ip: req.ip
  }
  shurjopay.gettoken_error_handler = function (error) {
    shurjopay.log(error.message, "error");
    res.status(400).send({ status: false, error: "Something went wrong!" });
  };
  shurjopay.checkout_error_handler = function (error) {
    shurjopay.log(error.message, "error");
    res.status(400).send({ status: false, error: "Something went wrong!" });
  };

  try {
    shurjopay.checkout(payload, (response_data) => {
      merchant_order_table(response_data);
      res.status(200).send(response_data);
    });
  } catch (err) {
    shurjopay.log(err.message, "error");
    res.status(400).send({ status: false, error: err.message });
  }
  // now trigger the checkout
});

app.post("/verify-payment", (req, res) => {
  //you can send sp_order_id by query or body or params
  const order_id = req.body.sp_order_id;
  try {
    shurjopay.verify(
      order_id,
      (response_data) => {
        sp_payment_table(response_data);
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

app.post("/payment-status-update", (req, res) => {
  //you can send sp_order_id by query or body or params
  const order_id = req.query.sp_order_id;;
  try {
    shurjopay.verify(order_id, (response_data) => {
      response_data.forEach(
        (data) => {
          update_sp_payment_table(data);
          update_merchant_order_table(data);
          
        }
      );
      res.status(200).send(response_data);
    },
    (error) => {
      shurjopay.log(error.message, "error");
      res.status(400).send({ status: false, error: error.message });
    });
  } catch (err) {
    shurjopay.log(err.message, "error");
    res.status(400).send({ status: false, error: err.message });
  }
});


app.get("/my-payment", (req, res) => {
  const email = req.query.email;
  try {
    db.all(`SELECT * FROM shurjopay where email="${email}"`, (err, rows) => {
      if (err) {
        res.status(400).send({ status: false, error: err.message });
      }
      res.status(200).send(rows);
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
