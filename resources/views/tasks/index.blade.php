@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h1 class="text-2xl font-bold">My Tasks</h1>
                        <a href="{{ route('tasks.create') }}"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium whitespace-nowrap">
                            Create New Task
                        </a>
                    </div>

                    <!-- Filters & Sorting Form -->
                    <form method="GET" action="{{ route('tasks.index') }}" class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" name="search" id="search" value="{{ $filters['search'] ?? '' }}"
                                       placeholder="Title or description..." 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status" 
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="all" {{ ($filters['status'] ?? 'all') === 'all' ? 'selected' : '' }}>All</option>
                                    <option value="Pending" {{ ($filters['status'] ?? '') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ ($filters['status'] ?? '') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ ($filters['status'] ?? '') === 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <!-- Sort By -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                                <select name="sort_by" id="sort_by" 
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="created_at" {{ ($filters['sort_by'] ?? 'created_at') === 'created_at' ? 'selected' : '' }}>Created Date</option>
                                    <option value="title" {{ ($filters['sort_by'] ?? '') === 'title' ? 'selected' : '' }}>Title</option>
                                    <option value="status" {{ ($filters['sort_by'] ?? '') === 'status' ? 'selected' : '' }}>Status</option>
                                    <option value="due_date" {{ ($filters['sort_by'] ?? '') === 'due_date' ? 'selected' : '' }}>Due Date</option>
                                </select>
                            </div>

                            <!-- Sort Direction -->
                            <div>
                                <label for="sort_direction" class="block text-sm font-medium text-gray-700 mb-1">Direction</label>
                                <select name="sort_direction" id="sort_direction" 
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="desc" {{ ($filters['sort_direction'] ?? 'desc') === 'desc' ? 'selected' : '' }}>Descending</option>
                                    <option value="asc" {{ ($filters['sort_direction'] ?? '') === 'asc' ? 'selected' : '' }}>Ascending</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end gap-3">
                            <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm">
                                Reset
                            </a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium">
                                Apply Filters
                            </button>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($tasks->isEmpty())
                        <p class="text-gray-500 text-center py-8">
                            @if (request()->filled('search') || (request()->filled('status') && request()->status !== 'all'))
                                No tasks found matching your filters.
                            @else
                                You don't have any tasks yet. Create one!
                            @endif
                        </p>
                    @else
                        <!-- Existing table code remains here -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                                                @if ($task->description)
                                                    <div class="text-sm text-gray-500 mt-1 line-clamp-2">{{ Str::limit($task->description, 80) }}</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $task->status === 'Completed' ? 'bg-green-100 text-green-800' : 
                                                       $task->status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $task->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $task->due_date ? $task->due_date->format('d M Y') : '—' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this task?')"
                                                            class="text-red-600 hover:text-red-900">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Links -->
                        <div class="mt-6 flex justify-center">
                            {{ $tasks->links('vendor.pagination.tailwind') }}
                        </div>

                        <!-- Optional: Show current range and total -->
                        <div class="mt-2 text-center text-sm text-gray-600">
                            Showing {{ $tasks->firstItem() }}–{{ $tasks->lastItem() }} of {{ $tasks->total() }} tasks
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection