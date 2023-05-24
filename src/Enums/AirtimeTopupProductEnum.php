<?php
/**
 * Created By: Henry Ejemuta
 * PC: Enrico Systems
 * Project: laravel-megasubplug
 * Company: Stimolive Technologies Limited
 * Class Name: NetworkEnum.php
 * Date Created: 5/14/21
 * Time Created: 10:47 AM
 */

namespace HenryEjemuta\LaravelMegaSubPlug\Enums;


use HenryEjemuta\LaravelMegaSubPlug\Exceptions\MegaSubPlugErrorException;

class AirtimeTopupProductEnum
{
    private static $cache = [];
    private static $productPlans = [
        '9MOBILE VTU' => 45,
        'AIRTEL VTU' => 46,
        'GLO VTU' => 47,
        'MTN AWOOF' => 50,
        'MTN Share and Sell' => 49,
        'MTN VTU' => 48,
    ];

    private $code, $name;

    private function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return ucfirst($this->name);
    }

    public function toArray(): array
    {
        return ['code' => $this->getCode(), 'name' => $this->getName()];
    }

    /**
     * @param $name
     * @return AirtimeTopupProductEnum|null
     * @throws MegaSubPlugErrorException
     */
    public static function getAirtimeTopupProduct($name): ?AirtimeTopupProductEnum
    {
        $cleanedName = strtolower(trim($name));
        if (!key_exists($cleanedName, self::$productPlans))
            throw new MegaSubPlugErrorException("No Airtime topup product available with the name '$name'", 999);
        if (!key_exists($cleanedName, self::$cache)) {
            self::$cache[$cleanedName] = new AirtimeTopupProductEnum(self::$productPlans[$cleanedName], $cleanedName);
        }
        return self::$cache[$cleanedName];
    }

    public static function getAirtimeTopupProductVtuByNetwork(NetworkEnum $mobileNetwork): ?AirtimeTopupProductEnum
    {
        switch ($mobileNetwork->getName()) {
            case 'mtn':
                return new AirtimeTopupProductEnum(48, 'MTN VTU');
            case 'glo':
                return new AirtimeTopupProductEnum(47, 'GLO VTU');
            case 'etisalat':
                return new AirtimeTopupProductEnum(45, '9MOBILE VTU');
            case 'airtel':
                return new AirtimeTopupProductEnum(46, 'AIRTEL VTU');
            default:
                throw new MegaSubPlugErrorException("No Airtime topup product available with the name '{$mobileNetwork->getName()}'", 999);
        }
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
