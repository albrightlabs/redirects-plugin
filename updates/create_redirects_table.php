<?php namespace Albrightlabs\Redirects\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateRedirectsTable Migration
 */
class CreateRedirectsTable extends Migration
{
    public function up()
    {
        Schema::create('albrightlabs_redirects_redirects', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('url_from')->nullable();
            $table->text('url_to')->nullable();
            $table->text('note')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('albrightlabs_redirects_redirects');
    }
}
