<?php

use App\Services\CheckDomains\DomainCheckStatus;
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
        Schema::create('domain_check_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('domain_id');
            $table->enum('status', [array_column(DomainCheckStatus::cases(), 'value')])->default(DomainCheckStatus::STARTED);
            $table->integer('code')->nullable();
            $table->integer('content_size')->default(0);
            $table->text('error');
            $table->timestamps();
            $table->index(['domain_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_check_log');
    }
};
