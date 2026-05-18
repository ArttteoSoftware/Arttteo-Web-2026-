<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete()->after('id');
        });

        $pageNames = DB::table('faqs')->whereNotNull('page')->distinct()->pluck('page');
        foreach ($pageNames as $name) {
            $pageId = DB::table('pages')->insertGetId([
                'name' => $name,
                'ordering' => 0,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('faqs')->where('page', $name)->update(['page_id' => $pageId]);
        }

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('page');
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('page')->nullable()->after('id');
        });

        $faqs = DB::table('faqs')->whereNotNull('page_id')->get();
        foreach ($faqs as $faq) {
            $page = DB::table('pages')->find($faq->page_id);
            if ($page) {
                DB::table('faqs')->where('id', $faq->id)->update(['page' => $page->name]);
            }
        }

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropForeign(['page_id']);
            $table->dropColumn('page_id');
        });
    }
};
