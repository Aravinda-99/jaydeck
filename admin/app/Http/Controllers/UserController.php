<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Validation\Rule;
use Validator;
use Datatables;
use Auth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('user.index', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request from data
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getRules());

        $user = User::create([
          'name' => $request->name,
          'phone_no' => $request->phone_no,
          'email' => $request->email,
          'password' => bcrypt($request->password),
      ]);

        $user->roles()->sync($request->role, false);

        return response()->json(['msg' => 'user added successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id id comming in the url
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::with('roles')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request form data
     * @param \App\User                $user    user object using laravel route binding
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, $this->getRules($user->id));

        $user->update([
          'name' => $request->name,
          'phone_no' => $request->phone_no,
          'email' => $request->email,
      ]);

        $user->roles()->sync($request->role,true);

        if ($request->password) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return response()->json(['msg' => 'User updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user user obect is required
     *
     * @return Response \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = 0;
        $user->save();

        return response()->json(['msg' => 'User deleted successfully'], 200);
    }

    /**
     * Make user active or in-active
     *
     * @param Request $request json object with user id
     *
     * @return Response
     */
    public function active(Request $request)
    {
        $this->validate($request, ['user_id' => 'required|exists:users,id']);

        $user = User::findOrFail($request->user_id);
        $user->active = $request->active;
        $user->save();

        return response()->json(['msg' => 'User status changed successfully'], 200);
    }

    /**
     * Get data and convert to datatables
     *
     * @return Datatables
     */
    public function getAll()
    {
        $users = User::whereStatus(1)->where('id', '<>', 1)->orderBy('id', 'DESC')->get();

        return Datatables::of($users)
        ->addColumn('action', function ($row) {
            if(Auth::user()->active = 1)
            {
              return '
              <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="EDIT" data-original-title="EDIT USER" onclick="crud.onClickEdit('.$row->id.', $(this))">
              <i class="material-icons">mode_edit</i>
              </button>
              &nbsp;
              <button type="button" class="btn bg-red"  data-toggle="tooltip" data-placement="left" title="DELETE" data-original-title="DELETE USER" onclick="crud.onClickDelete('.$row->id.', $(this))">
              <i class="material-icons">delete</i>
              </button>';
            }
            else{
                return "";
            }
      })
        ->editColumn('active', function ($row) {
            if(Auth::user()->role = 1)
            {
                $check = $row->active ? 'checked':'';
                return '<div class="switch">
                <label>
                <input value="'.$row->id.'" type="checkbox" '.$check.'>
                <span class="lever switch-col-light-blue"></span>
                </label>
                </div>';
            }
            else{
                return "";
            }
        })
        ->addColumn('roles', function ($row) {
          return implode(',', $row->roles->pluck('title')->toArray());
      })
        ->rawColumns(['active','action'])
        ->make(true);
    }

    /**
     * Overide the $rulse varible form the SenseController
     *
     * @param integer $id uses in update to skip rules or alter
     *                    them when updating data
     *
     * @return array
     */
    public function getRules($id = 0)
    {
        $this->rules = [
            'name' => 'required|max:255',
            'phone_no' => 'required|regex:/^(0)[0-9]{9}$/',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6|confirmed',
            'admin_password' => 'required|admin_password',
            'role' => 'required|array',
            'role.*' => 'required|exists:roles,id',
        ];

        if ($id != 0 ) {
            $this->rules = array_except($this->rules, ['password']);
            $this->rules = array_add($this->rules, 'password', 'nullable|min:6|confirmed');
        }

        return $this->rules;
    }

    public function profileUpdate(Request $request)
    {
      if (auth()->user()->id === 1) {
        return response()->json(['msg' => 'can not update admin account'] , 422);
    }
    $user = auth()->user();
    $this->validate($request, [
        'name' => 'required|max:255',
        'phone_no' => 'required|regex:/^(0)[0-9]{9}$/',
        'email' => 'required|email|unique:users,email,'.$user->id,
    ]);

    $user->update([
        'name' => $request->name,
        'phone_no' => $request->phone_no,
        'email' => $request->email,
    ]);

    return response('profile successfully updated', 200);
}

public function resetPassword(Request $request)
{
  if (auth()->user()->id === 1) {
    return response()->json(['msg' => 'can not update admin account'] , 422);
}

$user = auth()->user();

$this->validate($request, [
    'password' => 'required|min:6|confirmed',
    'old_password' => 'required|old_password',
]);

$user->update([
    'password' => bcrypt($request->password),
]);

return response('password successfully updated', 200);

}
}
