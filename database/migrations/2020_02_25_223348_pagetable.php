<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Page;
class Pagetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_name');
            $table->longText('page_html',65535);
            $table->timestamps();
            $table->softDeletes();
        });


             // Every time we make the table, make the admin user.
             $page = new Page();
             $page->page_name = "about";
             $page->page_html = "<h1>About Page</h1>";
             $page->save();
         }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
