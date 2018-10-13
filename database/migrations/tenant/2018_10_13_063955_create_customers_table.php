<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id')->nullable()->index();
            $table->unsignedInteger('pricing_group_id')->nullable()->index();
            $table->string('code')->nullable()->unique();
            $table->string('tax_identification_number')->nullable();
            $table->string('name');
            $table->text('notes')->nullable();
            $table->boolean('disabled')->default(false);
            $table->decimal('credit_ceiling', 65, 30)->default(0);
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
        Schema::dropIfExists('customers');
    }
}
