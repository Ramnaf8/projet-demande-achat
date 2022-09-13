<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historique;
use Illuminate\Http\Response;

class HistoriqueController extends Controller
{
    public function index($user_id)
    {
        $Historiques = Historique::where('user_id', $user_id)->get();

        return $this->successResponse($Historiques);
    }


    public function show($user_id, $id)
    {
        $Historique = Historique::findOrFail($id);
        if ($Historique->user_id != $user_id) {
            return $this->errorResponse("Erreur d'autorisation.",
                Response::HTTP_FORBIDDEN);
        }

        return $this->successResponse($Historique);

    }
    public function store($user_id, Request $request)
    {
        

        $Historique = Historique::create([
            'user_id' => $user_id,
            'produit_id' => $request->input('produit_id'),
            'quantite' => $request->input('quantite'),
            'prix_total' => $request->input('prix_total'),
        ]);

        return $this->successResponse($Historique);

    }
}
