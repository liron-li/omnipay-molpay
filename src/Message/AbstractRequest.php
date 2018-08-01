<?php

namespace Omnipay\MOLPay\Message;


use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    const API_VERSION = 'v1';

    /**
     * Endpoint URL.
     *
     * @var string
     */
    protected $endpoint = 'https://api.mol.com/payout/payments';

    /**
     * Sandbox Endpoint URL.
     *
     * @var string
     */
    protected $sandboxEndpoint = 'https://sandbox-api.mol.com/payout/payments';

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
     * @param boolean $value True for test mode on.
     * @return AbstractRequest
     */
    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function getDescription()
    {
        return $this->getParameter('description');
    }

    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    public function getAccountId()
    {
        return $this->getParameter('accountId');
    }


    public function setAccountId($value)
    {
        return $this->setParameter('accountId', $value);
    }

    public function getChannelId()
    {
        return $this->getParameter('channelId');
    }

    public function setChannelId($value)
    {
        return $this->setParameter('channelId', $value);
    }


    public function setCurrencyCode($value)
    {
        return $this->setParameter('currencyCode', $value);
    }

    public function getCurrencyCode()
    {
        return $this->getParameter('currencyCode');
    }

    /**
     * Get endpoint.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->sandboxEndpoint : $this->endpoint;
    }
}
