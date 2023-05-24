<?php

namespace HenryEjemuta\LaravelMegaSubPlug;

use HenryEjemuta\LaravelMegaSubPlug\Classes\MegaSubPlugResponse;
use HenryEjemuta\LaravelMegaSubPlug\Enums\AirtimeTopupProductEnum;
use HenryEjemuta\LaravelMegaSubPlug\Enums\NetworkEnum;
use HenryEjemuta\LaravelMegaSubPlug\Exceptions\MegaSubPlugErrorException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\VarDumper\VarDumper;

class MegaSubPlug
{
    /**
     * base url
     *
     * @var string
     */
    private $baseUrl;

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * the session key
     *
     * @var string
     */
    protected $instanceName;

    protected $config;

    public function __construct($baseUrl, $instanceName, $config)
    {
        $this->baseUrl = $baseUrl;
        $this->instanceName = $instanceName;
        $this->config = $config;
    }

    /**
     * get instance name of the cart
     *
     * @return string
     */
    public function getInstanceName()
    {
        return $this->instanceName;
    }

    /**
     * @param array $headers
     * @return PendingRequest
     */
    private function withAuth(array $headers = []): PendingRequest
    {
        $headers["Password"] = $this->config['password'];

        return Http::withToken($this->config['api_token'], 'Token')->withHeaders($headers)->contentType("application/json")->beforeSending(function (Request $request, array $options) {
//            Log::info(print_r($request, true));
        });
    }

    /**
     * Make GET request with data and auth
     * @param string $endpoint
     * @param array $data
     * @return MegaSubPlugResponse
     * @throws MegaSubPlugErrorException
     */
    public function getRequest(string $endpoint, array $data = []): MegaSubPlugResponse
    {
        $response = $this->withAuth()->get("{$this->baseUrl}$endpoint", $data);
        if ($response->status() == 200)
            return new MegaSubPlugResponse($response->object());
        throw new MegaSubPlugErrorException($response->body(), $response->status());
    }

    /**
     * Make POST request with data and auth
     * @param string $endpoint
     * @param array $data
     * @return MegaSubPlugResponse
     * @throws MegaSubPlugErrorException
     */
    public function postRequest(string $endpoint, array $data = []): MegaSubPlugResponse
    {
        $response = $this->withAuth()->post("{$this->baseUrl}$endpoint", $data);
        if ($response->status() == 200)
            return new MegaSubPlugResponse($response->object());
        throw new MegaSubPlugErrorException($response->body(), $response->status());
    }

    /**
     * Get Your MegaSub account details including available balance
     * @return MegaSubPlugResponse
     * @throws MegaSubPlugErrorException
     */
    public function checkUserDetails(): MegaSubPlugResponse
    {
        return $this->getRequest("?action=user_detail");
    }

    /**
     * @param NetworkEnum $mobileNetwork
     * @param int $amount
     * @param $phoneNumber
     * @param bool $validatePhoneNetwork
     * @param bool $duplicationCheck
     * @return MegaSubPlugResponse
     * @throws MegaSubPlugErrorException
     */
    public function buyAirtime(NetworkEnum $mobileNetwork, int $amount, $phoneNumber, bool $validatePhoneNetwork = true, bool $duplicationCheck = true): MegaSubPlugResponse
    {
        $product = AirtimeTopupProductEnum::getAirtimeTopupProductVtuByNetwork($mobileNetwork);
        return $this->postRequest("?action=buy_airtime", [
            'network_api_id' => $mobileNetwork->getCode(),
            'amount' => $amount,
            'mobile_number' => $phoneNumber,
            'airtime_api_id' => $product->getCode(),
            'validatephonenetwork' => $validatePhoneNetwork,
            'duplication_check' => $duplicationCheck,
        ]);
        //{"id":16230,"airtime_type":"VTU","network":1,"paid_amount":"97.0","mobile_number":"08132796615","amount":"100","plan_amount":"N100","plan_network":"MTN","balance_before":"2892.6","balance_after":"2795.6","Status":"successful","create_date":"2021-08-28T21:02:54.311846","Ported_number":true}
    }

    private $transaction;

    /**
     * MegaSubPlug API Transaction handler to access:
     * Transaction()->getAllDataTransaction(): MegaSubPlugResponse
     * Transaction()->queryDataTransaction(int $txnId): MegaSubPlugResponse
     * Transaction()->queryAirtimeTransaction(int $txnId): MegaSubPlugResponse
     * Transaction()->queryElectricityBillTransaction(int $txnId): MegaSubPlugResponse
     * Transaction()->queryCableTvTransaction(int $txnId): MegaSubPlugResponse
     *
     * @return Transaction
     */
    public function Transaction(): Transaction
    {
        if (is_null($this->transaction))
            $this->transaction = new class($this) extends Transaction {};
        return $this->transaction;
    }

    private $cableTv;

    /**
     * Cable TV Bill handler to access:
     * CableTv()->verifyIUC(CableTvEnum $cableTv, $smartCardNo): MegaSubPlugResponse
     * CableTv()->purchasePackage(CableTvEnum $cableTv, string $package, $smartCardNo): MegaSubPlugResponse
     *
     * @return CableTv
     */
    public function CableTv(): CableTv
    {
        if (is_null($this->cableTv))
            $this->cableTv = new class($this, $this->config) extends CableTv {
            };
        return $this->cableTv;
    }


    /**
     * @param NetworkEnum $network Data Network Provider api id
     * @param string $plan Data Package Product api id
     * @param string $phoneNumber
     * @param bool $validatePhoneNetwork
     * @param bool $duplicationCheck
     * @return MegaSubPlugResponse
     * @throws MegaSubPlugErrorException
     */
    public function buyData(NetworkEnum $network, string $plan, string $phoneNumber, bool $validatePhoneNetwork = true, bool $duplicationCheck = true): MegaSubPlugResponse
    {
        return $this->postRequest('?action=buy_data', [
            'network_api_id' => $network->getCode(),
            'data_api_id' => $plan,
            'mobile_number' => $phoneNumber,
            'validatephonenetwork' => $validatePhoneNetwork,
            'duplication_check' => $duplicationCheck,
        ]);
    }


    private $electricity;

    /**
     * Electricity Bills payment handler to access:
     * Electricity()->verifyMeterNumber(DiscoEnum $disco, $meterNumber, MeterTypeEnum $meterType): MegaSubPlugResponse
     * Electricity()->buyElectricity(DiscoEnum $disco, $meterNumber, $amount, MeterTypeEnum $meterType): MegaSubPlugResponse
     *
     * @return Electricity
     */
    public function Electricity(): Electricity
    {
        if (is_null($this->electricity))
            $this->electricity = new class($this, $this->config) extends Electricity {
            };
        return $this->electricity;
    }
}
