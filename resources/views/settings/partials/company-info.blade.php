<!-- filepath: c:\xampp\htdocs\• Other-Projects •\bms_tailor\resources\views\settings\company-info.blade.php -->
{{-- <div class="py-12"> --}}
    {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-indigo-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                <h5 class="text-base font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Company Information
                </h5>
            </div>
            @php
                $companyInfo = json_decode(Storage::disk('local')->get('company_info.json'), true);
            @endphp
            <div class="p-6">
                <form action="{{ route('settings.company-info') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="grid md:grid-cols-12 gap-6">
                        <div class="md:col-span-6">
                            <label for="company_name" class="block text-xs font-medium text-indigo-700 mb-1">Company Name</label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <input type="text" name="company_name" id="company_name" value="{{ $companyInfo['company_name'] ?? '' }}" class="pl-10 w-full bg-indigo-50 border-0 border-b-2 border-indigo-300 focus:border-indigo-500 focus:ring-0 focus:bg-white transition-all duration-200 text-sm" required>
                            </div>
                        </div>
                        
                        <div class="md:col-span-6">
                            <label for="phone" class="block text-xs font-medium text-indigo-700 mb-1">Phone</label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <input type="text" name="phone" id="phone" value="{{ $companyInfo['phone'] ?? '' }}" class="pl-10 w-full bg-indigo-50 border-0 border-b-2 border-indigo-300 focus:border-indigo-500 focus:ring-0 focus:bg-white transition-all duration-200 text-sm" required>
                            </div>
                        </div>
                        
                        <div class="md:col-span-12">
                            <label for="address" class="block text-xs font-medium text-indigo-700 mb-1">Address</label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <textarea name="address" id="address" rows="3" class="pl-10 w-full bg-indigo-50 border-0 border-b-2 border-indigo-300 focus:border-indigo-500 focus:ring-0 focus:bg-white transition-all duration-200 text-sm" required>{{ $companyInfo['address'] ?? '' }}</textarea>
                            </div>
                        </div>
                        
                        <div class="md:col-span-12 flex justify-end">
                            <button type="submit" class="flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium py-2 px-6 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Save Company Information
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    {{-- </div> --}}
{{-- </div> --}}