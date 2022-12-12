<?php

namespace App\Http\Controllers;

use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function index()
    {
//        DB::enableQueryLog();
//        User::all();
//
////        $id = 89;
////        $data = User::select('id')->where(['id' => $id])->where(['name' => 'shakil'])->exists();
//////
//////
////        $data = Test::where(['id' => 11])->exists();
////
////        $data = User::where(['id' => 11])
////            ->where(['name' => 'shakil'])->count();
////
////        $data = User::where(['id' => 11])
////            ->where(['name' => 'shakil'])->first();
//
//        $query = DB::getQueryLog();
//
//        Log::info('Query Log ', $query);

//        dd($query);

//        return [
//            $query,
//            $data
//        ];



        return dd([
            'message' => "After domain use below end-point",
            'end-point' => [
                'bulk create' => '/create',
                'for single create' => '/singleCreate',
                'for single Select' => '/singleSelect',
                'for all Select' => '/allSelect',
                'for logs view' => '/logs',
            ]
        ]);



    }


    public function create()
    {
        DB::enableQueryLog();

        $data = [];

        foreach (range(1, 100) as $user) {
            $name = \Illuminate\Support\Str::random(4);
            $data[] = [
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => Hash::make($name),
            ];
        }

        $data = User::insert($data);

        $query = DB::getQueryLog();

        Log::info('', $query);

        return dd($data);

    }


    public function singleCreate()
    {

        DB::enableQueryLog();

        $name = \Illuminate\Support\Str::random(4);

        $data = User::create([
            'name' => $name,
            'email' => $name . '@gmail.com',
            'password' => Hash::make($name),
        ]);

        $query = DB::getQueryLog();

        Log::info('', $query);

        return dd($data);
    }


}
