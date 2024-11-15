<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('bid_no');
            $table->longText('work');
            $table->string('tender_id');
            $table->string('city');
            $table->string('state');
            $table->string('department');
            $table->text('emd_exemption')->nullable();
            $table->text('mse_exemption')->nullable();
            $table->string('tender_value')->nullable();
            $table->string('tender_emd')->nullable();
            $table->decimal('tender_fee', 10, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('tender_open')->nullable();
            $table->text('document_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenders');
    }
}
