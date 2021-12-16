<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //
    // function index($page){
    //     return view($page);
    // }

    function home(){
        $cars = DB::table('cars')
                ->join('users', 'users.id', 'cars.owner_id')
                ->select('cars.*', 'users.name')
                ->get();

        return view('home', compact('cars'));
    }

    function rent(){
        return view('rent');
    }

    function login(){
        return view('login');
    }

    function register(){
        return view('register');
    }

    function car($id){
        if(DB::table('cars')->select('is_rented')->where('id', $id)->value('is_rented')==0){
            $car = DB::table('cars as c')
                    ->joinSub(DB::table('users')->select('id as id1', 'name as owner_name'), 'u1', 'owner_id', 'id1')
                    ->select('c.id as id', 'c.image as image', 'c.type as type', 'c.owner_id as owner_id', 'c.price as price', 'owner_name', 'c.is_rented as is_rented')
                    ->where('c.id', $id)
                    ->first();
        }
        else{
            $car = DB::table('cars as c')
                    ->joinSub(DB::table('users')->select('id as id1', 'name as owner_name'), 'u1', 'owner_id', 'id1')
                    ->join('transactions as t', 't.id', 'car_id')
                    ->joinSub(DB::table('users')->select('id as id2', 'name as user_name'), 'u2', 't.user_id', 'id2')
                    ->select('car_id as id', 'c.image as image', 'c.type as type', 'c.price as price', 'c.owner_id as owner_id', 'owner_name', 'c.is_rented as is_rented', 'user_name')
                    ->where('car_id', $id)
                    ->first();

        }


        return view('car', compact('car'));
    }

    function hire(Request $request){
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'car_id' => $request->car_id,
            'start_date' => $request->start,
            'end_date' => $request->end,
        ]);

        $update = Car::where('id', $request->car_id)->update(['is_rented' => True]);

        return redirect('/home');
    }
}
