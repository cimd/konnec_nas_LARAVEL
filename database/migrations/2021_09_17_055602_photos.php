<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use SoftDeletes;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path')->index()->nullable();
            $table->string('filename')->index();
            $table->integer('size')->index();
            $table->timestamp('last_modified');
            $table->timestamp('date_taken')->nullable();

            $table->string('sort_title')->index()->nullable();
            // $table->string('comments')->nullable();
            // $table->string('rating')->index()->nullable();
            $table->string('albums')->index()->default('[]')->nullable();
            // $table->text('tags')->index()->default('[]')->nullable();

            $table->timestamp('last_scan')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
