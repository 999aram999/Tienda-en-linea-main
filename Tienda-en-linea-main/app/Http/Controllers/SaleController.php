<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use App\saleDetails;
use App\Http\Requests\Sale\StoreRequest;
use App\Http\Requests\Sale\UpdateRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sales= Sale::get();
        return view ('admin.sale.index', compact('sales'));
        
    }

    public function create()
    {
        $clients= User::role('Client')->get();
        $products = Product::where('status', 'ACTIVE')->get();
        return view ('admin.sale.create', compact('clients','products'));
    }

    public function store(StoreRequest $request)
    {
       $valor=$request->total;
        $sale = Sale::create($request->all()+[

            'saldo'=>$valor,
            'user_id'=>Auth::user()->id,
            'sale_date'=>Carbon::now('America/Mexico_City'),
            
          
        ]);
        foreach ($request->product_id as $key => $product) {
            $results[] = array("product_id"=>$request->product_id[$key], "quantity"=>$request->quantity[$key], "price"=>$request->price[$key], "discount"=>$request->discount[$key]);
        }
        $sale->saleDetails()->createMany($results);
        return redirect()->route('sales.index');
       
    }
   

    public function show(Sale $sale)
    {
        $venta=$sale->id;
        $subtotal = 0 ;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity*$saleDetail->price-$saleDetail->quantity* $saleDetail->price*$saleDetail->discount/100;
        }

        $ventas=DB::select("SELECT p.id as id,
         p.payment_date as payment_date , p.quantity as quantity from payments p 
         where p.sale_id = '$venta' group by p.id , p.payment_date, p.quantity");

        return view('admin.sale.show', compact('sale', 'saleDetails', 'subtotal','venta','ventas'));
    }

    public function edit(Sale $sale)
    {
       // $clients=Client::get();
        //return view ('admin.sale.show', compact('sale'));
    }

    public function update(UpdateRequest $request, Sale $sale)
    {
        //$sale->update($request->all());
        //return redirect()->route('sales.index');
    }

    public function destroy(Sale $sale)
    {
       // $sale->delete();
        //return redirect()->route('sales.index');

    }

    public function pdf(Sale $sale)
    {
        
        $subtotal = 0 ;
        $saleDetails = $sale->saleDetails;
        foreach ($saleDetails as $saleDetail) {
            $subtotal += $saleDetail->quantity*$saleDetail->price-$saleDetail->quantity* $saleDetail->price*$saleDetail->discount/100;
        }
        $pdf = PDF::loadView('admin.sale.pdf', compact('sale', 'subtotal', 'saleDetails'));
        return $pdf->download('Reporte_de_venta_'.$sale->id.'.pdf');
    }
  

    public function print(Sale $sale){
        try {
            $subtotal = 0 ;
            $saleDetails = $sale->saleDetails;
            foreach ($saleDetails as $saleDetail) {
                $subtotal += $saleDetail->quantity*$saleDetail->price-$saleDetail->quantity* $saleDetail->price*$saleDetail->discount/100;
            }  

            $printer_name = "TM20";
            $connector = new WindowsPrintConnector($printer_name);
            $printer = new Printer($connector);

            $printer->text("€ 9,95\n");

            $printer->cut();
            $printer->close();


            return redirect()->back();

        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    
    public function change_status(Sale $sale)
    {
        if ($sale->status == 'VALID') {
            $sale->update(['status'=>'CANCELED']);
            return redirect()->back();
        } else {
            $sale->update(['status'=>'VALID']);
            return redirect()->back();
        } 
    }


   

}
