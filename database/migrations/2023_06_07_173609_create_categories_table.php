<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        //méthod foreignIdFor permet de nommer automatiquement la clef étrangère et permet de simplifier la déclaration de colonne
        Schema::table('posts', function(Blueprint $table){
            $table->foreignIdFor(Category::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        //dans le cas je souhaite revenir arrière je supprime la cle etranger
        Schema::table('posts', function(Blueprint $table){
            $table->dropForeignIdFor(Category::class);
        });
    }
};
