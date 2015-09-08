<?php

namespace App\Http\Controllers\Admin\Rbac;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Requests\Admin\Rbac\Role\CreateRequest;
use App\Http\Requests\Admin\Rbac\Role\UpdateRequest;

use App\Repositories\Admin\PermissionRepository;
use App\Repositories\Admin\RoleRepository;

class RoleController extends AdminController
{

    protected $roleRepository;
    protected $permissionRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        parent::__construct();
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->roleRepository->roleList();
        //$roles = $this->roleRepository->roleList(static::PER_PAGE_NUM);
        return view('admin.rbac.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.rbac.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateRequest $createRequest)
    {
        $result = $this->roleRepository->store($createRequest->all());
        $result ? $alert ='创建成功' : $alert ='创建失败';
        return redirect('rbac/role')->with('message', $alert);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getById($id);

        $data['data'] = $role;

        return view('admin.rbac.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->roleRepository->update($id, $request->all());

        $result['status'] ? $alert = '角色更新成功' : $alert = $result['error'];

        return redirect()->route('rbac.role.index')->with('message',$alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->roleRepository->destroy($id);
        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? '角色已删除' : '角色删除失败',
        ];
        return response()->json($alert);
    }

    /**
     * Display a role's perms
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getPerms($id)
    {
        $role = $this->roleRepository->getById($id);
        $permissions = $this->permissionRepository->index();
        $rolePerms = $this->roleRepository->rolePerms($id);
        return view('admin.rbac.role.permissions', compact('role', 'permissions', 'rolePerms'));
    }

    public function postPerms($id, Request $request)
    {
        $result = $this->roleRepository->savePerms($id, $request->input('permissions', []));

        $alert = $result ? '角色权限保存成功' : '角色权限保存失败';
        return redirect(route('rbac.role.permissions', ['id' => $id]))->with('fail', $alert);
    }
}
