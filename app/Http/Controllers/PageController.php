<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
                ->where('is_rented', 0)
                ->where('visible', 1)
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
        // DB::enableQueryLog();

        if(DB::table('cars')->select('visible')->where('id', $id)->value('visible')==0){
            return redirect('/home');
        }

        if(DB::table('cars')->select('is_rented')->where('id', $id)->value('is_rented')==0){
            $car = DB::table('cars as c')
                    ->joinSub(DB::table('users')->select('id as id1', 'name as owner_name'), 'u1', 'owner_id', 'id1')
                    ->select('c.id as id', 'c.image as image', 'c.type as type', 'c.owner_id as owner_id', 'c.price as price', 'owner_name', 'c.address as address', 'c.latitude as latitude', 'c.longitude as longitude', 'c.is_rented as is_rented')
                    ->where('c.id', $id)
                    ->first();
        }
        else{
            $car = DB::table('cars as c')
                    ->joinSub(DB::table('users')->select('id as id1', 'name as owner_name'), 'u1', 'owner_id', 'id1')
                    ->join('transactions as t', 't.car_id', 'c.id')
                    ->joinSub(DB::table('users')->select('id as id2', 'name as user_name'), 'u2', 't.user_id', 'id2')
                    ->select('car_id as id', 'c.image as image', 'c.type as type', 'c.price as price', 'c.owner_id as owner_id', 'owner_name', 'c.address as address', 'c.latitude as latitude', 'c.longitude as longitude', 'c.is_rented as is_rented', 'user_name')
                    ->where('c.id', $id)
                    ->first();

        }

        return view('car', compact('car'));
    }

    function hire(Request $request){

        $rules = [
            'end' => 'after_or_equal:start',
            'start' => 'after_or_equal:now'
        ];

        $message = [
            'end.after_or_equal' => 'End date must be after start date.',
            'start.after_or_equal' => 'Start date must be after current date.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'car_id' => $request->car_id,
            'start_date' => $request->start,
            'end_date' => $request->end,
        ]);

        $update = Car::where('id', $request->car_id)->update(['is_rented' => True]);

        return redirect('/home');
    }

    function history(){
        $user_id = auth()->user()->id;
        $transactions = DB::table('transactions as t')
                        ->join('cars as c', 't.car_id', 'c.id')
                        ->select('t.*', 'c.type', 'c.price')
                        ->where('user_id', $user_id)
                        ->orderBy('t.start_date', 'desc')
                        ->get();

        return view('history', compact('transactions'));
    }

    function schedule(){
        $user_id = auth()->user()->id;

        $now = date("Y-m-d");


        $ongoing = DB::table('transactions as t')
                   ->join('cars as c', 't.car_id', 'c.id')
                   ->select('t.*', 'c.type')
                   ->where('user_id', $user_id)
                   ->whereDate('start_date', '<=', $now)
                   ->whereDate('end_date', '>=', $now)
                   ->orderBy('t.start_date', 'asc')
                   ->get();

        $upcoming = DB::table('transactions as t')
                    ->join('cars as c', 't.car_id', 'c.id')
                    ->select('t.*', 'c.type')
                    ->where('user_id', $user_id)
                    ->whereDate('start_date', '>', $now)
                    ->whereDate('end_date', '>', $now)
                    ->orderBy('t.start_date', 'asc')
                    ->get();

        return view('schedule', compact('ongoing', 'upcoming'));
    }

    function carList(){
        $user_id = auth()->user()->id;

        $cars = DB::table('cars')
                ->select('*')
                ->where('owner_id', $user_id)
                ->where('visible', 1)
                ->get();

        return view('profilecarlist', compact('cars'));
    }
}
