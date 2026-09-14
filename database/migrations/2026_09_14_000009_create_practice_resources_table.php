<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void { Schema::create('practice_resources', function (Blueprint $table) { $table->id(); $table->string('title'); $table->string('type')->default('video'); $table->string('media_url'); $table->text('description')->nullable(); $table->boolean('is_published')->default(false); $table->timestamps(); }); }
    public function down(): void { Schema::dropIfExists('practice_resources'); }
};
