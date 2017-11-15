<?php

namespace Omnipay\Paycenter\Message;

use SoapClient;


/**
 * Paycenter Ticket Request
 */
class TicketRequest extends AbstractSoapRequest
{
    public function getData()
    {
        return array(
          'Username' => $this->getUsername(),
          'Password' => $this->getPassword(),
          'MerchantId' => $this->getMerchantId(),
          'PosId' => $this->getPosId(),
          'AcquirerId' => $this->getAcquirerId(),
          'MerchantReference' => $this->getMerchantReference(),
          'RequestType' => $this->getRequestType(),
          'ExpirePreauth' => $this->getExpirePreauth(),
          'Amount' => $this->getAmount(),
          'CurrencyCode' => $this->getCurrencyCode(),
          'Installments' => $this->getInstallments(),
          'Bnpl' => $this->getBnpl(),
          'Parameters' => $this->getParameters(),
          'testMode' => $this->getTestMode(),
        );
    }


    public function sendData($data)
    {
        // Build the SOAP client
        $soapClient = $this->buildSoapClient();
        // Prepare data request
        $this->responseName = "IssueNewTicketResult";
        $xml = [ 'Request' => $data ];
        // Issue ticket
        $response = $soapClient->IssueNewTicket($xml);

        return $this->response = new SoapResponse($this, $response);
    }

}
