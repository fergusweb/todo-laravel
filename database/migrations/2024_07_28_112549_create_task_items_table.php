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
        Schema::create('task_items', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('task_id');
            //$table->foreign('task_id')->references('id')->on('tasks');
            $table->foreignIdFor(\App\Models\Task::class);
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->timestamp('completed_at', precision: 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_items');
    }
};
