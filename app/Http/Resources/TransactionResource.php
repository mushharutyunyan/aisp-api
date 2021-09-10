<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'client_hash' => Transaction::idToHash($this->client_id),
            'amount' => $this->amount,
            'type' => $this->type,
            'datetime' => $this->datetime ? Carbon::parse($this->datetime) : $this->created_at
        ];
    }
}
