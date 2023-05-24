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

class DiscoEnum
{
    private static $cache = [];
    private static $discos = [
        'ikedc' => ['id' => 1, 'name' => 'Ikeja Electric - IKEDC'],
        'ekedc' => ['id' => 2, 'name' => 'Eko Electric - EKEDC'],
        'aedc' => ['id' => 3, 'name' => 'Abuja Electric - AEDC'],
        'kedco' => ['id' => 4, 'name' => 'Kano Electric - KEDCO'],
        'eedc' => ['id' => 5, 'name' => 'Enugu Electric - EEDC'],
        'phed' => ['id' => 6, 'name' => 'Porthacourt Electric - PHED'],
        'ibedc' => ['id' => 7, 'name' => 'Ibadan Electric - IBEDC'],
        'kaedco' => ['id' => 8, 'name' => 'Kaduna Elecdtric - KAEDCO'],
        'jed' => ['id' => 9, 'name' => 'Jos Electric - JED'],
        'bedc' => ['id' => 10, 'name' => 'Benin Electric - BEDC'],
    ];

    private $disco;
    private $uid;

    private function __construct(string $uid, array $disco)
    {
        $this->uid = $uid;
        $this->disco = (object)$disco;
    }

    public function getUID(): string
    {
        return $this->disco->uid;
    }

    public function getID(): int
    {
        return $this->disco->id;
    }

    public function getName(): string
    {
        return $this->disco->name;
    }

    public function toArray(): array
    {
        return [
            'uid' => $this->getUID(),
            'id' => $this->getID(),
            'name' => $this->getName()
        ];
    }

    /**
     * @param $uid
     * @return DiscoEnum|null
     * @throws MegaSubPlugErrorException
     */
    public static function getByUID($uid): ?DiscoEnum
    {
        $uid = trim("$uid");
        if (!key_exists($uid, self::$discos))
            throw new MegaSubPlugErrorException("Not a valid MegaSubPlug Disco", 999);
        if (!key_exists($uid, self::$cache))
            self::$cache[$uid] = new DiscoEnum($uid, self::$discos[$uid]);
        return self::$cache[$uid];
    }

    /**
     * @param $id
     * @return DiscoEnum|null
     * @throws MegaSubPlugErrorException
     */
    public static function getByID($id): ?DiscoEnum
    {
        $id = trim($id);
        if (!key_exists($id, self::$cache)) {
            $found = false;
            foreach (self::$discos as $idx => $disco) {
                if ($disco['id'] == $id) {
                    self::$cache[$id] = new DiscoEnum($idx, $disco);
                    $found = true;
                }
            }
            if (!$found) {
                throw new MegaSubPlugErrorException("Not a valid MegaSubPlug Disco", 999);
            }
        }
        return self::$cache[$id];
    }

    public function __toString(): string
    {
        return print_r($this->toArray(), true);
    }
}
