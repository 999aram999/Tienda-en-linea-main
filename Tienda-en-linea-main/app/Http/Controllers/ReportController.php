<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Payment;
use App\Client;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function reports_day(){
        $sales = Sale::WhereDate('sale_date', Carbon::today('America/Mexico_City'))->where('status','VALID')->get();
        $total = $sales->sum('total');
        return view('admin.report.reports_day', compact('sales', 'total'));
    }
    public function reports_date(){
        $sales = Sale::whereDate('sale_date', Carbon::today('America/Mexico_City'))->where('status','VALID')->get();
        $total = $sales->sum('total');
        return view('admin.report.reports_date', compact('sales', 'total'));
    }
    public function report_results(Request $request){
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $sales = Sale::whereBetween('sale_date', [$fi, $ff])->where('status','VALID')->get();
        $total = $sales->sum('total');
        return view('admin.report.reports_date', compact('sales', 'total')); 
    }

    public function reports_payments_day(){
        $payments = Payment::WhereDate('payment_date', Carbon::today('America/Mexico_City'))->get();
        $total = $payments->sum('quantity');
        return view('admin.report.reports_payments_day', compact('payments', 'total'));
    }
    public function reports_payments_date(){
        $payments = Payment::whereDate('payment_date', Carbon::today('America/Mexico_City'))->get();
        $total = $payments->sum('quantity');
        return view('admin.report.reports_payments_date', compact('payments', 'total'));
    }
    public function report_payments_results(Request $request){
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $payments = Payment::whereBetween('payment_date', [$fi, $ff])->get();
        $total = $payments->sum('quantity');
        return view('admin.report.reports_payments_date', compact('payments', 'total')); 
    }
    public function reports_saldos()
    {
       
        $clients= Client::get();
        $saldos=Sale::where('status','VALID');
        $total= $saldos->sum('saldo');
       
        return view ('admin.report.reports_saldos', compact('clients','total'));
    }
}
