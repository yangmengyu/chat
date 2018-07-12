<?php
/**
 * Created by PhpStorm.
 * User: faker1
 * Date: 2018/5/19
 * Time: 下午4:34
 */
namespace app\api\controller;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
//use PayPal\Api\Amount;
//use PayPal\Api\Details;
//use PayPal\Api\Item;
//use PayPal\Api\ItemList;
//use PayPal\Api\Payer;
//use PayPal\Api\Payment;
//use PayPal\Api\RedirectUrls;
//use PayPal\Api\Transaction;
//use Psr\Log\AbstractLogger;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ShippingAddress;



class Paypal
{

    public function pay_goods()
    {
        //require "../extend/PayPal/autoload.php"; //载入sdk的自动加载文件
        $clientId = 'AeTQXERPccJrK4shLAby2z1J4UbyOye-OCS5jch_CSPEgg7zdLOn4H4tTftDIKIWsjbl8e7khSmhg4eY';
        $clientSecret = 'ECa3geEw_W4vx-5vl_AMvtNDWgUVlXCUcxGXvz_yY-8bVtZ8oB4AL7QdeJ-Y3xT_67sQbi8cYvuRJqd7';
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );
        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('test pro 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("testpro1_01")// Similar to `item_number` in Classic API
            ->setPrice(20);
        $item2 = new Item();
        $item2->setName('test pro 2')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("testpro2_01")// Similar to `item_number` in Classic API
            ->setPrice(10);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        $address = new ShippingAddress();
        $address->setRecipientName('什么名字')
            ->setLine1('什么街什么路什么小区')
            ->setLine2('什么单元什么号')
            ->setCity('城市名')
            ->setState('浙江省')
            ->setPhone('12345678911')
            ->setPostalCode('12345')
            ->setCountryCode('CN');

        $itemList->setShippingAddress($address);


        $details = new Details();
        $details->setShipping(5)
            ->setTax(10)
            ->setSubtotal(70);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(85)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $baseUrl = 'http://'.$_SERVER["HTTP_HOST"];
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/api/Paypal/success")
            ->setCancelUrl("$baseUrl/api/Paypal/cancel");
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($apiContext);

        $approvalUrl = $payment->getApprovalLink();

        dump($approvalUrl);
    }

    public function pay(){

        $clientId = 'AeTQXERPccJrK4shLAby2z1J4UbyOye-OCS5jch_CSPEgg7zdLOn4H4tTftDIKIWsjbl8e7khSmhg4eY';
        $clientSecret = 'ECa3geEw_W4vx-5vl_AMvtNDWgUVlXCUcxGXvz_yY-8bVtZ8oB4AL7QdeJ-Y3xT_67sQbi8cYvuRJqd7';
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );
        $itemList = new ItemList();
        $items = array();
        $total = 0;
        $product = 'test支付测试';
        $price = 0.01;  // 金额

        $total = $total + $price ;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);
        $items[] = $item;

        $itemList->setItems($items);


        $shipping = 0.00; //运费
        $total = $total  + $shipping;


        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($product)
            ->setInvoiceNumber(uniqid());

        $baseUrl = 'http://'.$_SERVER["HTTP_HOST"];
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/api/Paypal/success")
            ->setCancelUrl("$baseUrl/api/Paypal/cancel");
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($apiContext);  //错误点
            //

        } catch (PayPalConnectionException $e) {
            echo $e->getData();
            die();
        }
        $approvalUrl = $payment->getApprovalLink();
        $id = $payment->getId();
        dump($id);
        dump($approvalUrl);
    }

    public function success()
    {
        echo 'success';
    }

    public function cancel()
    {
        echo 'cancel';
    }
}