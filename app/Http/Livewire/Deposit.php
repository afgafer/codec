<?php

namespace App\Http\Livewire;

use App\Jobs\UpdateWalletSaldoJob;
use App\Models\Deposit as Deposits;
use App\Models\Withdrawal;
use App\Services\PaymentService;
use Livewire\Component;

class Deposit extends Component
{
    public $order_id, $amount, $account_no;
    protected $rules = [
        'account_no' => 'required',
        'order_id' => 'required',
        'amount' => 'required',
    ];

    public $search = '';
    public $deposits = [];
    public $withdrawals = [];

    public function render()
    {
        $this->deposits = Deposits::where('order_id', 'ilike', '%'.$this->search.'%')->get();
        $this->withdrawals = Withdrawal::where('order_id', 'ilike', '%'.$this->search.'%')->get();
        return view('livewire.deposit');
    }

    public function sendDeposit(PaymentService $payServ){
        $accountNo = $this->account_no;
        $data = [
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'timestamp' => date('Y-m-d H:i:s'),
        ];
        $res = $payServ->sendDeposit($data);
        if($res['status'] === 1){
            $deposit = new Deposits();
            $deposit->account_no = $accountNo;
            $deposit->order_id = $data['order_id'];
            $deposit->amount = $data['amount'];
            $deposit->created_at = $data['timestamp'];
            $deposit->status = $res['status'];
            $deposit->save();
            UpdateWalletSaldoJob::dispatch($accountNo);
            session()->flash('message', 'Deposit success');
        }else{
            session()->flash('message', 'Deposit failed');
        }
    }

    public function sendWithdrawal(PaymentService $payServ){
        $accountNo = $this->account_no;
        $data = [
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'timestamp' => date('Y-m-d H:i:s'),
        ];
        $res = $payServ->sendWithdrawal($data);
        if($res['status'] === 1){
            $withdrawal = new Withdrawal();
            $withdrawal->account_no = $accountNo;
            $withdrawal->order_id = $data['order_id'];
            $withdrawal->amount = $data['amount'];
            $withdrawal->created_at = $data['timestamp'];
            $withdrawal->status = $res['status'];
            $withdrawal->save();
            UpdateWalletSaldoJob::dispatch($accountNo);
            session()->flash('message', 'Deposit success');
        }else{
            session()->flash('message', 'Deposit failed');
        }
    }
        
}
