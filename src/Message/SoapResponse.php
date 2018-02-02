<?php

namespace Omnipay\Paycenter\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Allied Wallet SOAP Response
 */
class SoapResponse extends AbstractResponse
{
    public function __construct(AbstractSoapRequest $request, $data)
    {
        //parent::__construct($request, $data);

        // Convert the SOAP Response (stdClass containing a stdClass) to an array.
        $responseName = $request->responseName;
        $this->data   = json_decode(json_encode($data->$responseName), true);

        // print_r( $this->data );
        // echo $this->getTransactionReference();
        // exit;
    }

    public function isSuccessful()
    {
        if (! empty($this->data['ResultCode']) && $this->data['ResultCode'] == 0) {
            return true;
        }
        return false;
    }

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        if (! empty($this->data['ResultDescription'])) {
            return $this->data['ResultDescription'];
        }
        return null;
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        // One of the response code from the gateway is Status : 0
        // Therefore using empty() PHP function will fail the condition.
        if (isset($this->data['ResultCode']) && ! is_null($this->data['ResultCode'])) {
            return $this->data['ResultCode'];
        }
        return null;
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference()
    {
        if (! empty($this->data['TranTicket'])) {
            return $this->data['TranTicket'];
        }
        return null;
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTimestamp()
    {
        if (! empty($this->data['Timestamp'])) {
            return $this->data['Timestamp'];
        }
        return null;
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getMinutesToExpiration()
    {
        if (! empty($this->data['MinutesToExpiration'])) {
            return $this->data['MinutesToExpiration'];
        }
        return null;
    }
}
