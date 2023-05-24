<?php
/**
 * Created By: Henry Ejemuta
 * PC: Enrico Systems
 * Project: laravel-megasubplug
 * Company: Stimolive Technologies Limited
 * Class Name: MegaSubPlugErrorException.php
 * Date Created: 9/27/20
 * Time Created: 7:24 PM
 */

namespace HenryEjemuta\LaravelMegaSubPlug\Exceptions;


class MegaSubPlugErrorException extends \Exception
{
    /**
     * MegaSubPlugErrorException constructor.
     * @param string $message
     * @param $code
     */
    public function __construct(string $message, $code)
    {
        parent::__construct($message, $code);
    }
}
