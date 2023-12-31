@extends('admin.layouts.app')
@section('title', 'Cursos')
@section('content')
    <div class="w-full mt-12">
        <p class="text-xl pb-3 flex items-center">
            <a href="{{ route('courses.create') }}"><i class="fas fa-plus mr-3"></i></a>  Lista de Cursos
        </p>
        
        @include('admin.includes.form-search', ['routerName' => 'courses.index'])
        
        <div class="bg-white overflow-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Curso
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Disponível
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Criado em
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            AÇÕES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    @if ($course->image)
                                        <img class="w-full h-full rounded-full"
                                            src="{{ url("storage/{$course->image}") }}"
                                            alt="{{ $course->name }}" />
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $course->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $course->available ? 'Publicado' : 'Não Publicado' }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $course->created_at }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('courses.edit', $course->id) }}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Editar</span>
                                </span>
                            </a>
                            <a href="{{ route('courses.show', $course->id) }}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Detalhes</span>
                                </span>
                            </a>
                            <a href="{{ route('modules.index', $course->id) }}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Módulos</span>
                                </span>
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="1000">
                                NENHUM CURSO CADASTRADO.
                            </td>
                        </tr>                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
