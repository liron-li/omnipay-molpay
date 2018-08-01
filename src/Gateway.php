<?php

namespace Omnipay\MOLPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\MOLPay\Message\PurchaseRequest;

class Gateway extends AbstractGateway
{
    /**
     * Get the name of the gateway.
     *
     * @return string
     */
    public function getName()
    {
        return 'MOLPay';
    }

    /**
     * Get the gateway parameters.
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'version' => 'v1'
        ];
    }

    /**
     * Get enableIPN.
     *
     * @return bool
     */
    public function getApplicationCode()
    {
        return $this->getParameter('applicationCode');
    }

    /**
     * Set enableIPN.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setApplicationCode($value)
    {
        return $this->setParameter('applicationCode', $value);
    }

    /**
     * Get the locale.
     *
     * The default language is English.
     *
     * @return string
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * Set the locale.
     *
     * The default language is English.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
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
     * @param bool $value
     * @return $this
     */
    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     *
     * @return \Omnipay\MOLPay\Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }


    /**
     * Create a refund request
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\MOLPay\Message\PartialRefundRequest', $parameters);
    }

    /**
     * Create a void request
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\MOLPay\Message\ReversalRequest', $parameters);
    }
}
