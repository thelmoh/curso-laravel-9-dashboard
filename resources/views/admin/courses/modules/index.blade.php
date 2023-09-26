@extends('admin.layouts.app')
@section('title', "Módulos do Curso {$course->name}")
@section('content')
    <div class="w-full mt-12">
        <p class="text-xl pb-3 flex items-center">
            <a href="{{ route('modules.create', $course->id) }}"><i class="fas fa-plus mr-3"></i></a>  Módulos do Curso {{ $course->name }}
        </p>
        
        @include('admin.includes.form-search', [
            'routerName' => 'modules.index',
            'params' => $course->id
        ])
        
        <div class="bg-white overflow-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nome
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            AÇÕES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($modules as $module)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $module->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('modules.edit', [$course->id, $module->id]) }}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Editar</span>
                                </span>
                            </a>
                            <a href="{{ route('modules.show', [$course->id, $module->id]) }}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Detalhes</span>
                                </span>
                            </a>
                            <a href="{{ route('lessons.index', $module->id) }}">
                                <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Aulas</span>
                                </span>
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="1000">
                                NENHUM MÓDULO CADASTRADO
                            </td>
                        </tr>                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
