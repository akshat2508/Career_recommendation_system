<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('recommendations', function (Blueprint $table) {
        $table->text('why_fit')->nullable();
    });
}

public function down()
{
    Schema::table('recommendations', function (Blueprint $table) {
        $table->dropColumn('why_fit');
    });
}
};
