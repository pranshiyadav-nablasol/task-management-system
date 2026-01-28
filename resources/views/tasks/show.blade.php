@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <h1 class="text-2xl font-bold">{{ $task->title }}</h1>
                        <a href="{{ route('tasks.index') }}" class="text-indigo-600 hover:text-indigo-800">Back to Tasks</a>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Status</h3>
                            <p class="mt-1 text-lg">
                                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $task->status === 'Completed' ? 'bg-green-100 text-green-800' : 
                                       $task->status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $task->status }}
                                </span>
                            </p>
                        </div>

                        @if ($task->description)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Description</h3>
                                <p class="mt-1 whitespace-pre-wrap">{{ $task->description }}</p>
                            </div>
                        @endif

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Due Date</h3>
                            <p class="mt-1">{{ $task->due_date ? $task->due_date->format('d M Y') : 'No due date' }}</p>
                        </div>

                        <div class="pt-4 border-t">
                            <a href="{{ route('tasks.edit', $task) }}" 
                               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                                Edit Task
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection