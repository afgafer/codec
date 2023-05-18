<?php

namespace App\Jobs;

use App\Models\Account;
use App\Services\PaymentService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateWalletSaldoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $accountNo = '';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($accountNo)
    {
        $this->accountNo = $accountNo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PaymentService $payServ)
    {
        $accountNo = $this->accountNo;
        $data = [
            'account_no' => $accountNo,
        ];
        $resp = $payServ->sendCheckBalance($data);
        $res = $resp->json();
        if($res['status'] === 1){
            $account = Account::find($this->accountNo);
            if($account){
                $account->balance = $res['balance'];
                $account->save();
            }
        }
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping($this->accountNo)];
    }

}
