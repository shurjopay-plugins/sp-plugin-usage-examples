const { MerchantOrder, Transactions } = require("./models");

// Function to create a new merchant order record in the database with the provided data.
const merchant_order = (data) => {
  MerchantOrder.create({
    my_order_id: data.order_id,
    amount: data.amount,
    created_at: new Date().toISOString(),
    cu_name: data.customer_name,
    cu_mobile: data.customer_phone,
    cu_email: data.customer_email,
    cu_address: data.customer_address,
    cu_city: data.customer_city,
    cu_postcode: data.customer_post_code,
    sh_contact: data.received_person_name,
    sh_address: data.shipping_address,
    sh_city: data.shipping_city,
    sh_country: data.shipping_country,
    sh_phone: data.shipping_phone_number,
    tx_init_req: JSON.stringify(data),
  })
    .then((order) => {
      console.log("Order created successfully:");
    })
    .catch((error) => {
      if (error.name === "SequelizeUniqueConstraintError") {
        console.log("Error: my_order_id must be unique");
      } else {
        console.log("Error creating order:", error);
      }
    });
};

// This function creates a payment request for a transaction.
// If the transaction already exists in the database, it updates the order.
// Otherwise, it creates a new transaction and saves it to the database.
const payment_request = async (data) => {
  const order_id_exits = await Transactions.findOne({
    where: { my_order_id: data.customer_order_id },
  });
  if (order_id_exits) {
    update_order(data.customer_order_id, data);
  } else {
    Transactions.create({
      my_order_id: data.customer_order_id,
      sp_trxn_id: data.sp_order_id,
      tx_status: data.transactionStatus,
      bank_trnx_id: null,
      bank_status: null,
      tx_amount: null,
      tx_currency: data.currency,
      payment_channel: null,
      tx_start_time: new Date().toISOString(),
      sp_tx_time: null,
      tx_init_res: JSON.stringify(data),
      tx_vrfy_res: null,
      tx_status_details: null,
      receivable_amount: data.amount,
      email: data.customer_email,
    })
      .then((transaction) => {
        console.log("Transaction created successfully:");
      })
      .catch((error) => {
        console.error("Unable to create transaction:", error);
      });
  }
};


// If the transaction already exists in the database, it updates the order.
const update_order = async (id, data) => {
  try {
    const [rowsUpdated] = await Transactions.update(
      {
        sp_trxn_id: data.sp_order_id,
        tx_status: data.transactionStatus,
        bank_trnx_id: null,
        bank_status: null,
        tx_amount: null,
        tx_currency: data.currency,
        payment_channel: null,
        tx_start_time: new Date().toISOString(),
        sp_tx_time: null,
        tx_init_res: JSON.stringify(data),
        tx_vrfy_res: null,
        tx_status_details: null,
        receivable_amount: data.amount,
        email: data.customer_email,
      },
      {
        where: {
          my_order_id: id,
        },
      }
    );

    if (rowsUpdated === 0) {
      throw new Error("Transaction not found");
    }

    console.log("Transaction updated successfully");
  } catch (error) {
    console.log(`Unable to update transaction: ${error}`);
  }
};

// This function updates the payment details of a transaction with the given ID
const payment_details = async (id, data) => {
  try {
    const [rowsUpdated] = await Transactions.update(
      {
        bank_trnx_id: data[0].bank_trx_id,
        tx_status: data[0].transaction_status,
        bank_status: data[0].bank_status,
        tx_amount: data[0].received_amount,
        payment_channel: data[0].method,
        sp_tx_time: data[0].date_time,
        tx_vrfy_res: JSON.stringify(data),
        tx_status_details: data[0].message,
      },
      {
        where: {
          sp_trxn_id: id,
        },
      }
    );

    if (rowsUpdated === 0) {
      throw new Error("Transaction not found");
    }

    console.log("Transaction updated successfully");
  } catch (error) {
    console.log(`Unable to update transaction: ${error}`);
    // You may want to return an error message or throw an error here instead of logging to the console
  }
};

module.exports = {
  merchant_order,
  payment_request,
  payment_details,
};
