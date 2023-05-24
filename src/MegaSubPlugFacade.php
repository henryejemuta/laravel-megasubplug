<?php

namespace HenryEjemuta\LaravelMegaSubPlug;

use HenryEjemuta\LaravelMegaSubPlug\Classes\MegaSubPlugResponse;
use HenryEjemuta\LaravelMegaSubPlug\Enums\NetworkEnum;
use Illuminate\Support\Facades\Facade;

/**
 * @method static MegaSubPlugResponse checkUserDetails()
 * @method static MegaSubPlugResponse buyAirtime(NetworkEnum $mobileNetwork, int $amount, $phoneNumber, bool $portedNumber = true, string $airtimeType = "VTU")
 * @method static Transaction Transaction()
 * @method static CableTv CableTv()
 * @method static Electricity Electricity()
 * @method static MegaSubPlugResponse buyData(NetworkEnum $network, string $plan, string $phoneNumber, bool $portedNumber = true)
 *
 * For respective method implementation:
 * @see \HenryEjemuta\LaravelMegaSubPlug\MegaSubPlug
 */
class MegaSubPlugFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'megasubplug';
    }
}
