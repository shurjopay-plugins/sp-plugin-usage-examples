<?php
use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\ShurjopayEnvReader;
/**
 *
 * PHP Plug-in service to provide shurjoPay get way services.
 *
 * @author Md Wali Mosnad Ayshik
 * @since 2022-10-15
 */
require_once __DIR__ . '/src/Shurjopay.php';
require_once __DIR__ . '/src/ShurjopayEnvReader.php';

$env = new ShurjopayEnvReader(__DIR__ . '/_env');
$conf = $env->getConfig();

$sp_instance = new Shurjopay($conf);

$response_data = (object)array(
    'Status' => 'No data found'
);

if ($_REQUEST['order_id'])
{
    $shurjopay_order_id = trim($_REQUEST['order_id']);
    $response_data = json_decode(json_encode($sp_instance->verifyPayment($shurjopay_order_id)));
	
	if($response_data[0]->sp_code=='1000')
	{
		
$db = new SQLite3('products.db');
$id =  $shurjopay_order_id;
$name = 'Product A';
$price = 10.50;
$status = 'Paid';
$insert_stmt = $db->prepare('INSERT INTO products (id, name, price, status) VALUES (:id, :name, :price, :status)');
$insert_stmt->bindValue(':id', $id, SQLITE3_TEXT);
$insert_stmt->bindValue(':name', $name, SQLITE3_TEXT);
$insert_stmt->bindValue(':price', $price, SQLITE3_FLOAT);
$insert_stmt->bindValue(':status', $status, SQLITE3_TEXT);
 $result=$insert_stmt->execute();
  // close the database connection
  $db->close();
  if ($result) {
    http_response_code(200);
    echo json_encode(['message' => 'IPN called Product updated successfully']);
  }
	}

    else {
        http_response_code(500);
        echo json_encode(['message' => 'IPN called this payment is not success']);
      }
}
?>