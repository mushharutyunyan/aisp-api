<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditDebitRequest;
use App\Http\Requests\ThresholdRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\TransactionTypeEnum;
use Spatie\Enum\Laravel\Rules\EnumRule;

class TransactionsController extends Controller
{
    public function creditDebit(CreditDebitRequest $request, $type)
    {
        // Validate type
        $typeRule = new EnumRule(TransactionTypeEnum::class);
        $typeValidated = $typeRule->passes('type', $type);
        if (!$typeValidated) {
            $errors['type'] = ['This request cannot be reached'];
            return response()->json($this->_buildErrorResponse('Something went wrong...', $errors), 500);
        }

        // depending on the number of requests, this functionality must be transferred to QUEUES / JOBS
        $data = $request->all();
        $transaction = new Transaction();
        $transaction->client_id = $data['client_id'];
        $transaction->amount = $data['amount'];
        $transaction->type = $type;
        if ($request->has('datetime')) {
            $transaction->datetime = $data['datetime'];
        }
        try {
            $transaction->save();
        } catch (\Exception $exception) {
            $errors['request'] = ['Row is already saved in database.'];
            return response()->json($this->_buildErrorResponse('Access restrict.', $errors), 403);
        }

        return new TransactionResource($transaction);
    }

    public function threshold(ThresholdRequest $request)
    {
        $data = $request->all();

        if(!Transaction::where('client_id',$data['client_id'])->count()) {
            $errors['user'] = [''];
            return response()->json($this->_buildErrorResponse('User not found', $errors), 404);
        }
        $transactionModel = new Transaction();
        $transactionsSpendingRequest = $transactionModel->calculateSpendings($request);

        if(empty($transactionsSpendingRequest)) {
            $errors['transactions'] = [''];
            return response()->json($this->_buildErrorResponse('Transactions in this threshold are missed', $errors), 404);
        }
        $overspendingAmount = $transactionsSpendingRequest['DEBIT'] - $transactionsSpendingRequest['CREDIT'];
        return response()->json([
            'data' => [
                'client_id' => $data['client_id'],
                'overspending' => $overspendingAmount > 0 ? true : false,
                'debit' => $transactionsSpendingRequest['DEBIT'],
                'credit' => $transactionsSpendingRequest['CREDIT'],
                'amount' => $overspendingAmount < 0 ? abs($overspendingAmount) : $overspendingAmount
                // There can be added max debit transaction, if overspending == true
            ]
        ]);
    }

    private function _buildErrorResponse($message, $errors)
    {
        return [
            'message' => $message,
            'errors' => $errors,
        ];
    }
}
