<div class="container">
    <h3>Deposit</h3>
    <input type="serch" wire:model="search" placeholder="Cari" class="form-control">
    <table class="table table-striped">
        <tr>
            <th>Account</th>
            <th>Order Id</th>
            <th>Amount</th>
            <th align="left">Date</th>
            <th>Status</th>
        </tr>
        @foreach($deposits as $deposit)
        <tr>
            <td>{{$deposit->account_no}}</td>
            <td>{{$deposit->order_id}}</td>
            <td>{{$deposit->amount}}</td>
            <td>{{$deposit->created_at}}</td>
            <td>{{$deposit->status}}</td>
        </tr>
        @endforeach
    </table>
    <h3>Withdrawal</h3>
    <table class="table table-striped">
        <tr>
            <th>Account</th>
            <th>Order Id</th>
            <th>Amount</th>
            <th align="left">Date</th>
            <th>Status</th>
        </tr>
        @foreach($withdrawals as $withdrawal)
        <tr>
            <td>{{$withdrawal->account_no}}</td>
            <td>{{$withdrawal->order_id}}</td>
            <td>{{$withdrawal->amount}}</td>
            <td>{{$withdrawal->created_at}}</td>
            <td>{{$withdrawal->status}}</td>
        </tr>
        @endforeach
    </table>
    <h3>Form</h3>
    @if(session()->has('message'))
    <div class="alert alert-info" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <form>
                <div class="form-group">
                    <label for="account_no">Account Number</label>
                    <input type="text" wire:model="account_no" placeholder="Account Number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="order_id">Order Number</label>
                    <input type="text" wire:model="order_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" wire:model="amount" class="form-control">
                </div>
                <div class="form-group">
                    <button wire:click.prevent="sendDeposit()" class="btn btn-success btn-block">Deposit</button>
                    <button wire:click.prevent="sendWithdrawal()" class="btn btn-success btn-block">Withdrawal</button>
                </div>
            </form>
        </div>
    </div>
</div>
