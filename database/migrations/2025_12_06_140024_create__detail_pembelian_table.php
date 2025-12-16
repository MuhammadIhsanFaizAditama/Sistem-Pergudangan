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
        Schema::create('_detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_beli');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);

            $table->foreignId('pembelian_id')->constrained('_pembelian')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('_barang_table')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_detail_pembelian');
    }
};
