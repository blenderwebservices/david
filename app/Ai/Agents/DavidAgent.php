<?php

namespace App\Ai\Agents;

use App\Models\AiProvider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class DavidAgent implements Agent, Conversational
{
    use Promptable;

    public function provider(): string
    {
        $provider = AiProvider::where('is_default', true)->with('vendor')->first();
        
        $vendorKey = $provider?->vendor?->key ?: config('ai.default');

        // Dynamically override config with DB values if present
        if ($provider) {
            if ($provider->api_key) {
                config(["ai.providers.{$vendorKey}.key" => $provider->api_key]);
            }
            if ($provider->base_url) {
                config(["ai.providers.{$vendorKey}.url" => $provider->base_url]);
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

        return $dbPrompt ?: "Eres el asistente virtual de David Gómez Barragán, Ingeniero Civil con más de 30 años de experiencia. Tu objetivo es ayudar a los visitantes de su sitio web a conocer su trayectoria, formación y proyectos. Eres profesional, eficiente y conocedor del sector de la construcción en México. Responde siempre en español de manera cordial.";
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
