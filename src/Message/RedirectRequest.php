<?php

namespace Omnipay\Paycenter\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * Paycenter Redirect Request
 */
class RedirectRequest extends AbstractRequest
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
        'TranTicket' => $this->getTransactionReference(),
        'testMode' => $this->getTestMode(),
      );
    }

    public function sendData($data)
    {

        //$data['AcquirerId'] = ;
        //$data['MerchantId'] = ;
        //$data['PosId'] = ;
        //$data['MerchantReference'] = ;
        $data['User'] = $data['Username'];
        $data['LanguageCode'] = isset($data['LanguageCode'])?$data['LanguageCode']:'el-GR';
        $data['ParamBackLink'] = $data['Parameters'];

        return $this->response = new RedirectResponse($this, $data);
    }

    /**
     * Get Username
     *
     * Use the Username assigned by Paycenter.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('Username');
    }

    /**
     * Set Username
     *
     * Use the Username assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setUsername($value)
    {
        return $this->setParameter('Username', $value);
    }

    /**
     * Get Password
     *
     * Use the Password assigned by Paycenter.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('Password');
    }

    /**
     * Set Password
     *
     * Use the Password assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setPassword($value)
    {
        return $this->setParameter('Password', $value);
    }

    /**
     * Get MerchantId
     *
     * Use the MerchantId assigned by Paycenter.
     *
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getParameter('MerchantId');
    }

    /**
     * Set MerchantId
     *
     * Use the MerchantId assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('MerchantId', $value);
    }

    /**
     * Get PosId
     *
     * Use the PosId assigned by Paycenter.
     *
     * @return string
     */
    public function getPosId()
    {
        return $this->getParameter('PosId');
    }

    /**
     * Set PosId
     *
     * Use the PosId assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setPosId($value)
    {
        return $this->setParameter('PosId', $value);
    }

    /**
     * Get AcquirerId
     *
     * Use the AcquirerId assigned by Paycenter.
     *
     * @return string
     */
    public function getAcquirerId()
    {
        return $this->getParameter('AcquirerId');
    }

    /**
     * Set AcquirerId
     *
     * Use the AcquirerId assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setAcquirerId($value)
    {
        return $this->setParameter('AcquirerId', $value);
    }

    /**
     * Get MerchantReference
     *
     * Use the MerchantReference assigned by Paycenter.
     *
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->getParameter('MerchantReference');
    }

    /**
     * Set MerchantReference
     *
     * Use the MerchantReference assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setMerchantReference($value)
    {
        return $this->setParameter('MerchantReference', $value);
    }

    /**
     * Get RequestType
     *
     * Use the RequestType assigned by Paycenter.
     *
     * @return string
     */
    public function getRequestType()
    {
        return $this->getParameter('RequestType');
    }

    /**
     * Set RequestType
     *
     * Use the RequestType assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setRequestType($value)
    {
        return $this->setParameter('RequestType', $value);
    }

    /**
     * Get ExpirePreauth
     *
     * Use the ExpirePreauth assigned by Paycenter.
     *
     * @return string
     */
    public function getExpirePreauth()
    {
        return $this->getParameter('ExpirePreauth');
    }

    /**
     * Set ExpirePreauth
     *
     * Use the ExpirePreauth assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setExpirePreauth($value)
    {
        return $this->setParameter('ExpirePreauth', $value);
    }

    /**
     * Get Amount
     *
     * Use the Amount assigned by Paycenter.
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->getParameter('Amount');
    }

    /**
     * Set Amount
     *
     * Use the Amount assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setAmount($value)
    {
        return $this->setParameter('Amount', $value);
    }

    /**
     * Get CurrencyCode
     *
     * Use the CurrencyCode assigned by Paycenter.
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->getParameter('CurrencyCode');
    }

    /**
     * Set CurrencyCode
     *
     * Use the CurrencyCode assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setCurrencyCode($value)
    {
        return $this->setParameter('CurrencyCode', $value);
    }

    /**
     * Get Installments
     *
     * Use the Installments assigned by Paycenter.
     *
     * @return string
     */
    public function getInstallments()
    {
        return $this->getParameter('Installments');
    }

    /**
     * Set Installments
     *
     * Use the Installments assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setInstallments($value)
    {
        return $this->setParameter('Installments', $value);
    }

    /**
     * Get Bnpl
     *
     * Use the Bnpl assigned by Paycenter.
     *
     * @return string
     */
    public function getBnpl()
    {
        return $this->getParameter('Bnpl');
    }

    /**
     * Set Bnpl
     *
     * Use the Bnpl assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setBnpl($value)
    {
        return $this->setParameter('Bnpl', $value);
    }

    /**
     * Get Parameters
     *
     * Use the Parameters assigned by Paycenter.
     *
     * @return string
     */
    public function getParameters()
    {
        return $this->getParameter('Parameters');
    }


    /**
     * Set Parameters
     *
     * Use the Parameters assigned by Paycenter.
     *
     * @param string $value
     * @return SoapAbstractRequest implements a fluent interface
     */
    public function setParameters($value)
    {
        return $this->setParameter('Parameters', $value);
    }


    /**
     * Gets the test mode of the request from the gateway.
     *
     * @return boolean
     */
    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    /**
     * Sets the test mode of the request.
     *
     * @param boolean $value True for test mode on.
     * @return AbstractRequest
     */
    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

}
