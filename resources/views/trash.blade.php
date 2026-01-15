<x-layouts.app :title="__('Trash')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        @if (session('success'))
            <div class="rounded-lg bg-green-300/60 p-4 text-sm text-black dark:text-white">
                {{ session('success') }}    
            </div>
        @endif

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-stone-200 bg-white dark:border-slate-700 dark:bg-slate-800">
            <div class="flex h-full flex-col p-6">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Trashed Employees</h2>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('employees.index') }}" class="rounded-lg border border-stone-300 px-3 py-2 text-sm hover:bg-neutral-50 dark:border-slate-700">Back to Employees</a>
                    </div>
                </div>

                <div class="flex-1 overflow-auto">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="border-b border-stone-200 bg-neutral-50 dark:border-slate-700 dark:bg-slate-900/50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Email</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Department</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Deleted At</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-200 border-stone-300 border-2 dark:border-slate-700 dark:divide-neutral-700">
                                @forelse($employees as $employee)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->id }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->email }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->department->dept_name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">{{ $employee->deleted_at->diffForHumans() }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-neutral-300">
                                            <div class="flex items-center gap-2">
                                                <form action="{{ route('employees.restore', $employee->id) }}" method="POST" onsubmit="return confirm('Restore this employee?');">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 rounded-md bg-emerald-600 text-white text-sm hover:bg-emerald-500">Restore</button>
                                                </form>

                                                <form action="{{ route('employees.force-delete', $employee->id) }}" method="POST" onsubmit="return confirm('Permanently delete this employee? This cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1 rounded-md bg-red-600 text-white text-sm hover:bg-red-500">Delete Permanently</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-4 py-8 text-center text-sm text-neutral-500 dark:text-neutral-400" colspan="6">
                                            No trashed employees found.
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
</x-layouts.app>
