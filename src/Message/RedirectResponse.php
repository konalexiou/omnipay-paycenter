<?php
/**
 * Viva Payments Redirect (REST) Response
 */

namespace Omnipay\Paycenter\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

// use Omnipay\Common\Exception\RuntimeException;
// use Symfony\Component\HttpFoundation\RedirectResponse as HttpRedirectResponse;
// use Symfony\Component\HttpFoundation\Response as HttpResponse;

class RedirectResponse implements RedirectResponseInterface
{
    /** @var string  */
    // protected $baseEndpoint;
    protected $testEndpoint = 'http://localhost/testpay/paycenter-pay.php';
    protected $liveEndpoint = 'https://paycenter.piraeusbank.gr/redirection/pay.aspx';

    public function __construct(
        RequestInterface $request,
        $data,
        $statusCode = 200
    ) {
        $this->data = $data;
    }


    public function isRedirect()
    {
        // The gateway returns errors in several possible different ways.
        if ($this->getRedirectMethod() != 'POST') {
            return false;
        }
        return true;
    }


    public function getRedirectUrl()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }


    public function getRedirectMethod()
    {
        return 'POST';
    }


    public function getRedirectData()
    {
        return array(
          'AcquirerId' => $this->data['AcquirerId'],
          'MerchantId' => $this->data['MerchantId'],
          'PosId' => $this->data['PosId'],
          'MerchantReference' => $this->data['MerchantReference'],
          'User' => $this->data['User'],
          'LanguageCode' => $this->data['LanguageCode'],
          'ParamBackLink' => $this->data['ParamBackLink'],
        );
    }


    public function redirect(){

      // make a curl or guzzle post request
      if( $this->getRedirectMethod()=="POST" ){
        $hiddenFields = '';
        foreach ($this->getRedirectData() as $key => $value) {
            $hiddenFields .= sprintf(
                '<input type="hidden" name="%1$s" value="%2$s" />',
                htmlentities($key, ENT_QUOTES, 'UTF-8', false),
                htmlentities($value, ENT_QUOTES, 'UTF-8', false)
            )."\n";
        }

        $output = '<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Redirecting...</title>
</head>
<body onload="document.forms[0].submit();">
    <form action="%1$s" method="post">
        <p>Redirecting to payment page...</p>
        <p>
            %2$s
            <input type="submit" value="Continue" />
        </p>
    </form>
</body>
</html>';
        $output = sprintf(
            $output,
            htmlentities($this->getRedirectUrl(), ENT_QUOTES, 'UTF-8', false),
            $hiddenFields
        );

        echo $output;
        //return HttpResponse::create($output);
      } else {
        echo "Invalid method 'GET'";
      }

      return null;
    }


    public function getRequest(){
      return null;
    }


    public function isSuccessful(){
      return null;
    }


    public function isCancelled(){
      return null;
    }


    public function getMessage(){
      return 'Not a valid redirect';
    }


    public function getCode(){
      return null;
    }


    public function getTransactionReference(){
      return $this->data['MerchantReference'];
    }


    public function getData(){
      return $this->data;
    }


    public function getTestMode()
    {
        return $this->data['testMode'];
    }

}
