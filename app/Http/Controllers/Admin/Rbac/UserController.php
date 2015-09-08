<?php

namespace App\Http\Controllers\Admin\Rbac;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Requests\Admin\Rbac\User\CreateRequest;
use App\Http\Requests\Admin\Rbac\User\UpdateRequest;

use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\UserRepository;

class UserController extends AdminController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepository->userList();
        return view('admin.rbac.user.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepository->index();
        return view('admin.rbac.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $userId = $this->userRepository->store($request->all());
        if ($userId && ($roles = $request->input('roles', []))) {
            $this->userRepository->attachRole($userId, $roles);
        }
        $alert = $userId ? '新用户创建成功' : '用户创建失败';

        return redirect('rbac/user')->with('message', $alert);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        $roles = $this->roleRepository->index();
        return view('admin.rbac.user.edit', compact('user', 'roles'));
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
        $result = $this->userRepository->update($id, $request->all());

        $result['status'] ? $alert = '用户更新成功' : $alert = $result['error'];
        return redirect()->route('rbac.user.index')->with('message',$alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->userRepository->destroy($id);

        $alert = [
            'type' => $result ? 1 : 0,
            'message' => $result ? '用户已删除' : '用户删除失败',
        ];
        return response()->json($alert);
    }
}
