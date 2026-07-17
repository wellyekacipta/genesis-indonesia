<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification;

class Login extends BaseLogin
{
    protected static string $layout = 'layouts.auth-simple';
    protected string $view = 'auth.login';

    public function mount(): void
    {
        parent::mount();
        
        // Always regenerate captcha on page load/refresh
        $this->regenerateCaptcha();
    }

    protected function regenerateCaptcha(): void
    {
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        session(['captcha_result' => $num1 + $num2]);
        session(['captcha_text' => "{$num1} + {$num2}"]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
                TextInput::make('captcha')
                    ->label(fn () => 'Berapa hasil dari ' . session('captcha_text', '0 + 0') . '?')
                    ->placeholder('Masukkan jawaban angka')
                    ->required()
                    ->numeric()
                    ->rules(['required', 'integer']),
            ]);
    }

    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();
        
        $expected = session('captcha_result');
        $actual = isset($data['captcha']) ? (int) $data['captcha'] : null;

        if ($expected === null || $actual !== $expected) {
            $this->regenerateCaptcha();
            
            Notification::make()
                ->title('Jawaban Captcha Salah')
                ->body('Hasil penjumlahan matematika tidak sesuai.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'data.captcha' => 'Jawaban captcha salah. Silakan coba lagi.',
            ]);
        }

        try {
            $response = parent::authenticate();
            session()->forget(['captcha_result', 'captcha_text']);
            return $response;
        } catch (ValidationException $e) {
            $this->regenerateCaptcha();
            
            Notification::make()
                ->title('Gagal Login')
                ->body('Username atau password salah. Silakan coba lagi.')
                ->danger()
                ->send();

            throw $e;
        } catch (\Exception $e) {
            $this->regenerateCaptcha();
            
            Notification::make()
                ->title('Koneksi Gagal')
                ->body('Sedang menyiapkan server, silakan hubungi administrator.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'data.email' => 'Sedang menyiapkan server. Silakan hubungi admin.',
            ]);
        }
    }
}
