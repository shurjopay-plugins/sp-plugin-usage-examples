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

}
}
?>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">      
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    </head>
    <body>
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="img">
              <img src="assets/image/shurjopay-logo.png" alt="" class="center">
              <hr>
            </div>
            	
            	<table id="regForm" class="table table-hover">
            		<?php

if (is_array($response_data)):
    $response_data = array_shift($response_data);
    foreach ($response_data as $key => $val):

?>
            			<tr>
            				<td class="table-info"><?php echo $key ?></td>
            				<td><?php print_r($val); ?></td>
            			</tr>
            		<?php
    endforeach;
endif;

?>
            		<tr><td colspan="2"><a href="./index.php"><b>Back</b></td></tr>
            	</table>
            
          </div>
        </div>
      </div>      
    </body>
</html>
