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
use HenryEjemuta\LaravelMegaSubPlug\Enums\CableTvEnum;

abstract class CableTv
{
    private $config;
    private $megaSup;

    public function __construct(MegaSubPlug $megaSup, $config)
    {
        $this->config = $config;
        $this->megaSup = $megaSup;
    }


    /**
     * @param CableTvEnum $cableTv
     * @param $smartCardNo
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function verifyIUC(CableTvEnum $cableTv, $smartCardNo): MegaSubPlugResponse
    {
        return $this->megaSup->getRequest('?action=validate_cable', [
            'cable_plan_api_id' => $cableTv->getID(),
            'smart_card_number' => $smartCardNo,
        ]);
    }

    /**
     * @param CableTvEnum $cableTv
     * @param string $package
     * @param $smartCardNo
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function purchasePackage(CableTvEnum $cableTv, string $package, $smartCardNo): MegaSubPlugResponse
    {
        return $this->megaSup->postRequest('cablesub', [
            'cablename' => $cableTv->getID(),
            'cableplan' => $package,
            'smart_card_number' => $smartCardNo,
        ]);
    }


}
