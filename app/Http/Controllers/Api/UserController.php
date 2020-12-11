<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\Api\UserResource;
use App\Jobs\Api\SaveLastTokenJob;
use App\Jobs\Queue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(3);

        return UserResource::collection($users);
    }

    //返回单一用户信息
    public function show(User $user)
    {
        return $this->success(new UserResource($user));
    }

    //用户注册
    public function store(UserRequest $request)
    {
        User::create($request->all());

        return $this->setStatusCode(201)->success('用户注册成功');
    }

    //用户登录
    public function login(Request $request)
    {
        //获取当前守护的名称
        $present_guard = Auth::getDefaultDriver();
        $token = Auth::claims(['guard' => $present_guard])->attempt(['name' => $request->name, 'password' => $request->password]);
        if ($token) {
            //如果登陆，先检查原先是否有存token，有的话先失效，然后再存入最新的token
            $user = Auth::user();
            if ($user->last_token) {
                try {
                    Auth::setToken($user->last_token)->invalidate();
                } catch (TokenExpiredException $e) {
                    //因为让一个过期的token再失效，会抛出异常，所以我们捕捉异常，不需要做任何处理
                }
            }
            SaveLastTokenJob::dispatch($user, $token);

            return $this->setStatusCode(201)->success(['token' => 'bearer '.$token]);
        }

        return $this->failed('用户登录失败', 401);
    }

    //用户退出
    public function logout()
    {
        Auth::logout();

        return $this->success('退出成功...');
    }

    //返回当前登录用户信息
    public function info()
    {
//        1/0;
        $arr = [
            ['id' => 1, 'title' => '张三'],
            ['id' => 2, 'title' => '李四'],
            ['id' => 3, 'title' => '王五'],
        ];

        foreach ($arr as $v) {
            $queue = new Queue($v['id'], $v['title']);
            $this->dispatch($queue);
        }

        return response(0, '200');

        $user = Auth::user();

        return $this->success(new UserResource($user));
    }
}
