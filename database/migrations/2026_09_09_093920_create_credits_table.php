<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['client', 'fournisseur']); // à qui appartient le crédit
            $table->string('tiers_nom'); // nom du client ou du fournisseur
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete(); // rempli seulement si type = client
            $table->decimal('montant', 12, 2); // montant total du crédit
            $table->decimal('montant_paye', 12, 2)->default(0); // ce qui a déjà été remboursé
            $table->date('date_credit'); // date à laquelle le crédit a été donné/pris
            $table->date('date_echeance'); // date à laquelle il doit être remboursé
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};