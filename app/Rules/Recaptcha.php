<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Recaptcha implements ValidationRule
{
    protected float $minScore;
    protected string $expectedAction;

    public function __construct(string $expectedAction = 'submit', float $minScore = 0.5)
    {
        $this->expectedAction = $expectedAction;
        $this->minScore = $minScore;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $secret = config('services.recaptcha.secret_key');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => $secret,
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (!$response->ok()) {
            $fail('Error al verificar reCAPTCHA.');
            return;
        }

        $result = $response->json();

        // 👇 Log para debug
        // Log::info('reCAPTCHA verification', $result);

        if (!($result['success'] ?? false)) {
            $fail('Validación reCAPTCHA fallida.');
            return;
        }

        if (($result['action'] ?? null) !== $this->expectedAction) {
            $fail('La acción de reCAPTCHA no coincide.');
            return;
        }

        if (($result['score'] ?? 0) < $this->minScore) {
            $fail('No se superó la validación de seguridad.');
        }
    }
}
