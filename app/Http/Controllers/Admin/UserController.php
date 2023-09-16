<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImage;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UserUpdate;
use App\Models\User;
use App\Services\UploadFile;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request) 
    {
        $users = $this->service->getAll(
            filter: $request->filter ?? ''
        );
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUser $request)
    {

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $this->service->create($data);
        
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        if (!$user = $this->service->findById($id))
        {
            return redirect()->back();
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(UserUpdate $request, $id)
    {
        $data = $request->only(['name','email']);

        if ($request->password) 
            $data['password'] = bcrypt($data['password']);

        if (!$this->service->update($id, $data)){
            return back();
        }

        return redirect()->route('users.index');
    }

    public function changeImage($id)
    {
        if (!$user = $this->service->findById($id))
        {
            return redirect()->back();
        }

        return view('admin.users.change-image', compact('user'));
    }

    public function uploadFile(StoreImage $request, UploadFile $uploadFile, $id)
    {
        $path = $uploadFile->store($request->image, 'users');
        
        if (!$this->service->update($id, ['image' => $path])){
            return back();
        }

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        if (!$user = $this->service->findById($id))
        {
            return redirect()->back();
        }

        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        if (!$user = $this->service->findById($id))
        {
            return redirect()->back();
        }

        $this->service->delete($id);

        return redirect()->route('users.index');
    }


}
