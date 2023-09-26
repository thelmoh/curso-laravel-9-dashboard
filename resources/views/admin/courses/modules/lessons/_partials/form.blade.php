@include('admin.includes.alerts')
@csrf
<div class="">
    <label class="block text-sm text-gray-600" for="name">Nome</label>
    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
        type="text" required="required" placeholder="Nome" aria-label="Name" value="{{ $lesson->name ?? old('name') }}">
</div>
<div class="">
    <label class="block text-sm text-gray-600" for="name">Vídeo</label>
    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="video" name="video"
        type="text" required="required" placeholder="Vídeo" aria-label="video" value="{{ $lesson->name ?? old('video') }}">
</div>
<div class="">
    <label class="block text-sm text-gray-600" for="name">Descrição:</label>
    <textarea class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="description" id="" cols="30" rows="5" placeholder="Descrição">{{ $lesson->description ?? old('description') }}</textarea>
</div>
<div class="mt-6">
    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
        type="submit">Enviar</button>
</div>