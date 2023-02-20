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
    public function up(): void
    {
        Schema::create('d_s_divisions', function (Blueprint $table) {
            $table->id('division_id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        $data = [
            ['name' => 'Colombo 1', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Colombo 2', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Colombo 3', 'created_at' => date('Y-m-d H:i:s')],
        ];

        DB::table('d_s_divisions')->insert($data);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_s_divisions');
    }
};
