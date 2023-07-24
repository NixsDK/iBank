<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoAssetsTable extends Migration
{
    public function up(): void
    {
        Schema::create('crypto_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investment_account_id')->constrained()->cascadeOnDelete();
            $table->integer('crypto_currency_id');
            $table->string('name');
            $table->string('symbol');
            $table->decimal('quantity', 18, 8);
            $table->decimal('purchase_price', 18, 8);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crypto_assets');
    }
}
