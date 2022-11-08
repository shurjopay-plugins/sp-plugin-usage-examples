import { makePayment, makePayment_details, token_details } from "./ShurjoPay.js";

const form = document.querySelector("form");
form.addEventListener("submit", handleSubmit);
let client_ip = "";
const order_id = "sp315689";

fetch("https://checkip.amazonaws.com/")
  .then((res) => res.text())
  .then((ip) => {
    client_ip = ip;
  });

function handleSubmit(event) {
  event.preventDefault();
  const data = new FormData(event.target);
  const formdata = Object.fromEntries(data.entries());
  payNow(formdata);
}

async function payNow(formdata) {
  const { token, token_type, store_id } = token_details;
  await makePayment(token_type, token, store_id, order_id, formdata, client_ip);
  const { sp_order_id, checkout_url } = makePayment_details;
  if (checkout_url) {
    window.location.href = checkout_url;
    form.reset();
  } else {
    alert("Please Input Valid Information");
  }
  sessionStorage.setItem(sp_order_id, [token_type, token]);
}
