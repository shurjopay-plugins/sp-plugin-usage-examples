<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Tests;

use Shurjomukhi\ShurjopayLaravelPlugin\ShurjopayServiceProvider;


class TestCase extends \Orchestra\Testbench\TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
      ShurjopayServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }

  public function test_basic_test()
  {
     $response= $this->post('/test',[
        'username' => config('Shurjopay.merchant_username'),
        'password' => config('Shurjopay.merchant_password'),
     ]);
      $this->assertTrue($response);
  }

}
