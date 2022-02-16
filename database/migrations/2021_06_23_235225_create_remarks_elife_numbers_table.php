 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemarksElifeNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remarks_elife_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->integer('number_id')->nullable();
            $table->integer('userid')->nullable();
            $table->date('follow_date')->nullable();
            $table->string('remarks')->nullable();
            $table->string('other_remarks')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('remarks_elife_numbers');
    }
}
