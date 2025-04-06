<div id="customerShowModal-{{ $customer->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-30 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out backdrop-blur-sm" style="z-index: 100;">
    <div class="relative top-20 mx-auto p-0 border-0 w-full max-w-lg shadow-2xl rounded-xl bg-white max-h-[85vh] flex flex-col overflow-hidden transform transition-all">
        <!-- Header with gradient -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Customer Profile</h3>
                <button type="button" class="text-white/80 hover:text-white transition-colors focus:outline-none" onclick="closeModal('customerShowModal-{{ $customer->id }}')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-blue-100 mt-1 text-sm">ID: {{ $customer->customer_id }}</p>
        </div>
        
        <div class="p-6 overflow-y-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                        </svg>
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Name</h4>
                    </div>
                    <p class="text-gray-800 font-medium text-lg">{{ $customer->name }}</p>
                </div>
                
                <!-- Phone -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Phone</h4>
                    </div>
                    <p class="text-gray-800 font-medium text-lg">{{ $customer->phone }}</p>
                </div>
                
                <!-- Email -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Email</h4>
                    </div>
                    <p class="text-gray-800 font-medium">{{ $customer->email ?? 'N/A' }}</p>
                </div>
                
                <!-- Gender -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Gender</h4>
                    </div>
                    <p class="text-gray-800 font-medium">{{ ucfirst($customer->sex) }}</p>
                </div>
                
                <!-- Customer Since -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Customer Since</h4>
                    </div>
                    <p class="text-gray-800 font-medium">{{ $customer->created_at->format('F d, Y') }}</p>
                </div>
            </div>
            
            <!-- Address (full width) -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 mt-4 hover:shadow-md transition-all">
                <div class="flex items-center mb-2">
                    <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Address</h4>
                </div>
                <p class="text-gray-800">{{ $customer->address }}</p>
            </div>

            <!-- Financial Information -->
            <div class="mt-6 mb-2">
                <h4 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-1">Financial Information</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Purchased Amount -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all">
                        <div class="flex items-center mb-2">
                            <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Purchased Amount</h4>
                        </div>
                        <p class="text-gray-800 font-medium">{{ number_format($customer->purchased_amount, 2) }}</p>
                    </div>

                    <!-- Amount Paid -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all">
                        <div class="flex items-center mb-2">
                            <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                            </svg>
                            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Amount Paid</h4>
                        </div>
                        <p class="text-gray-800 font-medium">{{ number_format($customer->amount_paid, 2) }}</p>
                    </div>

                    <!-- Balance -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all">
                        <div class="flex items-center mb-2">
                            <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L8.414 9H10a3 3 0 013 3v1a1 1 0 102 0v-1a5 5 0 00-5-5H8.414l1.293-1.293z" clip-rule="evenodd"></path>
                            </svg>
                            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Balance</h4>
                        </div>
                        <p class="text-gray-800 font-medium">{{ number_format($customer->balance, 2) }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Notes (if available) -->
            @if($customer->notes)
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100 mt-4 hover:shadow-md transition-all">
                <div class="flex items-center mb-2">
                    <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Notes</h4>
                </div>
                <p class="text-gray-700 italic">{{ $customer->notes }}</p>
            </div>
            @endif
        </div>
        
        <!-- Footer -->
        <div class="bg-gray-50 p-4 border-t border-gray-100 flex justify-between items-center">
            <button 
                type="button" 
                onclick="openModal('customerEditModal-{{ $customer->id }}')"
                class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors"
            >
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Edit Customer
                </span>
            </button>
            <button 
                type="button" 
                onclick="closeModal('customerShowModal-{{ $customer->id }}')" 
                class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors"
            >
                Close
            </button>
        </div>
    </div>
</div>