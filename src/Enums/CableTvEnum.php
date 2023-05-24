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

class CableTvEnum
{
    private static $cache = [];
    private static $tvs = [
        'gotv' => ['name' => 'GOtv', 'id' => 1],
        'dstv' => ['name' => 'DStv', 'id' => 2],
        'startimes' => ['name' => 'Startimes', 'id' => 3],
    ];
    /**
     * @var int
     */
    private $id;

    private $code, $name;

    private function __construct(int $id, string $code, string $name)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }

    public function getID(): int
    {
        return $this->id;
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
     * @param $code
     * @return CableTvEnum|null
     * @throws MegaSubPlugErrorException
     */
    public static function getCableTv($code): ?CableTvEnum
    {
        $cleanedName = strtolower(trim($code));
        if (!key_exists($cleanedName, self::$tvs))
            throw new MegaSubPlugErrorException("No Cable TV available with the code '$code'", 404);
        if (!key_exists($cleanedName, self::$cache))
            self::$cache[$cleanedName] = new CableTvEnum($cleanedName, self::$tvs[$cleanedName]);
        return self::$cache[$cleanedName];
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
