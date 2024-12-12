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
        // $project = Project::create([
        //     'title' => 'SolarSaver - Community Solar Energy Initiative',
        //     'description' => 'SolarSaver is a community-driven solar energy project aimed at reducing electricity costs and promoting sustainability. By installing solar panels in residential and commercial areas, the project enables communities to generate renewable energy while benefiting from lower utility bills. The initiative focuses on affordable solar solutions, expert installation, and ongoing maintenance to maximize energy savings for participants.',
        //     'user_id' => '1'
        // ]);
        // $project->image_urls()->create([
        //     'image_url' => 'images/projects/1_1.jpeg',
        //     'project_id' => $project->id,
        // ]);
        // $project->categories()->sync([1, 2]);
        $projects = [
            [
                'title' => 'EcoHaven - Urban Green Spaces Revival Project',
                'description' => 'EcoHaven is an urban renewal initiative focused on revitalizing green spaces in densely populated cities. By transforming underutilized areas into vibrant parks, community gardens, and urban forests, the project aims to improve air quality, reduce urban heat, and foster social cohesion.
The initiative involves engaging local communities to co-create green spaces that meet their needs, such as playgrounds, walking trails, and outdoor fitness areas. EcoHaven also integrates sustainable landscaping practices, including native plant species and rainwater harvesting systems.
The project emphasizes education, hosting workshops on urban farming, composting, and ecological conservation. Over time, EcoHaven aims to create a network of interconnected green spaces, forming ecological corridors that enhance biodiversity in urban environments.'
            ],
            [
                'title' => 'AquaPure - Clean Water for All Initiative',
                'description' => 'AquaPure is dedicated to addressing the global water crisis by providing clean and safe drinking water to underserved communities. The initiative combines innovative filtration technology with community-driven solutions to tackle water scarcity and contamination.
Through partnerships with NGOs and local governments, AquaPure installs water purification systems in schools, clinics, and public spaces. The project also includes mobile water testing labs, empowering communities to monitor water quality and address issues proactively.
Educational campaigns are a cornerstone of AquaPure, teaching families about sanitation, hygiene, and water conservation. By promoting sustainable water management practices, AquaPure not only improves public health but also builds resilience against climate change-induced water challenges.'
            ],
            [
                'title' => 'SolarCycle - Circular Economy for Solar Panels',
                'description' => 'SolarCycle pioneers a circular economy approach to managing solar panel waste, ensuring that renewable energy remains truly sustainable. The project focuses on recycling, repurposing, and refurbishing solar panels at the end of their lifecycle.
Through state-of-the-art recycling facilities, SolarCycle recovers valuable materials like silicon, silver, and aluminum from discarded panels. These materials are then reintroduced into the supply chain, reducing the need for raw resource extraction.
SolarCycle also collaborates with manufacturers to design panels with recyclability in mind, promoting a cradle-to-cradle approach. Public awareness campaigns highlight the importance of responsible solar panel disposal, encouraging users to participate in the recycling process.'
            ],
            [
                'title' => 'FarmConnect - Smart Agriculture for Small Farmers',
                'description' => 'FarmConnect is a digital platform that empowers small farmers with data-driven insights to optimize their agricultural practices. By integrating IoT devices, satellite imagery, and AI-powered analytics, FarmConnect enables farmers to monitor soil health, weather conditions, and crop growth in real time.
The platform offers personalized recommendations for irrigation, fertilization, and pest management, maximizing yields while minimizing environmental impact. Farmers can also access online marketplaces through FarmConnect, connecting them directly with buyers to secure fair prices for their produce.

FarmConnect emphasizes capacity building, offering training programs on digital literacy and sustainable farming techniques. By bridging the gap between technology and traditional agriculture, FarmConnect helps farmers increase productivity and resilience.'
            ],
            [
                'title' => 'CleanWave - Coastal Cleanup and Marine Conservation',
                'description' => 'CleanWave is a marine conservation project dedicated to protecting coastal ecosystems from pollution and degradation. The initiative organizes large-scale cleanup drives, removing plastic waste and debris from beaches and waterways.
Beyond cleanup efforts, CleanWave works to restore marine habitats, such as coral reefs and mangroves, which are critical for biodiversity and coastal protection. The project also engages local communities in conservation activities, fostering a sense of stewardship for their coastal environments.
Educational programs are a key component, teaching participants about the impacts of plastic pollution and the importance of sustainable practices. CleanWave advocates for policy changes to reduce single-use plastics and promote eco-friendly alternatives, creating a lasting impact on marine conservation efforts.'
            ],
        ];
        $imageNumber = 1;
        foreach ($projects as $data) {
            $project = Project::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => 1,
            ]);

            $project->image_urls()->create([
                'image_url' => 'images/projects/' . $imageNumber . '_1.jpeg',
            ]);

            $imageNumber++;

            $project->categories()->sync([1, 2]);
        }
    }
}
