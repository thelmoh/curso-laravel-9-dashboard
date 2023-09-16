@include('admin.includes.alerts')
@csrf
<div class="">
    <label class="block text-sm text-gray-600" for="name">Nome</label>
    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
        type="text" required="required" placeholder="Nome" aria-label="Name" value="{{ $admin->name ?? old('name') }}">
</div>
<div class="mt-2">
    <label class="block text-sm text-gray-600" for="email">E-mail</label>
    <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email"
        type="email" required="true" placeholder="Email" aria-label="Email" value="{{ $admin->email ?? old('email') }}">
</div>
<div class="mt-2">
    <label class=" block text-sm text-gray-600" for="message">Senha</label>
    <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password"
        type="password" required="" placeholder="" aria-label="Password">
</div>
<div class="mt-6">
    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
        type="submit">Enviar</button>
</div>