<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-4 bg-white shadow sm:rounded-lg border border-blue-200 hover:bg-blue-50 mx-auto" style="width: 1000px;">
                <div class="w-full mx-auto">
                    @include('settings.partials.product-settings-form')
                </div>
            </div>

            <div class="mt-5 p-4 sm:p-4 bg-white shadow sm:rounded-lg border border-blue-200 hover:bg-blue-50 mx-auto" style="width: 1000px;">
                <div class="w-full mx-auto">
                    @include('settings.partials.supplier-type-form')
                </div>
            </div>

            <div class="mt-5 p-4 sm:p-4 bg-white shadow sm:rounded-lg border border-blue-200 hover:bg-blue-50 mx-auto" style="width: 1000px;">
                <div class="w-full mx-auto">
                    @include('settings.partials.company-info')
                </div>
            </div>

            <div class="p-4 sm:p-4 bg-white shadow sm:rounded-lg border border-blue-200 hover:bg-blue-50">
                <div class="w-full mx-auto">
                    {{-- @include('profile.partials.delete-user-form') --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>