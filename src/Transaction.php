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

abstract class Transaction
{
    private $megaSup;

    /**
     * Transactions constructor.
     * @param MegaSubPlug $megaSup
     */
    public function __construct(MegaSubPlug $megaSup)
    {
        $this->megaSup = $megaSup;
    }


    /**
     * Get All Data Transactions
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function getAllDataTransaction(): MegaSubPlugResponse
    {
        return $this->megaSup->getRequest("?action=transaction_history");
    }

    /**
     * Query Transactions
     * @param string $txnType
     * @param int $txnId
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    private function queryTransaction(string $txnType, int $txnId): MegaSubPlugResponse
    {
        return $this->megaSup->getRequest("$txnType/$txnId");
    }

    /**
     * Query Data Transactions
     * @param int $txnId
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function queryDataTransaction(int $txnId): MegaSubPlugResponse
    {
        return $this->queryTransaction('data', $txnId);
    }

    /**
     * Query Airtime Transactions
     * @param int $txnId
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function queryAirtimeTransaction(int $txnId): MegaSubPlugResponse
    {
        return $this->queryTransaction('topup', $txnId);
    }

    /**
     * Query Bill Payment Transactions
     * @param int $txnId
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function queryElectricityBillTransaction(int $txnId): MegaSubPlugResponse
    {
        return $this->queryTransaction('billpayment', $txnId);
    }

    /**
     * Query Cable Subscription Transactions
     * @param int $txnId
     * @return MegaSubPlugResponse
     * @throws Exceptions\MegaSubPlugErrorException
     */
    public function queryCableTvTransaction(int $txnId): MegaSubPlugResponse
    {
        return $this->queryTransaction('cablesub', $txnId);
    }

}
