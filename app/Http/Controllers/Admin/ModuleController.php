<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModule;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\ModuleRepositoryInterface;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $repository;
    protected $repositoryCourse;

    public function __construct(
        CourseRepositoryInterface $repositoryCourse,
        ModuleRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
        $this->repositoryCourse = $repositoryCourse;
    }

    public function index(Request $request, $courseId)
    {
        if (!$course = $this->repositoryCourse->findById($courseId))
            return back();

        $modules = convertArrayToObject($this->repository->getAllByCourseId(
            courseId: $courseId,
            filter: $request->filter ?? ''
        ));

        return view('admin.courses.modules.index', compact('course','modules'));
    }

    public function create($courseId) {
        if (!$course = $this->repositoryCourse->findById($courseId))
            return back();

        return view('admin.courses.modules.create', compact('course'));
    }

    public function store(StoreUpdateModule $request, $courseId) {
        if (!$course = $this->repositoryCourse->findById($courseId))
            return back();

        $this->repository->createByCourse($courseId, $request->only(['name']));

        return redirect()->route('modules.index', $courseId);
    }

    public function edit($courseId, $moduleId) {
        if (!$module = $this->repository->findById($moduleId))
            return back();

        if (!$course = $this->repositoryCourse->findById($courseId))
            return back();

        return view('admin.courses.modules.edit', compact('course', 'module'));
    }

    public function update(StoreUpdateModule $request, $courseId, $moduleId) {
        if (!$this->repository->findById($moduleId))
            return back();

        if (!$this->repositoryCourse->findById($courseId))
            return back();

        $this->repository->update($moduleId, $request->only(['name']));

        return redirect()->route('modules.index', $courseId);
    }

    public function show($courseId, $moduleId)
    {
        if (!$module = $this->repository->findById($moduleId))
            return back();

        if (!$course = $this->repositoryCourse->findById($courseId))
            return back();

        return view('admin.courses.modules.show', compact('course', 'module'));
    }

    public function destroy($courseId, $moduleId)
    {
        if (!$module = $this->repository->findById($moduleId))
            return back();

        if (!$this->repository->delete($moduleId))
            return back();

        return redirect()->route('modules.index', $courseId);
    }


}
