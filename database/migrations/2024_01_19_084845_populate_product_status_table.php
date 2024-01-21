<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $data = [
            ['id' => 1, 'name'=> 'In Stock'],
            ['id' => 2, 'name'=> 'Out of Stock (Can reorder)'],
            ['id' => 3, 'name'=> 'Out of Stock (Discontinued)']
        ];        

        DB::table('product_statuses')->insert($data); // Query Builder approach
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('product_status')->whereIn('id', [1,2,3])->delete(); 
    }
};
