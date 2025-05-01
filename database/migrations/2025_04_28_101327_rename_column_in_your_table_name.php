<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('addresses')) {
            Schema::table('addresses', function (Blueprint $table) {
                if (Schema::hasColumn('addresses', 'country')) {
                    $table->renameColumn('country', 'description');
                }
                if (Schema::hasColumn('addresses', 'state')) {
                    $table->renameColumn('state', 'province');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('addresses')) {
            Schema::table('addresses', function (Blueprint $table) {
                if (Schema::hasColumn('addresses', 'description')) {
                    $table->renameColumn('description', 'country');
                }
                if (Schema::hasColumn('addresses', 'province')) {
                    $table->renameColumn('province', 'state');
                }
            });
        }
    }
};
