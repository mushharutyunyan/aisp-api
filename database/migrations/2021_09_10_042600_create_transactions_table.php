<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('transaction_id',75)->nullable(); // Remove nullable if requesting service needs to get it back
            $table->float('amount');
            $table->float('default_currency_amount')->nullable(); // NOT NULL when currency not DEFAULT
            $table->enum('currency',\App\Models\CurrencyEnum::toValues())->default(\App\Models\CurrencyEnum::GBP());
            $table->enum('type',\App\Models\TransactionTypeEnum::toValues());
            $table->enum('status',\App\Models\TransactionStatusEnum::toValues())->default(\App\Models\TransactionStatusEnum::PAID());
            $table->timestamp('datetime')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();

            $table->unique(array('client_id', 'amount','currency','type','datetime'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
