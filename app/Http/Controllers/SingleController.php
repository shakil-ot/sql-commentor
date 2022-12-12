<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SingleController extends Controller
{

    public function singleSelect()
    {

        DB::enableQueryLog();

        $name = \Illuminate\Support\Str::random(4);

        $data = User::select('*')->where(['id' => 2])->first();

        $query = DB::getQueryLog();

        Log::info('', $query);

        return dd($data);
    }


    public function allSelect()
    {

        DB::enableQueryLog();

        $name = \Illuminate\Support\Str::random(4);

        $data = User::all();

        $query = DB::getQueryLog();

        Log::info('', $query);

        return dd($data);
    }
}
