<?php

namespace App\Http\Controllers;

use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function index()
    {
        DB::enableQueryLog();
        User::all();

//        $id = 89;
//        $data = User::select('id')->where(['id' => $id])->where(['name' => 'shakil'])->exists();
////
////
//        $data = Test::where(['id' => 11])->exists();
//
//        $data = User::where(['id' => 11])
//            ->where(['name' => 'shakil'])->count();
//
//        $data = User::where(['id' => 11])
//            ->where(['name' => 'shakil'])->first();

        $query = DB::getQueryLog();

        Log::info('Query Log ', $query);

//        dd($query);

//        return [
//            $query,
//            $data
//        ];
    }
}
