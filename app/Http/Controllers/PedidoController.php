<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::with('cliente')->with('productos')->paginate(10);
        return response()->json($pedidos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        {
            cliente_id: 2,
            productos: [
                {id: 1, cantidad: 3},
                {id: 3, cantidad: 2},
                {id: 4, cantidad: 1}
            ]
        }       
        */
        DB::beginTransaction();
        try {
            $ped = new Pedido();
            $ped->fecha_pedido = date("Y-m-d H:i:s");
            $ped->cliente_id = $request->cliente_id;
            $ped->save();
    
            // asignar productos
            foreach ($request->productos as $prod) {
                $id = $prod["id"];
                $cant = $prod["cantidad"];
                $ped->productos()->attach($id, ["cantidad" => $cant]);
            }
            DB::commit();

            return response()->json(["mensaje" => "Pedido registrado"], 201);
        } catch (\Exception  $e) {
            DB::rollback();

            return response()->json([
                                        "mensaje" => "Ocurrio un problema al registrar",
                                        "error" => $e
                                    ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
