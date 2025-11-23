<x-layouts.app :title="__('Dashboard')">
    <script src="https://kit.fontawesome.com/9d6a4b8185.js" crossorigin="anonymous"></script>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        @if (session('success'))
            <div class="rounded-lg bg-green-300/60 p-4 text-sm text-black dark:text-white">
                {{ session('success') }}    
            </div>
        @endif
        
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative overflow-hidden rounded-xl border border-stone-200 bg-white p-6 dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Employees</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">{{ $employees->count() }}</h3>
                    </div>
                    <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900/60">
                        <i class="fa-solid fa-users p-2 h-8 w-8 text-center text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-xl border border-stone-200 bg-white p-6 dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Departments</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">{{ $departments->count() }}</h3>
                    </div>
                    <div class="rounded-full bg-green-100 p-3 dark:bg-amber-900/50">
                        <i class="fa-solid fa-building text-center p-2 h-8 w-8 text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-xl border border-stone-200 bg-white p-6 dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Most Numerous Department</p>
                        <h3 class="mt-2 text-3xl font-bold text-neutral-900 dark:text-neutral-100">Sales</h3>
                    </div>
                    <div class="rounded-full bg-purple-100 p-3 dark:bg-green-900">
                         <i class="fa-solid fa-chart-bar text-center p-2 h-8 w-8 text-slate-600 dark:text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ManagementSection -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-stone-200 bg-white dark:border-slate-700 dark:bg-slate-800">
            <div class="flex h-full flex-col p-6">
                <!-- Add employee form -->
                <div class="mb-6 rounded-lg border border-stone-200 bg-neutral-50 p-6 dark:border-slate-700 dark:bg-slate-900/50">
                    <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Add New Employee</h2>
                    <form action="{{ route('employees.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
                        @csrf
                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name" required class="w-full rounded-lg border border-stone-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-neutral-100">
                            @error('first_name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name" required class="w-full rounded-lg border border-stone-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-neutral-100">
                            @error('last_name')
                                <p class="mt-1 text-xs text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required class="w-full rounded-lg border border-stone-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-neutral-100">
                            @error('email')
                                <p class="mt-1 text-xs text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Phone No.</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number" class="w-full rounded-lg border border-stone-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-neutral-100">
                            @error('phone')
                                <p class="mt-1 text-xs text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Position</label>
                            <input type="text" name="position" value="{{ old('position') }}" placeholder="Enter position" required class="w-full rounded-lg border border-stone-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-neutral-100">
                            @error('position')
                                <p class="mt-1 text-xs text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Salary</label>
                            <input type="number" name="salary" value="{{ old('salary') }}" placeholder="Enter salary" step="0.01" class="w-full rounded-lg border border-stone-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-neutral-100">
                            @error('salary')
                                <p class="mt-1 text-xs text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Department</label>
                            <select name="department_id" required class="w-full rounded-lg border border-stone-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-600 dark:bg-slate-800 dark:text-neutral-100">
                                <option value="">Select a Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="rounded-lg bg-blue-700 px-6 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                                Add Employee
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Employee List Table -->
                <div class="flex-1 overflow-auto">
                    <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Employee List</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="border-b border-stone-200 bg-neutral-50 dark:border-slate-700 dark:bg-slate-900/50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Email</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Phone</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Position</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Salary</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Department</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200 border-stone-300 border-2 dark:border-slate-700 dark:divide-neutral-700">
                                @forelse($employees as $employee)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->id }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->email }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->phone ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->position }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">${{ number_format($employee->salary, 2) }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->department->dept_name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-center border-2 border-stone-300 dark:border-slate-700 text-neutral-700 dark:text-neutral-300">
                                            <button onclick="openEditModal({{ $employee->id }})" class="text-blue-600 hover:underline transition-colors hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400">Edit</button>
                                            <span>|</span>
                                            <button 
                                                onclick="openDeleteModal({{ $employee->id }}, '{{ addslashes($employee->first_name . ' ' . $employee->last_name) }}')" 
                                                class="text-red-600 transition-colors hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-4 py-8 text-center text-sm text-neutral-500 dark:text-neutral-400" colspan="8">
                                            No employees found. Add your first employee above!
                                        </td>
                                    </tr>                                       
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Edit Employee Modal -->
                <div id="editEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-2xl mx-4">
                        <div class="px-6 py-4 border-b border-stone-200 dark:border-slate-700">
                            <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit Employee</h3>
                        </div>
                        <form id="editEmployeeForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="edit_first_name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">First Name *</label>
                                        <input type="text" id="edit_first_name" name="first_name" required
                                            class="w-full px-3 py-2 border border-stone-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="edit_last_name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Last Name *</label>
                                        <input type="text" id="edit_last_name" name="last_name" required
                                            class="w-full px-3 py-2 border border-stone-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="edit_email" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Email *</label>
                                        <input type="email" id="edit_email" name="email" required
                                            class="w-full px-3 py-2 border border-stone-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="edit_phone" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Phone</label>
                                        <input type="tel" id="edit_phone" name="phone"
                                            class="w-full px-3 py-2 border border-stone-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="edit_position" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Position *</label>
                                        <input type="text" id="edit_position" name="position" required
                                            class="w-full px-3 py-2 border border-stone-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="edit_salary" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Salary</label>
                                        <input type="number" id="edit_salary" name="salary" step="0.01"
                                            class="w-full px-3 py-2 border border-stone-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="edit_department_id" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Department *</label>
                                        <select id="edit_department_id" name="department_id"
                                            class="w-full px-3 py-2 border border-stone-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                                            <option value="">No Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->dept_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 border-t border-stone-200 dark:border-slate-700 flex justify-end space-x-3">
                                <button type="button" onclick="closeEditModal()"
                                    class="px-4 py-2 text-sm font-medium text-neutral-700 bg-neutral-100 hover:bg-neutral-200 rounded-md transition-colors dark:bg-slate-700 dark:text-neutral-300 dark:hover:bg-neutral-600">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors">
                                    Update Employee
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteEmployeeModal" class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-md mx-4">
                        <div class="px-6 py-4 border-b border-stone-200 dark:border-slate-700">
                            <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">Delete Employee</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-neutral-700 dark:text-neutral-300 mb-4">
                                Are you sure you want to delete employee "<span id="deleteEmployeeName" class="font-semibold"></span>"?
                            </p>
                            <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">
                                This action cannot be undone.
                            </p>
                        </div>
                        <div class="px-6 py-4 border-t border-stone-200 dark:border-slate-700 flex justify-end space-x-3">
                            <button type="button" onclick="closeDeleteModal()"
                                class="px-4 py-2 text-sm font-medium text-neutral-700 bg-neutral-100 hover:bg-neutral-200 rounded-md transition-colors dark:bg-slate-700 dark:text-neutral-300 dark:hover:bg-neutral-600">
                                Cancel
                            </button>
                            <form id="deleteEmployeeForm" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors">
                                    Delete Employee
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                function openEditModal(employeeId) {
                    
                    fetchEmployeeData(employeeId);
                    
                    document.getElementById('editEmployeeForm').action = `/employees/${employeeId}`;
                    
                    document.getElementById('editEmployeeModal').classList.remove('hidden');
                }

                function closeEditModal() {
                    document.getElementById('editEmployeeModal').classList.add('hidden');
                }

                
                function openDeleteModal(employeeId, employeeName) {
                    
                    document.getElementById('deleteEmployeeName').textContent = employeeName;
                    
                    
                    document.getElementById('deleteEmployeeForm').action = `/employees/${employeeId}`;
                    
                    
                    document.getElementById('deleteEmployeeModal').classList.remove('hidden');
                }

                function closeDeleteModal() {
                    document.getElementById('deleteEmployeeModal').classList.add('hidden'); 
                }

                
                async function fetchEmployeeData(employeeId) {
                    try {
                        const response = await fetch(`/employees/${employeeId}/edit`);
                        const employee = await response.json();
                        
                        
                        document.getElementById('edit_first_name').value = employee.first_name || '';
                        document.getElementById('edit_last_name').value = employee.last_name || '';
                        document.getElementById('edit_email').value = employee.email || '';
                        document.getElementById('edit_phone').value = employee.phone || '';
                        document.getElementById('edit_position').value = employee.position || '';
                        document.getElementById('edit_salary').value = employee.salary || '';
                        
                        document.getElementById('edit_department_id').value = employee.department_id || '';
                        
                    } catch (error) {
                        console.error('Error fetching employee data:', error);
                        alert('Error loading employee data');
                    }
                }

                
                document.addEventListener('click', function(event) {
                    const editModal = document.getElementById('editEmployeeModal');
                    const deleteModal = document.getElementById('deleteEmployeeModal');
                    
                    if (event.target === editModal) {
                        closeEditModal();
                    }
                    if (event.target === deleteModal) {
                        closeDeleteModal();
                    }
                });

                
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeEditModal();
                        closeDeleteModal();
                    }
                });
                </script>
            </div>
        </div>
    </div>
</x-layouts.app>