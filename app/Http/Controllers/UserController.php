<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with('meta')->paginate(10);
        return view('user', ['users' => $user]);
    }

    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = User::query()->create($request->only('name', 'email', 'mobile'));
            $user->meta()->create($request->get('meta'));
            DB::commit();
            return response()->json('User Created Successful');
        } catch (\Exception $exception) {
            return response()->json('User Created Failed', 500);
        }
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = User::query()->findOrFail($id);
            $user->update($request->only('name', 'email', 'mobile'));
            Meta::query()->updateOrCreate(['user_id' => $user->id], $request->get('meta'));
            DB::commit();
            return response()->json('User Update Successful');
        } catch (\Exception $exception) {
            return response()->json('User Update Failed', 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $user = User::query()->findOrFail($id);
            $user->delete();
            return response()->json('User Deleted Successful');
        } catch (\Exception $exception) {
            return response()->json('User Deleted Failed', 500);
        }
    }
}
