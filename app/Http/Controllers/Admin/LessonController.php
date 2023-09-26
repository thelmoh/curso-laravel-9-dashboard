<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLesson;
use App\Repositories\ModuleRepositoryInterface;
use App\Repositories\LessonRepositoryInterface;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $repository;
    protected $repositoryModule;

    public function __construct(
        ModuleRepositoryInterface $repositoryModule,
        LessonRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
        $this->repositoryModule = $repositoryModule;
    }

    public function index(Request $request, $moduleId)
    {
        if (!$module = $this->repositoryModule->findById($moduleId))
            return back();

        $lessons = convertArrayToObject($this->repository->getAllByModuleId(
            moduleId: $moduleId,
            filter: $request->filter ?? ''
        ));

        return view('admin.courses.modules.lessons.index', compact('module','lessons'));
    }

    public function create($moduleId) {
        if (!$module = $this->repositoryModule->findById($moduleId))
            return back();

        return view('admin.courses.modules.lessons.create', compact('module'));
    }

    public function store(StoreUpdateLesson $request, $moduleId) {

        if (!$module = $this->repositoryModule->findById($moduleId))
            return back();

        $this->repository->createByModule($moduleId, $request->only(['name','video','description']));

        return redirect()->route('lessons.index', $module->id);
    }

    public function edit($moduleId, $lessonId) {
        if (!$lesson = $this->repository->findById($lessonId))
            return back();

        if (!$module = $this->repositoryModule->findById($moduleId))
            return back();

        return view('admin.courses.modules.lessons.edit', compact('module', 'lesson'));
    }

    public function update(StoreUpdateLesson $request, $moduleId, $lessonId) {
        if (!$this->repository->findById($lessonId))
            return back();

        if (!$this->repositoryModule->findById($moduleId))
            return back();

        $this->repository->update($lessonId, $request->only(['name','video','description']));

        return redirect()->route('lessons.index', $moduleId);
    }

    public function show($moduleId, $lessonId)
    {
        if (!$lesson = $this->repository->findById($lessonId))
            return back();

        if (!$module = $this->repositoryModule->findById($moduleId))
            return back();

        return view('admin.courses.modules.lessons.show', compact('module', 'lesson'));
    }

    public function destroy($moduleId, $lessonId)
    {
        if (!$lesson = $this->repository->findById($lessonId))
            return back();

        if (!$this->repository->delete($lessonId))
            return back();

        return redirect()->route('lessons.index', $moduleId);
    }


}
