<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Tidak perlu mengubah nama kolom karena kolom sudah bernama 'logo' dari awal
        // Migrasi ini tidak melakukan apa-apa
    }

    public function down()
    {
        // Tidak ada yang perlu dirollback
    }
};
