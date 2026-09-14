<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::create('x_posts', function(Blueprint $table){ $table->id(); $table->string('tweet_id')->unique(); $table->text('text'); $table->text('url'); $table->string('author_username')->nullable(); $table->json('media')->nullable(); $table->timestamp('published_at')->nullable(); $table->timestamps(); }); }
 public function down(): void { Schema::dropIfExists('x_posts'); }
};
