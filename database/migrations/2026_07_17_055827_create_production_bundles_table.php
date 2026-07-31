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
        Schema::create('production_bundles', function (Blueprint $table) {
            $table->id();

            $table->string('bundle_no')->unique();

            $table->foreignId('buyer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('style_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('line_id')
                ->constrained('sewing_lines')
                ->cascadeOnDelete();

            $table->string('color');

            $table->string('size');

            $table->integer('quantity');

            $table->integer('completed_qty')->default(0);

            $table->integer('rejected_qty')->default(0);

            $table->string('operator_name');

            $table->date('production_date');

            $table->text('remarks')->nullable();

            $table->softDeletes();

            $table->timestamps();

            // Indexes

            $table->index('buyer_id');

            $table->index('style_id');

            $table->index('line_id');

            $table->index('production_date');

            $table->index('operator_name');

            $table->index('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_bundles');
    }
};
