<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => \App\Models\User::ROLE_ADMIN,
            ]
        );

        $openai = \App\Models\AiVendor::updateOrCreate(
            ['key' => 'openai'],
            ['name' => 'OpenAI']
        );

        \App\Models\AiModel::updateOrCreate(
            ['key' => 'gpt-4o', 'ai_vendor_id' => $openai->id],
            ['name' => 'GPT-4o', 'model_key' => 'gpt-4o']
        );

        $gemini = \App\Models\AiVendor::updateOrCreate(
            ['key' => 'google'],
            ['name' => 'Google Gemini']
        );

        $gemini_model = \App\Models\AiModel::updateOrCreate(
            ['key' => 'gemini-1.5-pro', 'ai_vendor_id' => $gemini->id],
            ['name' => 'Gemini 1.5 Pro', 'model_key' => 'gemini-1.5-pro']
        );

        \App\Models\AiProvider::updateOrCreate(
            ['name' => 'Default Gemini'],
            [
                'ai_vendor_id' => $gemini->id,
                'ai_model_id' => $gemini_model->id,
                'is_default' => true,
                'system_prompt' => "Eres el asistente virtual de David Gómez Barragán, Ingeniero Civil con más de 30 años de experiencia. Tu objetivo es ayudar a los visitantes de su sitio web a conocer su trayectoria, formación y proyectos. Eres profesional, eficiente y conocedor del sector de la construcción en México. Responde siempre en español de manera cordial.",
            ]
        );
    }
}
