<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use APP\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_name = $user->name;
        $yyyymmdd = date_format(Carbon::now(), 'Ymd' );
        $param = Attendance::where('user_id', '=', $user->id)->get();
        $param = ['user_name'=>$user_name, 'yyyymmdd'=>$yyyymmdd];
        return view('index', $param);
    }

    public function start(Request $request)
    {
        $user_id = Auth::id();
        $date = date_format(Carbon::now(), 'Ymd' );
        $form = ['user_id'=>$user_id, 'date'=>$date];
        Attendance::create($form);
        return redirect('/');
    }

    public function end(Request $request)
    {
        $end_time = Carbon::now();
        // Attendance::where()
        return view('index', $request);
    }

    public function list(Request $request)
    {
        $date = $request->yyyymmdd;
        $data = Attendance::where('date')->paginate(5);
        return view('list', ['yyyymmdd'=>$date]);
    }

    public function page(Request $request)
    {
        $paginate->page = $page;
        view('date', ['page'->$page]);
    }

}
