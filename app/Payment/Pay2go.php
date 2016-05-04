<?php

namespace App\Payment;

use App\Booking;
use Illuminate\Http\Request;

class Pay2Go
{
    protected $version = 1.2;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function pay()
    {
        $timestamp = time();

        $attributes = [
            'MerchantID' => env('PAY2GO_MERCHANT_ID'),
            'RespondType' => 'JSON',
            'CheckValue' => $this->getCheckValue($timestamp),
            'TimeStamp' => $timestamp,
            'Version' => $this->version,
            'MerchantOrderNo' => $this->booking->id,
            'Amt' => $this->booking->room->price,
            'ItemDesc' => "{$this->booking->date} - {$this->booking->room->name}",
            'Email' => $this->booking->email,
            'LoginType' => 0,
            'ReturnURL' => $this->getUrl('return'),
            'CustomerURL' => $this->getUrl('customer'),
            'NotifyURL' => $this->getUrl('notify'),
        ];

        $this->booking->logs()->create([
            'type' => 'request',
            'data' => $attributes,
        ]);

        return $attributes;
    }

    public function callback(Request $request)
    {
        $request = $this->processRequest($request);

        $this->booking->logs()->create([
            'type' => 'callback',
            'data' => $request,
        ]);

        $this->guard($request);

        $this->booking->update([
            'status' => Booking::RESERVED,
            'trade' => $request->Result->TradeNo,
        ]);
    }

    public function customer(Request $request)
    {
        $request = $this->processRequest($request);

        $this->booking->logs()->create([
            'type' => 'customer',
            'data' => $request,
        ]);

        $this->guard($request);

        $this->booking->update([
            'trade' => $request->Result->TradeNo,
        ]);
    }

    public function notify(Request $request)
    {
        $request = $this->processRequest($request);

        $this->booking->logs()->create([
            'type' => 'notify',
            'data' => $request,
        ]);

        $this->guard($request);

        $this->booking->update([
            'status' => Booking::RESERVED,
        ]);
    }

    protected function processRequest(Request $request)
    {
        $request->JSONData = json_decode($request->JSONData);
        $request->JSONData->Result = json_decode($request->JSONData->Result);

        return $request->JSONData;
    }

    protected function guard($request)
    {
        $check = $this->verifyCheckCode($request->Result);

        if (! $check) {
            throw new PaymentException('Verify error.');
        }

        if ($request->Status != 'SUCCESS') {
            throw new PaymentException($request->Message);
        }

        return $this;
    }

    protected function getCheckValue($timestamp)
    {
        return strtoupper(hash('sha256', http_build_query([
            'HashKey' => env('PAY2GO_HASH_KEY'),
            'Amt' => $this->booking->room->price,
            'MerchantID' => env('PAY2GO_MERCHANT_ID'),
            'MerchantOrderNo' => $this->booking->id,
            'TimeStamp' => $timestamp,
            'Version' => $this->version,
            'HashIV' => env('PAY2GO_HASH_IV'),
        ])));
    }

    protected function verifyCheckCode($data)
    {
        return strtoupper(hash('sha256', http_build_query([
            'HashIV' => env('PAY2GO_HASH_IV'),
            'Amt' => $data->Amt,
            'MerchantID' => $data->MerchantID,
            'MerchantOrderNo' => $data->MerchantOrderNo,
            'TradeNo' => $data->TradeNo,
            'HashKey' => env('PAY2GO_HASH_KEY'),
        ]))) === $data->CheckCode;
    }

    protected function getHashid()
    {
        return app('hashids')->encode($this->booking->id);
    }

    protected function getUrl($type)
    {
        $url = [
            'return' => 'payment/%s',
            'customer' => 'payment/%s/customer',
            'notify' => 'payment/%s/notify',
        ];

        return url(sprintf($url[$type], $this->getHashid()));
    }
}
