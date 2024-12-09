<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            'positive' => [
                'This project is fantastic! Really impactful.',
                'Amazing initiative. Keep up the great work!',
                'This is exactly what the community needs!',
                'Well thought-out and executed project.',
                'Impressive! Inspiring work!'
            ],
            'negative' => [
                'This project lacks clear goals.',
                'The approach seems impractical for real-world scenarios.',
                'Needs more community involvement to be effective.',
                'Budget constraints could be a major hurdle here.',
                'Not enough data to back up the claims.'
            ]
        ];

        $projects = Project::all();
        $users = User::all();

        foreach ($projects as $project) {
            $usersWhoCommented = [];

            for ($i = 0; $i < min(5, $users->count()); $i++) {
                $availableUsers = $users->whereNotIn('id', $usersWhoCommented);
                $sender = $availableUsers->random();

                $type = rand(0, 1) ? 'positive' : 'negative';
                $comment = $comments[$type][array_rand($comments[$type])];

                Comment::create([
                    'sender_id' => $sender->id,
                    'project_id' => $project->id,
                    'comment' => $comment,
                    'type' => $type,
                ]);

                $usersWhoCommented[] = $sender->id;
            }
        }
    }
}
