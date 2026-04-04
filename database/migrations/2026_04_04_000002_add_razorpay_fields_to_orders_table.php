<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('orders', 'payment_status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('payment_status')->default('pending')->after('payment_method');
            });
        }

        if (!Schema::hasColumn('orders', 'payment_gateway_order_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('payment_gateway_order_id')->nullable()->after('payment_status');
            });
        }

        if (!Schema::hasColumn('orders', 'payment_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('payment_id')->nullable()->after('payment_gateway_order_id');
            });
        }

        if (!Schema::hasColumn('orders', 'payment_signature')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->text('payment_signature')->nullable()->after('payment_id');
            });
        }
    }

    public function down(): void
    {
        $columns = [
            'payment_status',
            'payment_gateway_order_id',
            'payment_id',
            'payment_signature',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('orders', $column)) {
                Schema::table('orders', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
