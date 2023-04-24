# How to Run

- Clone this repository to your local machine.
- Requires `node >= 18.14.0` and `npm >= 9.4.2`.
- Run `npm install` in the root directory.
- create a sqlite database.
- create .env like \_env_example.
- Run `npm run start-dev` in the root directory.

# REST API

The REST API to the example app is described below.

## Confirm Order

### Request

`POST /confirm-order`

```
  curl -X POST http://localhost:4000/confirm-order \
  -H "Content-Type: application/json" \
  -d '{
  "amount": "10",
  "currency": "BDT",
  "customer_name": "Shanto",
  "customer_address": "dhaka",
  "customer_phone": "01700000000",
  "customer_city": "Dhaka",
  "customer_post_code": "1212",
  "discount_amount": "10",
  "disc_percent": "",
  "customer_email": "test@gmail.com",
  "customer_state": "dhaka",
  "customer_postcode": "2113",
  "customer_country": "BD",
  "shipping_address": "test1",
  "shipping_city": "testcity",
  "shipping_country": "test country",
  "received_person_name": "Jon doe",
  "shipping_phone_number": "01700000000",
  "value1": "test value1",
  "value2": "",
  "value3": "",
  "value4": ""
  }'
```

### Response

```
  {
    "status": true,
    "message": "Confirm order Successfully",
    "data": [
      {
        "amount": "10",
        "currency": "BDT",
        "customer_name": "Ayshik",
        "customer_address": "dhaka",
        "customer_phone": "01700000000",
        "customer_city": "Dhaka",
        "customer_post_code": "1212",
        "discount_amount": "10",
        "disc_percent": "",
        "customer_email": "test@gmail.com",
        "customer_state": "dhaka",
        "customer_postcode": "2113",
        "customer_country": "BD",
        "shipping_address": "test1",
        "shipping_city": "testcity",
        "shipping_country": "test country",
        "received_person_name": "Jon doe",
        "shipping_phone_number": "01700000000",
        "value1": "test value1",
        "value2": "",
        "value3": "",
        "value4": "",
        "order_id": "aps-ca0l5bv3q8"
      }
    ]
  }
```

## Take Payment

### Request

`POST /take-payment/order_id`

```
  curl -X POST http://localhost:4000/take-payment/aps-bk8q4dj234 \
  -H "Content-Type: application/json"
```

### Response

```
  {
    "checkout_url": "https://securepay.shurjopayment.com/spaycheckout/?token=eyJ0e...................................XpRcabBp_RDkYXTN4&order_id=DEM6446476d3b2e5",
    "amount": 10,
    "currency": "BDT",
    "sp_order_id": "DEM6446476d3b2e5",
    "customer_order_id": "aps-bk8q4dj234",
    "customer_name": "Ayshik",
    "customer_address": "dhaka",
    "customer_city": "Dhaka",
    "customer_phone": "01700000000",
    "customer_email": "test@gmail.com",
    "client_ip": "::ffff:127.0.0.1",
    "intent": "sale",
    "transactionStatus": "Initiated"
  }
```

**Note:** Use checkout_url to take payment.

## Verify Payment

### Request

`POST /verify-payment/sp_order_id`

```
curl -X POST http://localhost:4000/verify-payment/aps-bk8q4dj234 \
-H "Content-Type: application/json"
```

### Response

```
  [
    {
      "id": 2147932,
      "order_id": "SP6437be9474004",
      "currency": "BDT",
      "amount": "10.0000",
      "payable_amount": "10.0000",
      "discount_amount": "10.0000",
      "disc_percent": 0,
      "recived_amount": "0.0000",
      "usd_amt": "0.0000",
      "usd_rate": 0,
      "card_holder_name": null,
      "card_number": null,
      "phone_no": null,
      "bank_trx_id": "0",
      "invoice_no": "SP6437be9474004",
      "bank_status": "Cancel",
      "customer_order_id": "aps-slamkuflw0",
      "sp_code": "1002",
      "sp_massage": "Cancel",
      "sp_message": "Cancel",
      "name": "Ayshik",
      "email": "test@gmail.com",
      "address": "dhaka",
      "city": "Dhaka",
      "value1": "test value1",
      "value2": "",
      "value3": "",
      "value4": "",
      "transaction_status": "Cancelled",
      "method": null,
      "date_time": "2023-04-13 14:34:45"
    }
  ]
```

## Instant payment notification(IPN)

### Request

`POST /payment-status-update?sp_order_id=order_id`

**Note:** This endpoint is automatically called by shurjoPay at the merchant's system to receive status updates on payment transactions, which may be pending due to various reasons or when customers lose their browser session.
