<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $project = Project::create([
            'title' => 'SolarSaver - Community Solar Energy Initiative',
            'description' => 'SolarSaver is a community-driven solar energy project aimed at reducing electricity costs and promoting sustainability. By installing solar panels in residential and commercial areas, the project enables communities to generate renewable energy while benefiting from lower utility bills. The initiative focuses on affordable solar solutions, expert installation, and ongoing maintenance to maximize energy savings for participants.',
            'user_id' => '1'
        ]);
        $project->image_urls()->create([
            'image_url' => 'images/projects/1_1.jpeg',
            'project_id' => $project->id,
        ]);
        $project->categories()->sync([1, 2]);
    }
}
