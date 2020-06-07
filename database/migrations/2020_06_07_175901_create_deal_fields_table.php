<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_fields', function (Blueprint $table) {
            $table->increments('fields_id');
            $table->boolean('ID');
            $table->boolean('TITLE')->nullable();
            $table->boolean('TYPE_ID')->nullable();
            $table->boolean('STAGE_ID')->nullable();
            $table->boolean('PROBABILITY')->nullable();
            $table->boolean('CURRENCY_ID')->nullable();
            $table->boolean('OPPORTUNITY')->nullable();
            $table->boolean('IS_MANUAL_OPPORTUNITY')->nullable();
            $table->boolean('TAX_VALUE')->nullable();
            $table->boolean('LEAD_ID')->nullable();
            $table->boolean('COMPANY_ID')->nullable();
            $table->boolean('CONTACT_ID')->nullable();
            $table->boolean('QUOTE_ID')->nullable();
            $table->boolean('BEGINDATE')->nullable();
            $table->boolean('CLOSEDATE')->nullable();
            $table->boolean('ASSIGNED_BY_ID')->nullable();
            $table->boolean('CREATED_BY_ID')->nullable();
            $table->boolean('MODIFY_BY_ID')->nullable();
            $table->boolean('DATE_CREATE')->nullable();
            $table->boolean('DATE_MODIFY')->nullable();
            $table->boolean('OPENED')->nullable();
            $table->boolean('CLOSED')->nullable();
            $table->boolean('COMMENTS')->nullable();
            $table->boolean('ADDITIONAL_INFO')->nullable();
            $table->boolean('LOCATION_ID')->nullable();
            $table->boolean('CATEGORY_ID')->nullable();
            $table->boolean('STAGE_SEMANTIC_ID')->nullable();
            $table->boolean('IS_NEW')->nullable();
            $table->boolean('IS_RECURRING')->nullable();
            $table->boolean('IS_RETURN_CUSTOMER')->nullable();
            $table->boolean('IS_REPEATED_APPROACH')->nullable();
            $table->boolean('SOURCE_ID')->nullable();
            $table->boolean('SOURCE_DESCRIPTION')->nullable();
            $table->boolean('ORIGINATOR_ID')->nullable();
            $table->boolean('ORIGIN_ID')->nullable();
            $table->boolean('UTM_CAMPAIGN')->nullable();
            $table->boolean('UTM_CONTENT')->nullable();
            $table->boolean('UTM_SOURCE')->nullable();
            $table->boolean('UTM_TERM')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_fields');
    }
}
