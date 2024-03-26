@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-gray-300 text-lg font-normal">My Projects</h2>
            <a class="rounded-lg shadow-md bg-sky-300 text-white px-4 py-1" href="{{ route('projects.create') }}">Add
                Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex lg:flex-wrap -mx-3">
            @forelse ($projects as $project)
                <div class="lg:w-1/3 px-3 pb-5">
                    <div class="bg-white p-5 rounded-lg shadow h-52">
                        <h3 class="font-normal text-xl py-6 mb-3 -ml-5 border-l-4 border-sky-300 pl-4">
                            <a href="{{ $project->path() }}">{{ $project->title }}</a>
                        </h3>
                        <div class="text-gray-400">{{ Illuminate\Support\Str::limit($project->description, 100) }}</div>
                    </div>
                </div>
            @empty
                <div>
                    No projects yet.
                </div>
            @endforelse
        </div>
    </main>
@endsection
