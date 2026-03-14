<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('cart_items', 'size')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $table->string('size', 20)->nullable()->after('product_id');
            });
        }

        if (DB::getDriverName() === 'mysql') {
            $this->safeStatement('ALTER TABLE `cart_items` ADD INDEX `cart_items_cart_id_fk_idx` (`cart_id`)');
            $this->safeStatement('ALTER TABLE `cart_items` ADD INDEX `cart_items_product_id_fk_idx` (`product_id`)');

            $this->safeStatement('ALTER TABLE `cart_items` DROP INDEX `cart_items_cart_id_product_id_unique`');
            $this->safeStatement('ALTER TABLE `cart_items` ADD UNIQUE `cart_items_cart_id_product_id_size_unique` (`cart_id`,`product_id`,`size`)');
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            $this->safeStatement('ALTER TABLE `cart_items` DROP INDEX `cart_items_cart_id_product_id_size_unique`');
            $this->safeStatement('ALTER TABLE `cart_items` ADD UNIQUE `cart_items_cart_id_product_id_unique` (`cart_id`,`product_id`)');
        }

        if (Schema::hasColumn('cart_items', 'size')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }

        if (DB::getDriverName() === 'mysql') {
            $this->safeStatement('ALTER TABLE `cart_items` DROP INDEX `cart_items_cart_id_fk_idx`');
            $this->safeStatement('ALTER TABLE `cart_items` DROP INDEX `cart_items_product_id_fk_idx`');
        }
    }

    private function safeStatement(string $sql): void
    {
        try {
            DB::statement($sql);
        } catch (\Throwable $e) {
        }
    }
};
