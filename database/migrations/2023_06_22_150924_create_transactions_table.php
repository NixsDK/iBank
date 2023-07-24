<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_account_id')->constrained('bank_accounts')->cascadeOnDelete();
            $table->foreignId('receiver_account_id')->constrained('bank_accounts')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->timestamp('completed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}
