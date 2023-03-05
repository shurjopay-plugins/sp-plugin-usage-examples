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
shurjopay.gettoken_error_handler = function (error) {
  req.session.message = `There was an error processing your payment. You have not been charged and can try again.${error}`;
  req.session.messageType = "danger";
  console.log(error);
  res.redirect("/checkout/information");
};
shurjopay.checkout_error_handler = function (error) {
  req.session.message = `There was an error processing your payment. You have not been charged and can try again.${error}`;
  req.session.messageType = "danger";
  console.log(error);
  res.redirect("/checkout/information");
};
const error_handler = function (error) {
  req.session.message = `There was an error processing verify payment. You have not been charged and can try again.${error}`;
  req.session.messageType = "danger";
  console.log(error);
  res.redirect("/checkout/information");
};

app.post("/makepayment", (req, res) => {
  const orderDetails = req.body;
  const payLoad = {
    amount: orderDetails.amount,
    order_id: orderDetails.order_id,
    return_url: process.env.SP_RETURN_URL,
    cancel_url: process.env.SP_RETURN_URL,
    customer_name: orderDetails.customer_name,
    customer_address: orderDetails.customer_address,
    customer_phone: orderDetails.customer_phone,
    customer_email: orderDetails.customer_email,
    customer_city: orderDetails.customer_city,
    customer_post_code: orderDetails.customer_post_code,
    client_ip: req.ip,
    currency: orderDetails.currency,
  };

  try {
    shurjopay.checkout(payLoad, (response_data) => {
      res.status(200).send(response_data);
    });
  } catch (err) {
    console.log(err);
  }
  // now trigger the checkout
});

app.post("/verifypayment", (req, res) => {
  //you can send sp_order_id by query or body or params
  const order_id = req.body.sp_order_id;
  try {
    shurjopay.verify(
      order_id,
      (response_data) => {
        response_data.forEach((data) => {
            db.run(
              `INSERT INTO shurjopay (id,order_id,currency,amount,payable_amount,discsount_amount,disc_percent,received_amount,usd_amt,usd_rate,card_holder_name,card_number,phone_no,bank_trx_id,invoice_no,bank_status,customer_order_id,sp_code,sp_message,name,email,address,city,value1,value2,value3,value4,transaction_status,method,date_time) VALUES (?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?)`,
              [data.id,
                data.order_id ,data.currency ,data.amount ,data.payable_amount ,data.discsount_amount ,data.disc_percent ,data.received_amount ,data.usd_amt ,data.usd_rate ,data.card_holder_name ,data.card_number ,data.phone_no ,data.bank_trx_id ,data.invoice_no ,data.bank_status ,data.customer_order_id ,data.sp_code ,data.sp_message ,data.name ,data.email ,data.address ,data.city ,data.value1 ,data.value2 ,data.value3 ,data.value4 ,data.transaction_status ,data.method ,data.date_time],
              (err) => {
                if (err) {
                  console.log(err);
                } else {
                  console.log("Payment Update Successfully");
                }
              }
            );
        });
        res.status(200).send(response_data);
      },
      error_handler
    );
  } catch (err) {
    console.log(err);
  }
});

app.get("/ipn", (req, res) => {
  const order_id = req.query.sp_order_id;
  try {
    shurjopay.verify(
      order_id,
      (response_data) => {
        response_data.forEach((data) => {
          db.all(`SELECT * FROM shurjopay`, (err, rows) => {
            if (err) {
              throw err;
            }
            rows.forEach((row) => {
   
          const idToUpdate = data.id;
          const keys = Object.keys(data);
          const values = Object.values(data);
          if (data.sp_code == 1000 && row.sp_code!=1000 && data.id==row.id) {
            const sql = `UPDATE shurjopay SET ${keys
              .map((key) => `${key} = ?`)
              .join(", ")}WHERE id = ?`;
            db.run(sql, [...values, idToUpdate], function (err) {
              if (err) {
                console.log(err.message);
              } else {
                console.log(`Row(s) updated: ${this.changes} by Shurjopay`);
              }
              
            });
          } 
        })
        });
        res.status(200).send(response_data);
      },
      error_handler
    );
  });
  } catch (err) {
    console.log(err);
  }
});


app.get("/mypayment", (req, res) => {
  const email=req.query.email
  try{
    
    db.all(`SELECT * FROM shurjopay where email="${email}"`, (err, rows) => {
      if (err) {
        throw err;
      }
  
      res.status(200).send(rows);
    });
  }catch(err){
console.log(err)
  }

});

app.get("/", (req, res) => {
  res.send("server is running");
});

app.listen(port, () => {
  console.log("Server running at port", port);
});
