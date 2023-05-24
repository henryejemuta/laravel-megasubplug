<?php
/**
 * Created By: Henry Ejemuta
 * PC: Enrico Systems
 * Project: laravel-megasubplug
 * Company: Stimolive Technologies Limited
 * Class Name: MegaSupStatusCode.php
 * Date Created: 5/14/21
 * Time Created: 12:12 PM
 */

namespace HenryEjemuta\LaravelMegaSubPlug\Enums;


/**
 * Process flow for dispute resolution is outlined below
 *
 * 1. Initiate a transaction by calling the appropriate end point. An OrderID is generated which is returned as part of the JSON response.
 *
 * 2. Retrieve the OrderID and pass it as a parameter to our Query API to get the status of the order.
 *
 * 3. If the order fails, then pass the OrderID retrieved in stage two(2) above to our CANCEL API  to cancel the transaction.
 *
 * Class MegaSubPlugStatusCodeEnum
 * @package HenryEjemuta\LaravelMegaSubPlug\Classes
 */
class MegaSubPlugStatusCodeEnum
{
    public static $successCodes = [100, 199, 300, 200, 201];
    private static $statusCodes = [
        '100' => [
            'code' => 100,
            'status' => 'ORDER_RECEIVED',
            'remark' => 'Awaiting Processing',
            'description' => 'Order has been received and is awaiting processing'
        ],
        '199' => [
            'code' => 199,
            'status' => 'ORDER_RECEIVED',
            'remark' => 'Unspecified Error',
            'description' => ''
        ],
        '300' => [
            'code' => 300,
            'status' => 'ORDER_PROCESSED',
            'remark' => 'Awaiting Network Response',
            'description' => 'Transaction was sent and is awaiting response from mobile network operator'
        ],
        '399' => [
            'code' => 399,
            'status' => 'ORDER_PROCESSED',
            'remark' => 'Unspecified Error',
            'description' => ''
        ],
        '200' => [
            'code' => 200,
            'status' => 'ORDER_COMPLETED',
            'remark' => 'Success',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was successful'
        ],
        '201' => [
            'code' => 201,
            'status' => 'ORDER_COMPLETED',
            'remark' => 'Network Unresponsive',
            'description' => 'Transaction was sent but no response was received from mobile network operator after 60seconds. All transaction that returns network unresponsive will be retried every 5min for a maximum of 1hour before it is cancelled.

N.B. network issues with the provider and can sometimes be resolved when tried later'
        ],
        '299' => [
            'code' => 299,
            'status' => 'ORDER_COMPLETED',
            'remark' => 'Unspecified Error',
            'description' => ''
        ],
        '400' => [
            'code' => 400,
            'status' => 'ORDER_ERROR',
            'remark' => 'INVALID_CREDENTIALS',
            'description' => 'The UserID and API key combination is not correct.'
        ],
        '401' => [
            'code' => 401,
            'status' => 'ORDER_ERROR',
            'remark' => 'MISSING_CREDENTIALS',
            'description' => 'The URL format is not valid.'
        ],
        '402' => [
            'code' => 402,
            'status' => 'ORDER_ERROR',
            'remark' => 'MISSING_USERID',
            'description' => 'Username field is empty'
        ],
        '403' => [
            'code' => 403,
            'status' => 'ORDER_ERROR',
            'remark' => 'MISSING_ApiToken',
            'description' => 'API Key field is empty'

        ],
        '404' => [
            'code' => 404,
            'status' => 'ORDER_ERROR',
            'remark' => 'MISSING_MOBILENETWORK',
            'description' => 'Mobile network is empty'
        ],
        '405' => [
            'code' => 405,
            'status' => 'ORDER_ERROR',
            'remark' => 'MISSING_AMOUNT',
            'description' => 'Amount is empty'
        ],
        '406' => [
            'code' => 406,
            'status' => 'ORDER_ERROR',
            'remark' => 'INVALID_AMOUNT',
            'description' => 'Amount is not valid'
        ],
        '407' => [
            'code' => 407,
            'status' => 'ORDER_ERROR',
            'remark' => 'MINIMUM_100',
            'description' => 'Minimum amount is 100'
        ],
        '408' => [
            'code' => 408,
            'status' => 'ORDER_ERROR',
            'remark' => 'MINIMUM_50000',
            'description' => 'Minimum amount is 50,000'
        ],
        '409' => [
            'code' => 409,
            'status' => 'ORDER_ERROR',
            'remark' => 'INVALID_RECIPIENT',
            'description' => 'An invalid mobile phone number was entered'
        ],
        '410' => [
            'code' => 410,
            'status' => 'ORDER_ERROR',
            'remark' => 'INVALID_API_ERROR1',
            'description' => 'API error'
        ],
        '411' => [
            'code' => 411,
            'status' => 'ORDER_ERROR',
            'remark' => 'INVALID_API_ERROR2',
            'description' => 'API error'
        ],
        '412' => [
            'code' => 412,
            'status' => 'ORDER_ERROR',
            'remark' => 'INSUFFICIENT_APIAMOUNT',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '413' => [
            'code' => 413,
            'status' => 'ORDER_ERROR',
            'remark' => 'INVALID_API',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '414' => [
            'code' => 414,
            'status' => 'ORDER_ERROR',
            'remark' => 'INVALID_PAYMENT_OPTION',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '415' => [
            'code' => 415,
            'status' => 'ORDER_ERROR',
            'remark' => 'INSUFFICIENT_APISTOREDEALERAMOUNT',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '416' => [
            'code' => 416,
            'status' => 'ORDER_ERROR',
            'remark' => 'INSUFFICIENT_APISTOREAMOUNT',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '417' => [
            'code' => 417,
            'status' => 'ORDER_ERROR',
            'remark' => 'INSUFFICIENT_BALANCE',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

            N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '418' => [
            'code' => 418,
            'status' => 'ORDER_ERROR',
            'remark' => 'INVALID_MOBILENETWORK',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

            N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '499' => [
            'code' => 499,
            'status' => 'ORDER_ERROR',
            'remark' => 'Unspecified Error',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

            N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '600' => [
            'code' => 600,
            'status' => 'ORDER_ONHOLD',
            'remark' => 'Network Error',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '601' => [
            'code' => 601,
            'status' => 'ORDER_ONHOLD',
            'remark' => 'Your request cannot be processed at this time',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '602' => [
            'code' => 602,
            'status' => 'ORDER_ONHOLD',
            'remark' => 'Your account has been credited back for failed Txn',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '603' => [
            'code' => 603,
            'status' => 'ORDER_ONHOLD',
            'remark' => 'the process failed',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '604' => [
            'code' => 604,
            'status' => 'ORDER_ONHOLD',
            'remark' => 'Transaction Failure',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '605' => [
            'code' => 605,
            'status' => 'ORDER_ONHOLD',
            'remark' => 'Failed recharge',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '606' => [
            'code' => 606,
            'status' => 'ORDER_ONHOLD',
            'remark' => 'By APIUser',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful but was placed on hold by our system. All transaction that is placed on hold will be retried every 5min for a maximum of 1hour, before it is cancelled.

N.B. Transactions are usually placed on hold due to network issues with the provider and can sometimes be resolved when tried later'
        ],
        '699' => [
            'code' => 699,
            'status' => 'ORDER_ONHOLD',
            'remark' => 'Unspecified Error',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '500' => [
            'code' => 500,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'By APIUser',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '501' => [
            'code' => 501,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'By Server',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '506' => [
            'code' => 506,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Server Busy',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '507' => [
            'code' => 507,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Network Error',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '508' => [
            'code' => 508,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Your request cannot be processed at this time',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '509' => [
            'code' => 509,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Your account has been credited back for failed Txn',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '510' => [
            'code' => 510,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'The process failed',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '511' => [
            'code' => 511,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Transaction Failure',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '512' => [
            'code' => 512,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'request is not valid',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '513' => [
            'code' => 513,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Failed recharge',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '514' => [
            'code' => 514,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Transaction rejected',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '515' => [
            'code' => 515,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'The receivers account is in the wrong state',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '516' => [
            'code' => 516,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'is not a valid MTN Subscriber',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '517' => [
            'code' => 517,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'is not eligible for this offer',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '518' => [
            'code' => 518,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'the subscriber you are trying to Buy data for is not eligible',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '519' => [
            'code' => 519,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'You already have a Data Plan yet to be activated',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '520' => [
            'code' => 520,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'you are not gifting to a valid Globacom user',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '521' => [
            'code' => 521,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Order already completed, cancelled or refunded',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '599' => [
            'code' => 599,
            'status' => 'ORDER_CANCELLED',
            'remark' => 'Unspecified Error',
            'description' => 'Transaction was sent and response received from mobile network operator that the transaction was unsuccessful and as such was cancelled by our system'
        ],
        '999' => [
            'code' => 999,
            'status' => 'NAVSC',
            'remark' => '',
            'description' => 'Invalide status code, this might be as a result of inablity to communicate with MegaSubPlug API Server.'
        ],
    ];
    private static $cache = [];

    private $object;

    private function __construct(array $statusCode)
    {
        $this->object = (object)$statusCode;
    }

    public function getCode(): int
    {
        return $this->object->code;
    }

    public function getStatus(): string
    {
        return strtoupper($this->object->status);
    }

    public function getRemark(): string
    {
        return strtoupper($this->object->remark);
    }

    public function getDescription(): string
    {
        return strtoupper($this->object->description);
    }

    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'status' => $this->getStatus(),
            'remark' => $this->getRemark(),
            'description' => $this->getDescription()
        ];
    }

    /**
     * @param $code
     * @return MegaSubPlugStatusCodeEnum|null
     */
    public static function getByCode($code): ?MegaSubPlugStatusCodeEnum
    {
        $code = trim($code);
        if (!key_exists($code, self::$statusCodes))
            self::$cache[$code] = new MegaSubPlugStatusCodeEnum(self::$statusCodes[999]);
        if (!key_exists($code, self::$cache))
            self::$cache[$code] = new MegaSubPlugStatusCodeEnum(self::$statusCodes[$code]);
        return self::$cache[$code];
    }

    /**
     * @param $status
     * @return MegaSubPlugStatusCodeEnum|null
     */
    public static function getStatusCode($status): ?MegaSubPlugStatusCodeEnum
    {
        $status = trim($status);
        if (!key_exists($status, self::$cache)) {
            $found = false;
            foreach (self::$statusCodes as $code => $statusCode) {
                if (($statusCode['status'] == $status) || ($statusCode['remark'] == $status)) {
                    self::$cache[$status] = new MegaSubPlugStatusCodeEnum($statusCode);
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                self::$cache[$status] = new MegaSubPlugStatusCodeEnum(self::$statusCodes[999]);
            }
        }
        return self::$cache[$status];
    }

    /**
     * @param $remark
     * @return MegaSubPlugStatusCodeEnum|null
     */
    public static function getByRemark($remark): ?MegaSubPlugStatusCodeEnum
    {
        $remark = trim($remark);
        if (!key_exists($remark, self::$cache)) {
            $found = false;
            foreach (self::$statusCodes as $code => $statusCode) {
                if ($statusCode['remark'] == $remark) {
                    self::$cache[$remark] = new MegaSubPlugStatusCodeEnum($statusCode);
                    $found = true;
                }
            }
            if (!$found) {
                self::$cache[$remark] = new MegaSubPlugStatusCodeEnum(self::$statusCodes[999]);
            }
        }
        return self::$cache[$remark];
    }

    public function __toString(): string
    {
        return print_r($this->toArray(), true);
    }

}
