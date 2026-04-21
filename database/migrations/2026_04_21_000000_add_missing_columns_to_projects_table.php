<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Add missing columns only if they don't exist
            if (!Schema::hasColumn('projects', 'type')) {
                $table->string('type')->default('project')->after('description');
            }
            if (!Schema::hasColumn('projects', 'status')) {
                $table->string('status')->default('ongoing')->after('type');
            }
            if (!Schema::hasColumn('projects', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('status');
            }
            if (!Schema::hasColumn('projects', 'url')) {
                $table->string('url')->nullable()->after('is_featured');
            }
            if (!Schema::hasColumn('projects', 'image_path')) {
                $table->string('image_path')->nullable()->after('url');
            }
        });

        // Migrate data from 'link' to 'url' if 'link' exists and 'url' exists
        if (Schema::hasColumn('projects', 'link') && Schema::hasColumn('projects', 'url')) {
            DB::table('projects')->update([
                'url' => DB::raw('link')
            ]);

            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('link');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'link')) {
                $table->string('link')->nullable();
            }
        });

        if (Schema::hasColumn('projects', 'url') && Schema::hasColumn('projects', 'link')) {
            DB::table('projects')->update([
                'link' => DB::raw('url')
            ]);
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['type', 'status', 'is_featured', 'url', 'image_path']);
        });
    }
};
