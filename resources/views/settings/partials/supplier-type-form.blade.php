{{-- <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg"> --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-indigo-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
             <h5 class="text-base font-bold text-white flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                  </svg>
                  Supplier Types Management
             </h5>
        </div>
        
        <div class="p-6">
             <!-- Add Supplier Type Form -->
             <form id="supplierTypeForm" action="{{ route('supplier-type.store') }}" method="POST" class="mb-8">
                  @csrf
                  <input type="hidden" id="supplierTypeId" name="id" value=""> <!-- Hidden input for ID -->
                  <input type="hidden" id="formMethod" name="_method" value="POST"> <!-- Hidden input for method -->
                  <div class="grid md:grid-cols-12 gap-6 items-end">
                       <div class="md:col-span-9">
                            <label for="name" class="block text-xs font-medium text-indigo-700 mb-1">Type Name</label>
                            <div class="relative">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                 </svg>
                                 <input type="text" class="pl-10 w-full bg-indigo-50 border-0 border-b-2 border-indigo-300 focus:border-indigo-500 focus:ring-0 focus:bg-white transition-all duration-200 text-sm" id="name" name="name" required placeholder="Enter type name">
                            </div>
                       </div>
                       
                       <div class="md:col-span-3">
                            <button type="submit" class="w-full h-full flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium py-2 px-4 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 text-sm">
                                 <span id="formSubmitButtonText">Add Supplier Type</span>
                            </button>
                       </div>
                  </div>
             </form>

             <!-- Supplier Types List -->
             <div class="rounded-xl overflow-hidden shadow-md border border-indigo-100">
                  <div class="overflow-auto max-h-80"> <!-- Added fixed height container with scroll -->
                       <table class="w-full text-sm">
                            <thead class="bg-gradient-to-r from-indigo-100 to-purple-100 sticky top-0 z-10"> <!-- Made header sticky -->
                                 <tr>
                                      <th class="py-2 px-4 text-left text-xs font-semibold text-indigo-800 hidden">ID</th>
                                      <th class="py-0 px-2 text-left text-xs font-semibold text-indigo-800">No.</th>
                                      <th class="py-2 px-4 text-left text-xs font-semibold text-indigo-800">Name</th>
                                      <th class="py-2 px-4 text-right text-xs font-semibold text-indigo-800">Actions</th>
                                 </tr>
                            </thead>
                            <tbody class="divide-y divide-indigo-100">
                                 @php
                                 use App\Models\SupplierType;
                                 $supplierTypes = SupplierType::all();
                                 @endphp
                                 
                                 @forelse ($supplierTypes as $type)
                                      <tr class="hover:bg-indigo-50 transition-colors duration-200">
                                           <td class="py-2 px-4 text-xs text-gray-700 hidden">{{ $type->id }}</td>
                                           <td class="py-0 px-0 text-xs text-gray-700 text-center">{{ $loop->iteration }}</td>
                                           <td class="py-2 px-4 text-xs font-medium text-indigo-700">{{ $type->name }}</td>
                                           <td class="py-2 px-4 text-right">
                                                <div class="flex justify-end space-x-2">
                                                     <button type="button" 
                                                          class="text-blue-600 hover:text-blue-800 p-1 rounded-full hover:bg-blue-100 transition-all editButton"
                                                          data-id="{{ $type->id }}" 
                                                          data-name="{{ $type->name }}">
                                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                          </svg>
                                                     </button>
                                                     <form action="{{ route('supplier-type.destroy', $type->id) }}" method="POST" class="inline">
                                                          @csrf
                                                          @method('DELETE')
                                                          <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-800 p-1 rounded-full hover:bg-red-100 transition-all">
                                                               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                               </svg>
                                                          </button>
                                                     </form>
                                                </div>
                                           </td>
                                      </tr>
                                 @empty
                                      <tr>
                                           <td colspan="3" class="py-6 text-center text-xs text-gray-500 italic">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-indigo-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                No supplier types found
                                           </td>
                                      </tr>
                                 @endforelse
                            </tbody>
                       </table>
                  </div>
             </div>
        </div>
   </div>
</div>
<script>
   document.addEventListener('DOMContentLoaded', () => {
   const editButtons = document.querySelectorAll('.editButton');
   const form = document.getElementById('supplierTypeForm');
   const idInput = document.getElementById('supplierTypeId');
   const nameInput = document.getElementById('name');
   const submitButtonText = document.getElementById('formSubmitButtonText');
   const formMethod = document.getElementById('formMethod');

   editButtons.forEach(button => {
        button.addEventListener('click', () => {
             // Get data attributes from the clicked button
             const id = button.getAttribute('data-id');
             const name = button.getAttribute('data-name');

             // Populate the form fields
             idInput.value = id;
             nameInput.value = name;

             // Update the form action, method, and button text
             form.action = `/settings/supplier-type/update/${id}`;
             formMethod.value = 'PUT';
             submitButtonText.textContent = 'Update Supplier Type';
        });
   });
   });
</script>
