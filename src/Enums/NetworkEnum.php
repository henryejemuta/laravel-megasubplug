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

class NetworkEnum
{
    private static $cache = [];
    private static $telcoms = [
        'mtn' => 1,
        'glo' => 2,
        'airtel' => 3,
        'etisalat' => 4,
        'smile' => 5,
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
     * @return NetworkEnum|null
     * @throws MegaSubPlugErrorException
     */
    public static function getNetwork($name): ?NetworkEnum
    {
        $cleanedName = strtolower(trim($name));
        if (!key_exists($cleanedName, self::$telcoms))
            throw new MegaSubPlugErrorException("No Telecom available with the name '$name'", 999);
        if (!key_exists($cleanedName, self::$cache)) {
            self::$cache[$cleanedName] = new NetworkEnum(self::$telcoms[$cleanedName], $cleanedName);
        }
        return self::$cache[$cleanedName];
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
