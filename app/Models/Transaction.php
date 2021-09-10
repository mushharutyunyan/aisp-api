<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class Transaction extends Model
{
    use HasFactory, HashableId;

    protected $hashColumnName = 'client_id';

    public function calculateSpendings($request)
    {
        //SELECT SUM(amount) as amount, type FROM `transactions`
        //WHERE client_id = 58
        //AND dateTime >= '2021-09-01T00:00:11.000000Z'
        //AND dateTime <= '2021-09-30T23:59:59.000000Z'
        //GROUP BY type
        $data = $request->all();
        $transactions = Transaction::selectRaw('SUM(amount) as amount, type')->where('client_id',$data['client_id']);
        if($request->has('start_date')) {
            $transactions = $transactions->where('dateTime','>=',Carbon::parse($data['start_date']));
        }
        if($request->has('end_date')) {
            $transactions = $transactions->where('dateTime','<=',Carbon::parse($data['end_date']));
        }
        return $transactions->groupBy('type')->pluck('amount','type')->toArray();
    }
}
