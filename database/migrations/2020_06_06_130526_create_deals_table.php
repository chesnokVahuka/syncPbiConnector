<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->unsignedBigInteger('ID')->unique();
            $table->string('TITLE')->nullable();
            $table->string('TYPE_ID')->nullable();
            $table->string('STAGE_ID')->nullable();
            $table->integer('PROBABILITY')->nullable();
            $table->string('CURRENCY_ID')->nullable();
            $table->integer('OPPORTUNITY')->nullable();
            $table->boolean('IS_MANUAL_OPPORTUNITY')->nullable();
            $table->boolean('TAX_VALUE')->nullable();
            $table->unsignedBigInteger('LEAD_ID')->nullable();
            $table->unsignedBigInteger('COMPANY_ID')->nullable();
            $table->unsignedBigInteger('CONTACT_ID')->nullable();
            $table->unsignedBigInteger('QUOTE_ID')->nullable();
            $table->timestampTz('BEGINDATE')->nullable();
            $table->timestampTz('CLOSEDATE')->nullable();
            $table->unsignedBigInteger('ASSIGNED_BY_ID')->nullable();
            $table->unsignedBigInteger('CREATED_BY_ID')->nullable();
            $table->unsignedBigInteger('MODIFY_BY_ID')->nullable();
            $table->timestampTz('DATE_CREATE')->nullable();
            $table->timestampTz('DATE_MODIFY')->nullable();
            $table->boolean('OPENED')->nullable();
            $table->boolean('CLOSED')->nullable();
            $table->mediumText('COMMENTS')->nullable();
            $table->mediumText('ADDITIONAL_INFO')->nullable();
            $table->unsignedBigInteger('LOCATION_ID')->nullable();
            $table->unsignedBigInteger('CATEGORY_ID')->nullable();
            $table->string('STAGE_SEMANTIC_ID')->nullable();
            $table->boolean('IS_NEW')->nullable();
            $table->boolean('IS_RECURRING')->nullable();
            $table->boolean('IS_RETURN_CUSTOMER')->nullable();
            $table->boolean('IS_REPEATED_APPROACH')->nullable();
            $table->unsignedBigInteger('SOURCE_ID')->nullable();
            $table->string('SOURCE_DESCRIPTION')->nullable();
            $table->unsignedBigInteger('ORIGINATOR_ID')->nullable();
            $table->unsignedBigInteger('ORIGIN_ID')->nullable();
            $table->mediumText('UTM_CAMPAIGN')->nullable();
            $table->mediumText('UTM_CONTENT')->nullable();
            $table->mediumText('UTM_SOURCE')->nullable();
            $table->mediumText('UTM_TERM')->nullable();
            $table->mediumText('UTM_MEDIUM')->nullable();

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
