<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('results', function (Blueprint $table) {

            $table->string('pdf_path')->nullable();

            $table->timestamp('email_sent_at')->nullable();

            $table->enum('email_status', [
                'pending',
                'sent',
                'failed'
            ])->default('pending');

        });
    }

    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {

            $table->dropColumn([
                'pdf_path',
                'email_sent_at',
                'email_status'
            ]);

        });
    }
};
