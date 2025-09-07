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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id(); // auto_increment primary key
            $table->string('ip');
            $table->string('browser')->nullable();
            $table->string('platform')->nullable();
            $table->string('device')->nullable();
            $table->string('location')->nullable();
            $table->string('page')->nullable();
            $table->date('visit_date');
            $table->unsignedInteger('hit_count')->default(1); // Hanya default 1, jangan auto_increment
            $table->timestamps();

            $table->unique(['ip', 'page', 'visit_date'], 'unique_visitor_per_day'); // mencegah duplikat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
