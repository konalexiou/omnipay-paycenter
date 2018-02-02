<?php

namespace Omnipay\Paycenter;

use Omnipay\Common\AbstractGateway;

/**
 * Paycenter Gateway
 *
 * This gateway is for Piraues Bank Paycenter.
 *
 *
 * ### Example
 *
 * <code>
 * // Create a gateway for the Paycenter Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('Paycenter_Redirect');
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase( array(
 *        'Username' => 'Username', // Username provided by the bank
 *        'Password' => hash('md5', 'Password'), // Password provided by the bank.
 *        'MerchantId' => 1234567890, // MerchantId provided by the bank
 *        'PosId' => 1234567890, // PosId provided by the bank
 *        'AcquirerId' => 1234567890, // AcquirerId provided by the bank
 *        'testMode' => true, // True for test mode false for production.
 *        'MerchantReference' => 1234567890,
 *        'RequestType' => '02',
 *        'ExpirePreauth' => 0,
 *        'Amount' => 0.01,
 *        'CurrencyCode' => '978',
 *        'Installments' => 0,
 *        'Bnpl' => '0',
 *        'Parameters' => ''
 * ));
 * $response = $transaction->send();
 *  if ($response->isRedirect()) {
 * // redirect to offsite payment gateway
 *      $response->redirect();
 *  } elseif ($response->isSuccessful()) {
 *      // payment was successful
 *      print_r($response);
 *  } else {
 *      // payment failed: display message to customer
 *      echo $response->getMessage();
 *  }
 * </code>
 */
class RedirectGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Piraeus Bank Paycenter Redirect v1.0';
    }

    public function getDefaultParameters()
    {
        return array();
    }

    /**
     * Create a ticket request.
     *
     * @param array $parameters
     * @return \Omnipay\Paycenter\Message\TicketRequest
     */
    public function ticket(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Paycenter\Message\TicketRequest', $parameters);
    }

    /**
     * Create an authorize request.
     *
     * @param array $parameters
     * @return \Omnipay\Paycenter\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        // Set params for authorize
        $parameters['RequestType'] = '00';
        $parameters['Bnpl'] = 0;
        $ticket = $this->ticket($parameters);
        $parameters['transactionReference'] = $ticket->getTransactionReference();
        return $this->createRequest('\Omnipay\Paycenter\Message\RedirectRequest', $parameters);
    }

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     * @return \Omnipay\Paycenter\Message\PaymentRequest
     */
    public function purchase(array $parameters = array())
    {
        // Set params for purchase
        $parameters['RequestType'] = '02';
        $parameters['ExpirePreauth'] = 0;
        $parameters['Bnpl'] = 0;
        $ticket_req = $this->ticket($parameters);
        $ticket = $ticket_req->send();


        $parameters['transactionReference'] = $ticket->getTransactionReference();
        // if( $parameters['testMode']==true ){
        //   $parameters['transactionReference'] = $parameters['MerchantReference'];
        // }

        return $this->createRequest('\Omnipay\Paycenter\Message\RedirectRequest', $parameters);
    }

}
