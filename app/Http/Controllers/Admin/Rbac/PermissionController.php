<?php

namespace App\Http\Controllers\Admin\Rbac;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;


use App\Http\Requests\Admin\Rbac\Permission\CreateRequest;

use App\Http\Requests\Admin\Rbac\Permission\UpdateRequest;

use App\Repositories\Admin\PermissionRepository;

class PermissionController extends AdminController
{
    protected $permissionRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = $this->permissionRepository->index();

        return view('admin.rbac.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.rbac.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $result = $this->permissionRepository->store($request->all());


       $result ? $alert ='新权限创建成功' : $alert ='权限创建失败';

        return redirect('rbac/permission/create')->with('fail', $alert);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->getById($id);

        $data['data'] = $permission;

        return view('admin.rbac.permission.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {

        $result = $this->permissionRepository->update($id, $request->all());

        $result['status'] ? $alert = '权限更新成功' : $alert = $result['error'];

        return redirect()->route('rbac.permission.index')->with('message',$alert);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->permissionRepository->destroy($id);
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? '权限已删除' : '权限删除失败',
        ];
        return response()->json($alert);
    }
}
