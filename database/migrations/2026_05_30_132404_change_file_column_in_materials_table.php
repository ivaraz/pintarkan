<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->json('files')->nullable()->after('title');
        });

        // Migrate existing 'file' to 'files'
        $materials = DB::table('materials')->whereNotNull('file')->get();
        foreach ($materials as $material) {
            DB::table('materials')->where('id', $material->id)->update([
                'files' => json_encode([$material->file])
            ]);
        }

        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->string('file')->nullable()->after('title');
        });

        // Migrate back
        $materials = DB::table('materials')->whereNotNull('files')->get();
        foreach ($materials as $material) {
            $files = json_decode($material->files, true);
            if (!empty($files)) {
                DB::table('materials')->where('id', $material->id)->update([
                    'file' => $files[0]
                ]);
            }
        }

        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('files');
        });
    }
};
