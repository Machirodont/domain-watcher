<?php

use App\Services\CheckDomains\DomainStatus;
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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('group_id');
            $table->integer('check_rate');
            $table->enum('status', [array_column(DomainStatus::cases(), 'value')])->default(DomainStatus::UNCHECKED);
            $table->dateTime('last_check_at')->nullable();
            $table->dateTime('offline_since')->nullable();
            $table->timestamps();
            $table->index('group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
