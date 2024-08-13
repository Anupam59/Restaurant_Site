<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_common', function (Blueprint $table) {
            $table->increments('site_common_id');
            $table->string('time_zone',100)->nullable();
            $table->string('site_name',100)->nullable();
            $table->string('site_email',100)->nullable();
            $table->string('site_contact',100)->nullable();

            $table->string('site_title',200)->nullable();
            $table->string('site_keyword',300)->nullable();
            $table->string('site_description',500)->nullable();

            $table->string('site_time',100)->nullable();

            $table->string('site_link',200)->nullable();
            $table->string('site_address',200)->nullable();

            $table->string('site_fb_link',300)->nullable();
            $table->string('site_tw_link',300)->nullable();
            $table->string('site_yt_link',300)->nullable();
            $table->string('site_ig_link',300)->nullable();
            $table->string('site_sp_link',300)->nullable();
            $table->string('site_ln_link',300)->nullable();

            $table->string('site_logo',100)->nullable();
            $table->string('site_logo_big',100)->nullable();
            $table->string('site_favicon',100)->nullable();
            $table->string('site_default_img',100)->nullable();

            $table->string('site_about_title',200)->nullable();
            $table->text('site_about_description')->nullable();
            $table->string('site_about_img',100)->nullable();

            $table->string('site_welcome_title',200)->nullable();
            $table->text('site_welcome_description')->nullable();
            $table->string('site_welcome_video',200)->nullable();

            $table->longText('site_map')->nullable();

            $table->tinyInteger('status')->default(1);
            $table->integer('creator');
            $table->integer('modifier');
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_common');
    }
};
