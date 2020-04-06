<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faqs', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('question');
			$table->text('answer')->nullable();
			$table->unsignedBigInteger('order')->nullable();
			$table->boolean('is_public')->nullable()->default(true);
			$table->integer('faq_category_id')->nullable()->index('faq_category_id');
			$table->unsignedSmallInteger('likes')->default(0);
			$table->unsignedSmallInteger('dislikes')->default(0);
			$table->timestamps();
			//$table->index(['question','answer'], 'qa');
		});

        DB::statement('ALTER TABLE faqs ADD FULLTEXT INDEX `qa` (question, answer)');

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('faqs');
	}
}
