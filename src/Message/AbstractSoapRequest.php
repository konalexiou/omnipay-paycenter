<?php

namespace Omnipay\Paycenter\Message;

use Guzzle\Http\ClientInterface;
use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use SoapClient;
use SoapFault;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Omnipay\Common\Helper;
use Omnipay\Common\ItemBag;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Piraeus Bank Paycenter SOAP gateway Abstract Request
 *
 * The merchant web service is accessible at the following URL:
 *
 * https://paycenter.piraeusbank.gr/services/tickets/issuer.asmx
 *
 * The WSDL description is accessible with the following URL:
 *
 * https://paycenter.piraeusbank.gr/services/tickets/issuer.asmx?WSDL
 *
 */
abstract class AbstractSoapRequest extends OmnipayAbstractRequest
{
    /**
     * Test Endpoint URL
     *
     * @var string URL
     */
    protected $testEndpoint = 'https://paycenter.piraeusbank.gr/services/tickets/issuer.asmx?WSDL';

    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'https://paycenter.piraeusbank.gr/services/tickets/issuer.asmx?WSDL';

    /**
     * The request parameters
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /** @var  SoapClient */
    protected $soapClient;

    /** @var  string The name of the object that is expected in the SOAP response */
    public $responseName;

    /**
     * The generated SOAP request data, saved immediately before a transaction is run.
     *
     * @var array
     */
    protected $request;

    /**
     * The retrieved SOAP response, saved immediately after a transaction is run.
     *
     * @var SoapResponse
     */
    protected $response;

    /**
     * The amount of time in seconds to wait for both a connection and a response.
     *
     * Total potential wait time is this value times 2 (connection + response).
     *
     * @var float
     */
    public $timeout = 10;

    /**
     * Create a new Request
     *
     * @param ClientInterface $httpClient  A Guzzle client to make API calls with
     * @param HttpRequest     $httpRequest A Symfony HTTP request object
     * @param SoapClient      $soapClient
     */
    public function __construct(
        ClientInterface $httpClient,
        HttpRequest $httpRequest,
        SoapClient $soapClient = null
    ) {
      //parent::__construct($httpClient, $httpRequest);
      $this->soapClient = $soapClient;
    }

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     *
     * @return $this
     * @throws RuntimeException
     */
    public function initialize(array $parameters = array())
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = new ParameterBag;
        Helper::initialize($this, $parameters);

        return $this;
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
     * Build the SOAP Client and the internal request object
     *
     * @return SoapClient
     * @throws \Exception
     */
    public function buildSoapClient()
    {
        if (! empty($this->soapClient)) {
            return $this->soapClient;
        }

        $context_options = array(
            'http' => array(
                'timeout' => $this->timeout,
            ),
        );

        $context = stream_context_create($context_options);

        // options we pass into the soap client
        // turn on HTTP compression
        // set the internal character encoding to avoid random conversions
        // throw SoapFault exceptions when there is an error
        $soap_options = array(
            'compression'           => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
            'encoding'              => 'utf-8',
            'exceptions'            => true,
            'connection_timeout'    => $this->timeout,
            'stream_context'        => $context,
        );

        // if we're in test mode, don't cache the wsdl
        if ($this->getTestMode()) {
            $soap_options['cache_wsdl'] = WSDL_CACHE_NONE;
        } else {
            $soap_options['cache_wsdl'] = WSDL_CACHE_BOTH;
        }

        try {
            // create the soap client
            $this->soapClient = new \SoapClient($this->getEndpoint(), $soap_options);
            return $this->soapClient;
        } catch (SoapFault $sf) {
            throw new \Exception($sf->getMessage(), $sf->getCode());
        }
    }

    /**
     * Get the SOAP endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }


    /**
     * Send the request
     *
     * @return ResponseInterface
     */
    public function send()
    {
        $data = $this->getData();
        return $this->sendData($data);
    }
}
