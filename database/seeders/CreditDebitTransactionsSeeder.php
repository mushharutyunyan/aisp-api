<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreditDebitTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = Carbon::parse('2021-08-31 00:00:01');
        $clientID = 58;

        // for one month
        for($i = 1; $i <= 31; $i++) {
            $startDate = Carbon::parse(Carbon::parse($startDate->addDay())->format('Y-m-d').' 00:00:01');

            // 50 transaction per day
            for($j = 1; $j <= 50; $j++) {
                // Transaction per 2 minute
                $dateTime = $startDate->addMinutes(2);

                // 25 debit | 25 credit
                $type = 'credit';
                if($j <= 25) {
                    $type = 'debit';
                }

                $transaction = new Transaction();
                $transaction->type = $type;
                $transaction->client_id = $clientID;
                $transaction->dateTime = $dateTime;
                $transaction->transaction_id = $this->generateRandomString(15);
                $transaction->amount = rand(100,45000);
                $transaction->save();
            }
        }
    }

    public function generateRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
