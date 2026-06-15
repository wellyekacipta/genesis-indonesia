<x-filament-panels::layout.base :livewire="$livewire">
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite(['resources/css/app.css'])
    @endpush

    @push('scripts')
        @vite(['resources/js/app.js'])
    @endpush

    <div class="min-h-screen flex items-center justify-center bg-[#f5f5f5] dark:bg-gray-900 p-4 font-sans antialiased">
        {{ $slot }}
    </div>
</x-filament-panels::layout.base>
