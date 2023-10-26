<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\FundManagers;
use Exception;

class FundManagersController extends Controller
{
    //

    public function list(Request $request): JsonResponse
    {
        $fundManagers = [];
        $where = [];

        $filters = $request->input('filters');

        if( !empty($filters[0]['name']) ){ array_push($where, ['name' , 'LIKE', '%' . $filters[0]['name'] . '%']); }
        if( !empty($filters[0]['startYear']) ){ array_push($where, [ 'startYear' , $filters[0]['startYear'] ]); }
        //TODO: correlacionar coma outra tabela
        // if( $filters[0]['manager'] ){ array_push($where, ['manager' , 'LIKE', '%' . $filters[0]['manager'] . '%']); }

        foreach (FundManagers::where($where)->get() as $index => $fund) {
            $fundManagers[$index] = $fundManager;
        }

        return response()->json($fundManagers, 200);
    }
    public function single(Request $request, string $id): JsonResponse
    {

    }
    public function create(Request $request): JsonResponse
    {
        try{
            if( !$request->input('fund_id') || !$request->input('company_id')){
                throw new Exception('incomplete fields.');
            }

            $fundManagers = [
                'fund_id' => $request->input('fund_id'),
                'company_id' => $request->input('company_id'),
            ];

            $newFund = FundManagers::create($fundManagers);
            
            if( !$newFund ){
                throw new Exception('the include of the new fund could not be completed.');
            }
            
            $data = $newFund;

            return response()->json($data, 200);
        }catch(Exception $caught){
            return response()->json($caught->getMessage(), 500);
        }
    }
    public function edit(Request $request, string $id): JsonResponse
    {

    }
}
