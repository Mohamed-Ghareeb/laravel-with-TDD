@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <h1 class="heading is-1">Create a Project</h1>

        <div class="field">
            <label for="title" class="label">Title</label>
            <div class="control">
                <input type="text" name="title" placeholder="Title">
            </div>
        </div>

        <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
                <textarea name="description" cols="30" rows="10"></textarea>
            </div>
        </div>

        <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
                <a href="{{ route('projects.index') }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
