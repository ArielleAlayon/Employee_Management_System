<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees_tbl', function (Blueprint $table) {
            // First, drop the existing foreign key constraint
            $table->dropForeign(['department_id']);
            
            // Make the column nullable
            $table->foreignId('department_id')->nullable()->change();
            
            // Re-add the foreign key constraint with nullable
            $table->foreign('department_id')->references('id')->on('departments_tbl')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees_tbl', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->foreignId('department_id')->nullable(false)->change();
            $table->foreign('department_id')->references('id')->on('departments_tbl')->onDelete('cascade');
        });
    }
};
