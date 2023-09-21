<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseUpdate;
use App\Http\Requests\StoreUpdateCourse;
use App\Http\Requests\StoreImage;
use App\Services\CourseService;
use App\Services\UploadFile;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request) 
    {
        $courses = $this->service->getAll(
            filter: $request->filter ?? ''
        );
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(StoreUpdateCourse $request, UploadFile $uploadFile)
    {

        $data = $request->validated();
        $data['available'] = isset($request->available);

        if ($request->image) {
            $data['image'] =  $uploadFile->store($request->image, 'courses');
        }

        $this->service->create($data);
        
        return redirect()->route('courses.index');
    }

    public function edit($id)
    {
        if (!$course = $this->service->findById($id))
        {
            return redirect()->back();
        }

        return view('admin.courses.edit', compact('course'));
    }

    public function update(StoreUpdateCourse $request, UploadFile $uploadFile, $id)
    {
        $data = $request->validated();
        $data['available'] = isset($request->available);

        if ($request->image) {
            $course = $this->service->findById($id);
            if ($course && $course->image) {
                $uploadFile->removeFile($course->image);
            }
            $data['image'] =  $uploadFile->store($request->image, 'courses');
        }

        if (!$this->service->update($id, $data)){
            return back();
        }

        return redirect()->route('courses.index');
    }

    public function changeImage($id)
    {
        if (!$course = $this->service->findById($id))
        {
            return redirect()->back();
        }

        return view('admin.courses.change-image', compact('admin'));
    }

    public function uploadFile(StoreImage $request, UploadFile $uploadFile, $id)
    {
        $path = $uploadFile->store($request->image, 'admins');
        
        if (!$this->service->update($id, ['image' => $path])){
            return back();
        }

        return redirect()->route('courses.index');
    }

    public function show($id)
    {
        if (!$course = $this->service->findById($id))
        {
            return redirect()->back();
        }

        return view('admin.courses.show', compact('admin'));
    }

    public function destroy($id)
    {
        if (!$course = $this->service->findById($id))
        {
            return redirect()->back();
        }

        $this->service->delete($id);

        return redirect()->route('courses.index');
    }
}
