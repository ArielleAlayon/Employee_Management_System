<x-layouts.app :title="__('Departments')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        @if(session('success'))
            <div class="rounded-lg bg-green-100 p-4 text-green-700 dark:bg-green-900/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-lg border-l-4 border-red-500 bg-red-50 p-4 dark:bg-red-900/20 dark:border-red-400">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-exclamation text-red-600 dark:text-red-400 mt-0.5"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-red-800 dark:text-red-300 mb-2">Please fix the following errors:</h3>
                        <ul class="space-y-1 text-sm text-red-700 dark:text-red-200">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center gap-2">
                                    <span class="text-red-500">•</span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-600 dark:hover:text-red-300">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        @endif

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-stone-200 bg-white dark:border-stone-700 dark:bg-slate-800">
            <div class="flex h-full flex-col p-6">

                <div class="mb-6 rounded-lg border border-stone-200 bg-neutral-50 p-6 dark:border-stone-700 dark:bg-slate-900/50">
                    <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Add New Department</h2>

                    <form action="{{ route('departments.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid gap-4 md:grid-cols-3">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Department Name <span class="text-red-600">*</span></label>
                                <input type="text" name="dept_name" value="{{ old('dept_name') }}"
                                       placeholder="Enter department name" required
                                       class="w-full rounded-lg border {{ $errors->has('dept_name') ? 'border-red-500 bg-red-50 dark:bg-red-900/20' : 'border-stone-300 bg-white dark:bg-slate-800' }} px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-stone-600 dark:text-neutral-100">
                                @error('dept_name')
                                    <p class="mt-1.5 flex items-center gap-1.5 text-xs text-red-600 dark:text-red-400"><i class="fa-solid fa-exclamation-circle"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description <span class="text-red-600">*</span></label>
                                <textarea name="description" required rows="1" placeholder="Enter department description"
                                          class="w-full rounded-lg border {{ $errors->has('description') ? 'border-red-500 bg-red-50 dark:bg-red-900/20' : 'border-stone-300 bg-white dark:bg-slate-800' }} px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-stone-600 dark:text-neutral-100">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1.5 flex items-center gap-1.5 text-xs text-red-600 dark:text-red-400"><i class="fa-solid fa-exclamation-circle"></i>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                                Add Department
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Department List Table -->
                <div class="flex-1 overflow-auto">
                    <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Department List</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="border-b border-stone-200 bg-neutral-50 dark:border-stone-700 dark:bg-slate-900/50">
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-neutral-700 dark:text-neutral-300">Department Name</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-neutral-700 dark:text-neutral-300">Description</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-neutral-700 dark:text-neutral-300">Employee Count</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                                @forelse($departments as $department)
                                    <tr class="transition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50" id="department-row-{{ $department->id }}">
                                        <td class="px-4 py-3 text-center text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-neutral-900 dark:text-neutral-100">
                                            <span class="department-name-display">{{ $department->dept_name }}</span>  <!-- Already correct -->
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm text-neutral-600 dark:text-neutral-400">
                                            <span class="department-description-display">{{ Str::limit($department->description, 50) ?? 'N/A' }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm text-neutral-600 dark:text-neutral-400">
                                            <span class="employee-count">{{ $department->employees_count ?? 0 }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm">
                                            <button onclick="openEditDepartmentModal({{ $department->id }})" 
                                                    class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                                Edit
                                            </button>
                                            <span class="mx-1 text-neutral-400">|</span>
                                            <button onclick="openDeleteDepartmentModal({{ $department->id }}, '{{ addslashes($department->dept_name) }}')" 
                                                    class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-sm text-neutral-500 dark:text-neutral-400">
                                            No departments found. Add your first department above!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Edit Department Modal -->
                <div id="editDepartmentModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
                    <div class="w-full max-w-2xl rounded-xl border border-stone-200 bg-white p-6 dark:border-stone-700 dark:bg-slate-800">
                        <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit Department</h2>

                        <form id="editDepartmentForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-4 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label for="edit_department_name" class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Department Name <span class="text-red-600">*</span></label>
                                    <input type="text" id="edit_department_name" name="dept_name" required
                                        class="w-full rounded-lg border {{ $errors->has('dept_name') ? 'border-red-500 bg-red-50 dark:bg-red-900/20' : 'border-stone-300 bg-white dark:bg-slate-800' }} px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-stone-600 dark:text-neutral-100">
                                    @error('dept_name')
                                        <p class="mt-1.5 flex items-center gap-1.5 text-xs text-red-600 dark:text-red-400"><i class="fa-solid fa-exclamation-circle"></i>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="edit_description" class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description</label>
                                    <textarea id="edit_description" name="description" rows="3"
                                            class="w-full rounded-lg border {{ $errors->has('description') ? 'border-red-500 bg-red-50 dark:bg-red-900/20' : 'border-stone-300 bg-white dark:bg-slate-800' }} px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-stone-600 dark:text-neutral-100"></textarea>
                                    @error('description')
                                        <p class="mt-1.5 flex items-center gap-1.5 text-xs text-red-600 dark:text-red-400"><i class="fa-solid fa-exclamation-circle"></i>{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" onclick="closeEditDepartmentModal()"
                                        class="rounded-lg border border-stone-300 px-4 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-100 dark:border-stone-600 dark:text-neutral-300 dark:hover:bg-neutral-700">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                                    Update Department
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteDepartmentModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-md mx-4">
                        <div class="px-6 py-4">
                            <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">Delete Department</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-neutral-700 dark:text-neutral-300 mb-4">
                                Are you sure you want to delete the department "<span id="deleteDepartmentName" class="font-semibold"></span>"?
                            </p>
                            <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">
                                This action cannot be undone. If this department has employees, you won't be able to delete it.
                            </p>
                        </div>
                        <div class="px-6 py-4 flex justify-end space-x-3">
                            <button type="button" onclick="closeDeleteDepartmentModal()"
                                class="px-4 py-2 text-sm font-medium text-neutral-700 bg-neutral-100 hover:bg-neutral-200 rounded-md transition-colors dark:bg-slate-700 dark:text-neutral-300 dark:hover:bg-neutral-600">
                                Cancel
                            </button>
                            <form id="deleteDepartmentForm" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors">
                                    Delete Department
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                async function openEditDepartmentModal(departmentId) {
                    try {
                        console.log('Fetching department data for ID:', departmentId);
                        
                        const response = await fetch(`/departments/${departmentId}/edit`);
                        
                        if (!response.ok) {
                            throw new Error('Failed to fetch department data');
                        }
                        
                        const department = await response.json();
                        console.log('Department data received:', department);
                        
                        document.getElementById('edit_department_name').value = department.dept_name || '';
                        document.getElementById('edit_description').value = department.description || '';
                        
                        document.getElementById('editDepartmentForm').action = `/departments/${departmentId}`;
                        
                        document.getElementById('editDepartmentModal').classList.remove('hidden');
                        document.getElementById('editDepartmentModal').classList.add('flex');
                        
                    } catch (error) {
                        console.error('Error fetching department data:', error);
                        alert('Error loading department data: ' + error.message);
                    }
                }

                function closeEditDepartmentModal() {
                    document.getElementById('editDepartmentModal').classList.add('hidden');
                    document.getElementById('editDepartmentModal').classList.remove('flex');
                }

                function openDeleteDepartmentModal(departmentId, departmentName) {
                    document.getElementById('deleteDepartmentName').textContent = departmentName;
                    
                    document.getElementById('deleteDepartmentForm').action = `/departments/${departmentId}`;
                    
                    document.getElementById('deleteDepartmentModal').classList.remove('hidden');
                }

                function closeDeleteDepartmentModal() {
                    document.getElementById('deleteDepartmentModal').classList.add('hidden');
                }

                
                document.addEventListener('click', function(event) {
                    const editModal = document.getElementById('editDepartmentModal');
                    const deleteModal = document.getElementById('deleteDepartmentModal');
                    
                    if (event.target === editModal) {
                        closeEditDepartmentModal();
                    }
                    if (event.target === deleteModal) {
                        closeDeleteDepartmentModal();
                    }
                });

                
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeEditDepartmentModal();
                        closeDeleteDepartmentModal();
                    }
                });
                </script>
            </div>
        </div>
    </div>    
</x-layouts.app>