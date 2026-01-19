<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-center">
            <div class="mb-4">
                <svg class="mx-auto h-16 w-16 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-gray-900 mb-2">Account Pending Approval</h2>
            <p class="text-gray-600">
                Your account registration was successful, but it requires admin approval before you can access the dashboard.
            </p>
        </div>

        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-4">
            <p class="text-sm text-amber-800">
                <strong>What happens next?</strong><br>
                An administrator will review your account and grant you access. You will be able to access the dashboard once your account has been approved.
            </p>
        </div>

        <div class="flex items-center justify-center mt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-button type="submit" class="w-full">
                    {{ __('Logout') }}
                </x-button>
            </form>
        </div>

        <div class="mt-4 text-center">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('home') }}">
                {{ __('Return to Home') }}
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>

