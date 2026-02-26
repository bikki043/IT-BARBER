<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // เพิ่มคอลัมน์เก็บ ID จาก Google
            $table->string('google_id')->nullable()->after('id');
            // ปรับให้ password เป็น null ได้ (กรณีสมัครผ่าน Google)
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
