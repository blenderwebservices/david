<?php

namespace App\Ai\Agents;

use App\Models\AiProvider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Promptable;
use Laravel\Ai\Providers\Tools\WebSearch;
use Stringable;

class DavidAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    public function provider(): string
    {
        $provider = AiProvider::where('is_default', true)->with('vendor')->first();
        
        $vendorKey = $provider?->vendor?->key ?: config('ai.default');

        // Dynamically override config with DB values if present
        if ($provider) {
            $apiKey = $provider->api_key ?: $provider->vendor?->api_key;
            if ($apiKey) {
                config(["ai.providers.{$vendorKey}.key" => $apiKey]);
            }

            $baseUrl = $provider->base_url ?: $provider->vendor?->base_url;
            if ($baseUrl) {
                config(["ai.providers.{$vendorKey}.url" => $baseUrl]);
            }
        }

        return $vendorKey;
    }

    public function model(): ?string
    {
        $provider = AiProvider::where('is_default', true)->with('aiModel')->first();
        return $provider?->aiModel?->model_key ?: config("ai.providers.{$this->provider()}.model");
    }

    protected array $history = [];

    /**
     * Set the conversation history.
     */
    public function withHistory(array $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        $dbPrompt = AiProvider::where('is_default', true)->value('system_prompt');
        $dbPrompt = AiProvider::where('is_default', true)->value('system_prompt');
        $currentDate = now()->locale('es')->translatedFormat('l, j \d\e F \d\e Y');

        $instructions = $dbPrompt ?: "Eres el asistente virtual de David Gómez Barragán, Ingeniero Civil con más de 30 años de experiencia. Tu objetivo es ayudar a los visitantes de su sitio web a conocer su trayectoria, formación y proyectos. Eres profesional, eficiente y conocedor del sector de la construcción en México. Responde siempre en español de manera cordial.";

        return "Hoy es {$currentDate}. " . (string) $instructions;
    }

    /**
     * Get the list of tools that the agent can use.
     *
     * @return array
     */
    public function tools(): array
    {
        $provider = AiProvider::where('is_default', true)->first();

        if ($provider && $provider->web_search_enabled) {
            return [
                (new WebSearch())->max(3)
            ];
        }

        return [];
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return $this->history;
    }
}
