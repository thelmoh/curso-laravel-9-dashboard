@extends('admin.layouts.app')
@section('title', 'Editar um Curso')
@section('content')
    <h1 class="w-full text-3xl text-black pb-6">Editar o Curso {{ $course->name }}</h1>
    <div class="flex flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @include('admin.courses._partials.form')
                </form>
            </div>
        </div>
    @endsection
