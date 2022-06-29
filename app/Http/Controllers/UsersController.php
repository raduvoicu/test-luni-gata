<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Roles;

class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        file_get_contents('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css');
        $users = User::where(function ($query) {
//            $query->where('email', 'like', 'p%')
//                ->orWhere('email', 'like', 'c%')
//                ->orWhere('email', 'like', '%com');
        })->first()->paginate(7);
        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return Response
     */
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [

        ]));

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function showCurrentUser()
    {

        return view('users.show', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return Response
     */
    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }

    public function allUsers(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'userRole',
            4 => 'expiration_date',
            5 => 'actions'
        );
        $totalData = User::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $query = User::leftJoin('roles', 'users.userRole', '=', 'roles.id')
            ->select(DB::raw('users.*, roles.role as role'))
            ->when((!empty($search)), function ($query) use ($search) {

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('role', 'LIKE', "%{$search}%");
                });
            });


        $totalFilters = $query->count();

        $rows = $query->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)
            ->get();


        $data = array();
        if (!empty($rows)) {
            foreach ($rows as $row) {

                $nestedData['id'] = $row->id;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['userRole'] = $row->role;
                $nestedData['expiration_date'] = $row->expiration_date;
                if (Auth::user()['userRole'] == 1) {
                    $nestedData['actions'] = "<a class=\"btn btn-outline-success\" href=\"/users/$row->id/show\">Show</a>
                                            <a class=\"btn btn-outline-warning\" href=\"/users/$row->id/edit\">Edit</a>
                                                <a class=\"btn btn-outline-danger\" onclick=\"return confirm('Are you sure you want to delete user $row->name?')\" href=\"/users/$row->id/delete\">Delete</a>";
                }
                $data[] = $nestedData;

            }
        }


        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);

    }
}
