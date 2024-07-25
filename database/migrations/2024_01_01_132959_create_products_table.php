
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('sideImage1')->nullable();
            $table->string('sideImage2')->nullable();
            $table->string('arthur');
            $table->string('main_category_name');
            $table->string('category_name');
            $table->string('reading_guide');
            $table->string('price');
            $table->longText('description');
            $table->integer('pages');
            $table->string('size');
            $table->string('print_record');
            $table->integer('in_stock');
            $table->string('editor_choice');
            $table->string('classic');
            $table->string('reward');
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
