<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $projects = $query->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($project) {
                if ($project->image_path && !str_starts_with($project->image_path, 'http')) {
                    $project->image_path = Storage::disk('public')->url($project->image_path);
                }
                return $project;
            });

        return response()->json($projects);
    }
}
