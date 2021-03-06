<?php

namespace Omnipay\MOLPay\Message;


use Omnipay\MOLPay\Exception\DefaultException;

/**
 * MOLPay Purchase Request.
 *
 * ### Parameters
 *
 * * amount        [required] - Total amount to be paid
 * * card          [required] - Credit card details as an Omnipay CreditCard object
 * * description   [required] - Description of the purchase
 * * marchantId    [required] - Merchant ID provided by MOLPay
 * * transactionId [required] - Invoice or order number from merchant system
 * * verifyKey     [required] - Encrypted key generated by MOLPay
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('secretKey', 'amount', 'returnUrl', 'transactionId');

        $endpoint = $this->getEndpoint();

        $requestData =  [
            'applicationCode'       => $this->getApplicationCode(),
            'referenceId'           => $this->getTransactionId(),
            'version'               => self::API_VERSION,
            'amount'                => $this->getAmount(),
            'currencyCode'          => $this->getCurrencyCode(),
            'returnUrl'             => $this->getReturnUrl(),
            'description'           => $this->getDescription(),
            'customerId'            => $this->getAccountId(),
            'signature'             => $this->generateSignature(),
        ];

        if ($channelId = $this->getChannelId()) {
            $requestData['channelId'] = $channelId;
        }

        $httpResponse = $this->httpClient->request('POST', $endpoint, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ], http_build_query($requestData));

        $body = json_decode($httpResponse->getBody(), true);

        if (isset($body['message'])) {
            throw new DefaultException($body['message']);
        }

        return $body;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    /**
     * Generate vCode.
     *
     * @return string
     */
    protected function generateSignature()
    {
        $amount             = $this->getAmount();
        $applicationCode    = $this->getApplicationCode();
        $currencyCode       = $this->getCurrencyCode();
        $customerId         = $this->getAccountId();
        $description        = $this->getDescription();
        $referenceId        = $this->getTransactionId();
        $returnUrl          = $this->getReturnUrl();
        $version            = self::API_VERSION;
        $secretKey          = $this->getSecretKey();

        $str = $amount . $applicationCode . $currencyCode . $customerId . $description . $referenceId . $returnUrl . $version . $secretKey;

        return md5($str);
    }
}
