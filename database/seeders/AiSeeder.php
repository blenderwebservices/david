<?php

namespace Database\Seeders;

use App\Models\AiModel;
use App\Models\AiProvider;
use App\Models\AiVendor;
use Illuminate\Database\Seeder;

class AiSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = [
            ['name' => 'Google Gemini', 'key' => 'gemini'],
            ['name' => 'OpenAI', 'key' => 'openai'],
            ['name' => 'Anthropic', 'key' => 'anthropic'],
        ];

        foreach ($vendors as $vendorData) {
            $vendor = AiVendor::create($vendorData);

            if ($vendor->key === 'gemini') {
                $lite = AiModel::create([
                    'ai_vendor_id' => $vendor->id,
                    'name' => 'Gemini 2.5 Flash Lite',
                    'key' => 'gemini-2.5-flash-lite',
                    'model_key' => 'gemini-2.0-flash-lite-preview-02-05',
                ]);
                
                AiModel::create([
                    'ai_vendor_id' => $vendor->id,
                    'name' => 'Gemini 2.0 Flash',
                    'key' => 'gemini-2.0-flash',
                    'model_key' => 'gemini-2.0-flash',
                ]);

                // Create default provider for David
                AiProvider::create([
                    'name' => 'David AI (Gemini)',
                    'ai_vendor_id' => $vendor->id,
                    'ai_model_id' => $lite->id,
                    'is_default' => true,
                    'system_prompt' => "Eres el asistente virtual de David Gómez Barragán, Ingeniero Civil con más de 30 años de experiencia. Tu objetivo es ayudar a los visitantes de su sitio web a conocer su trayectoria, formación y proyectos. Eres profesional, eficiente y conocedor del sector de la construcción en México. Responde siempre en español de manera cordial.",
                ]);

            } elseif ($vendor->key === 'openai') {
                AiModel::create([
                    'ai_vendor_id' => $vendor->id,
                    'name' => 'GPT-4o',
                    'key' => 'gpt-4o',
                    'model_key' => 'gpt-4o',
                ]);
            }
        }
    }
}
