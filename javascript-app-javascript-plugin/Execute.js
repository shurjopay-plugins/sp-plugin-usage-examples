import { makePayment } from "./Shurjopay.js";

const form = document.querySelector("form");
form.addEventListener('change', handleChange);


let formdata="";
const order_id = "sp315689";

  function handleChange(event) {
    const name = event.target.name;
    const value = event.target.value;
    formdata= (({ ...formdata, [name]: value }))
  };
  document.getElementById("payButton").onclick=async function handleSubmit() {
    payNow(formdata)
}

async function payNow(formdata) {

  const makePayment_details=await makePayment(order_id, formdata);
  const { checkout_url } = makePayment_details;
  if (checkout_url) {
    window.location.href = checkout_url;
    form.reset();
  } else {
    alert("Please Input Valid Information");
  }
}
