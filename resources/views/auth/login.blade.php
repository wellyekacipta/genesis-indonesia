<div class="flex flex-col md:flex-row w-full max-w-4xl bg-white dark:bg-gray-800 rounded-[30px] shadow-2xl overflow-hidden min-h-[550px] transition-all duration-300">
    
    <!-- Left Panel: Sign In -->
    <div class="w-full md:w-1/2 px-8 py-12 md:px-16 flex flex-col justify-center bg-white dark:bg-gray-800">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6 text-center tracking-tight">Sign in</h2>
        
        <!-- Social Icons -->
        <div class="flex justify-center space-x-3 mb-6">
            <a href="#" class="w-10 h-10 rounded-full border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 transition-colors">
                <i class="fa-brands fa-facebook-f text-sm"></i>
            </a>
            <a href="#" class="w-10 h-10 rounded-full border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 transition-colors">
                <i class="fa-brands fa-google-plus-g text-sm"></i>
            </a>
            <a href="#" class="w-10 h-10 rounded-full border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 transition-colors">
                <i class="fa-brands fa-linkedin-in text-sm"></i>
            </a>
        </div>
        
        <p class="text-xs text-gray-500 dark:text-gray-400 text-center mb-6 font-medium">atau gunakan akun anda</p>
        
        <form wire:submit="authenticate" class="space-y-4">
            <style>
                .fi-input-wrp {
                    background-color: #f3f4f6 !important;
                    border: none !important;
                    border-radius: 10px !important;
                    box-shadow: none !important;
                    --ring-color: transparent !important;
                }
                .dark .fi-input-wrp {
                    background-color: #1f2937 !important;
                }
                .fi-input-wrp input {
                    background-color: transparent !important;
                    border: none !important;
                    box-shadow: none !important;
                    font-size: 0.875rem !important;
                    padding: 0.75rem 1rem !important;
                }
                .fi-fo-text-input label {
                    font-size: 0.75rem !important;
                    font-weight: 700 !important;
                    text-transform: uppercase !important;
                    letter-spacing: 0.05em !important;
                    color: #4b5563 !important;
                }
                .dark .fi-fo-text-input label {
                    color: #9ca3af !important;
                }
            </style>
            
            {{ $this->form }}
            
            <div class="text-center mt-4">
                <a href="#" class="text-xs text-gray-500 dark:text-gray-450 hover:text-genesis-pink transition-colors">Lupa kata sandi anda?</a>
            </div>
            
            <div class="flex justify-center mt-8">
                <button type="submit" class="bg-genesis-pink hover:bg-genesis-pinkDark text-white font-bold px-12 py-3.5 rounded-full transition shadow-lg transform hover:-translate-y-0.5 active:translate-y-0 tracking-wider text-xs cursor-pointer">
                    SIGN IN
                </button>
            </div>
        </form>
    </div>
    
    <!-- Right Panel: Welcome Banner (Logo Genesis Indonesia) -->
    <div class="w-full md:w-1/2 bg-gradient-to-br from-genesis-pink to-genesis-pinkDark p-12 md:p-16 flex flex-col justify-center items-center text-center text-white relative">
        <div class="flex flex-col items-center">
            <a href="{{ route('home') }}" class="mb-6 hover:scale-105 transition-transform duration-300 inline-block">
                <img src="https://lh3.googleusercontent.com/a/ACg8ocJW-BsErSCxATtNF1sjxdywseKWWUd7D0z6SkFU-DKGrIA_mqo=s432-c-no" 
                     alt="Logo Genesis" 
                     class="w-24 h-24 md:w-32 md:h-32 object-contain bg-white rounded-full p-2 shadow-2xl border-4 border-white/20">
            </a>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight leading-none mb-2 text-white">GENESIS INDONESIA</h1>
            <p class="text-xs md:text-sm text-white/80 font-bold tracking-widest uppercase mb-8">Education Centre</p>
            <a href="{{ route('home') }}" class="border border-white/40 bg-white/10 hover:bg-white hover:text-genesis-pink text-white font-bold px-10 py-3.5 rounded-full transition duration-300 tracking-wider text-xs shadow-lg backdrop-blur-sm active:scale-95">
                <i class="fa-solid fa-arrow-left mr-2"></i> {{ app()->getLocale() == 'id' ? 'KEMBALI KE BERANDA' : 'BACK TO HOME' }}
            </a>
        </div>
    </div>
</div>
