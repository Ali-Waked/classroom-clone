<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class HadaraSms
{
    protected $baseUrl = 'http://smsservice.hadara.ps:4545/SMS.ashx/bulkservice/sessionvalue';
    public function __construct(protected string $key)
    {
        //
    }
    public function send(string $to, string $message)
    {
        $response = Http::baseUrl($this->baseUrl)->get('sendmassge', [
            'apikey' => $this->key,
            'to' => $to,
            'msg' => $message,
        ]);
    }
}
