<?php

use App\Models\User;
use App\Models\Order;
use PHPUnit\Metadata\Uses;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('code', 100)->unique();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->string('address', 255);
            $table->string('description', 255);
            $table->string('status')->default(Order::CHO_XAC_NHAN);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
