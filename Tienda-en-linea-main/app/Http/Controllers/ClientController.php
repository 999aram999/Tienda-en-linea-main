<?php

namespace App\Http\Controllers;

use App\User;
use App\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $clients= User::role('Client')->get();
        return view ('admin.client.index', compact('clients'));
    }

    public function create()
    {
        return view ('admin.client.create');
    }

    
    public function store(StoreRequest $request)
    {
        
        User::create($request->all())->assignRole('Client');
        return redirect()->route('clients.index');

        if($request->sale==1){
            return redirect()->back();
        }
        return redirect()->route('clients.index');
    }

    public function show(User $client)
    {
        
        $cliente= $client->id;
       
        $compras=DB::select("SELECT s.id as id,
         sum(s.total) as saldo, s.user_id as user, s.sale_date as sale_date, s.total as total, s.saldo as saldo from sales s 
         where s.client_id = '$cliente' and s.status='VALID' and s.saldo!= 0 group by s.id , s.user_id, s.sale_date , s.total, s.saldo order by sum(s.total)");
        $total=Sale::where('client_id',$cliente)->where('status','VALID')->sum('saldo');
        return view ('admin.client.show', compact('client','compras','total'));
    }

    
    public function edit(User $client)
    {
        return view ('admin.client.edit', compact('client'));
    }

   
    public function update(UpdateRequest $request, User $client)
    {
        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    public function destroy(User $client)
    {
        $client->delete();
        return redirect()->route('clients.index');

    }

    public function compras(User $client)
    {
        
        $compras=DB::select('SELECT * FROM sales WHERE client_id = client');
       
       
        return view('admin.client.show', compact( 'compras', 'client'));
    }
}
