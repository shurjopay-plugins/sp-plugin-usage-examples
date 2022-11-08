import { verifyPayemt, verify_status } from "./ShurjoPay.js";
const customer_name = document.getElementById("customer_name");
const Address = document.getElementById("Address");
const bank_trx_id = document.getElementById("bank_trx_id");
const currency = document.getElementById("currency");
const disc_percent = document.getElementById("disc_percent");
const invoice_no = document.getElementById("invoice_no");
const method = document.getElementById("method");
const sp_message = document.getElementById("sp_message");
const amount = document.getElementById("amount");
const customer_order_id = document.getElementById("customer_order_id");
const date_time = document.getElementById("date_time");

async function status() {
  const url_string = window.location.href.toLowerCase();
  const url = new URL(url_string);
  const order_id = url.searchParams.get("order_id");
  const tokendetails = sessionStorage.getItem(order_id);
  const [splitTokenDetails] = tokendetails.split(",");

  await verifyPayemt(splitTokenDetails[0], splitTokenDetails[1], order_id);

  for (const values of verify_status) {
    customer_name.innerHTML = values.name;
    Address.innerHTML = values.address;
    bank_trx_id.innerHTML = values.bank_trx_id;
    currency.innerHTML = values.currency;
    document.getElementById("disc_percent").innerHTML = values.disc_percent;
    invoice_no.innerHTML = values.invoice_no;
    method.innerHTML = values.method;
    sp_message.innerHTML = values.sp_message;
    amount.innerHTML = values.amount;
    customer_order_id.innerHTML = values.customer_order_id;
    date_time.innerHTML = values.date_time;
  }
}

window.onload = status();
