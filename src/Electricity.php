<?php
/**
 * Created By: Henry Ejemuta
 * PC: Enrico Systems
 * Project: laravel-megasubplug
 * Company: Stimolive Technologies Limited
 * Class Name: Transaction.php
 * Date Created: 5/14/21
 * Time Created: 10:24 AM
 */

namespace HenryEjemuta\LaravelMegaSubPlug;

use HenryEjemuta\LaravelMegaSubPlug\Classes\MegaSubPlugResponse;
use HenryEjemuta\LaravelMegaSubPlug\Enums\DiscoEnum;
use HenryEjemuta\LaravelMegaSubPlug\Enums\MeterTypeEnum;

abstract class Electricity
{
    private $config;
    private $megaSup;

    public function __construct(MegaSubPlug $megaSup, $config)
    {
        $this->config = $config;
        $this->megaSup = $megaSup;
    }

    /**
     * @param DiscoEnum $disco
     * @param $meterNumber
     * @param $meterType
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function verifyMeterNumber(DiscoEnum $disco, $meterNumber, MeterTypeEnum $meterType): MegaSubPlugResponse
    {
        return $this->megaSup->getRequest('?action=validate_metre', [
            'electricity_plan_api_id' => $disco->getID(),
            'meter_number' => $meterNumber,
//            'mtype' =>  $meterType->getCode(),
        ]);
    }

    /**
     * @param DiscoEnum $disco
     * @param $meterNumber
     * @param $amount
     * @param MeterTypeEnum $meterType
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function buyElectricity(DiscoEnum $disco, $meterNumber, $amount, MeterTypeEnum $meterType): MegaSubPlugResponse
    {
        return $this->megaSup->postRequest('?action=buy_electricity', [
            'disco_name' => $disco->getID(),
            'meter_number' => $meterNumber,
            'amount' => $amount,
            'MeterType' => $meterType->getCode()
        ]);
    }

}
