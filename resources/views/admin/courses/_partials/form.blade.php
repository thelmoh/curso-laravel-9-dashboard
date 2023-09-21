@include('admin.includes.alerts')
@csrf
<div class="">
    <label class="block text-sm text-gray-600" for="name">Nome</label>
    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
        type="text" required="required" placeholder="Nome" aria-label="Name" value="{{ $course->name ?? old('name') }}">
</div>
<div class="flex items-center mb-4 mt-2">
    <input id="available" name="available" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @checked($course->available ?? false)>
    <label for="available" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Disponível</label>
</div>
<div class="mt-2">
    <label class=" block text-sm text-gray-600" for="message">Foto</label>
    <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="image" name="image"
        type="file">
</div>
<div class="mt-6">
    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
        type="submit">Enviar</button>
</div>