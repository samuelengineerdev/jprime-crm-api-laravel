<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    { 
        DB::statement('RENAME TABLE sale_items TO sale_products');
    }

    public function down()
    {
        DB::statement('RENAME TABLE sale_products TO sale_items');
    }
};
