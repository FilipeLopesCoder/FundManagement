<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Funds;
use App\Models\FundManagers;
use Exception;

class FundsController extends Controller
{
    //
    public function list(Request $request): JsonResponse
    {
        $funds = [];
        $where = [];

        $filters = $request->input('filters');

        if( !empty($filters[0]['name']) ){ array_push($where, ['name' , 'LIKE', '%' . $filters[0]['name'] . '%']); }
        if( !empty($filters[0]['startYear']) ){ array_push($where, [ 'startYear' , $filters[0]['startYear'] ]); }
        //TODO: correlacionar coma outra tabela
        // if( $filters[0]['manager'] ){ array_push($where, ['manager' , 'LIKE', '%' . $filters[0]['manager'] . '%']); }

        foreach (Funds::where($where)->get() as $index => $fund) {
            $fundmanagerwhere = ['fund_id' => $fund['fund_id'] ];
            $manager = FundManagers::where($fundmanagerwhere)->get();
            $fund['FundManagers'] = $manager;
            $funds[$index] = $fund;
        }

        return response()->json($funds, 200);
    }

    public function single(Request $request, string $id): JsonResponse
    {
        $data = [];
        $where = ['fund_id' => $id];
        foreach (Funds::where($where)->get() as $index => $fund) {
            $data[$index] = $fund;
        }

        return response()->json($data, 200);
    }

    public function create(Request $request): JsonResponse
    {
        try{
            if( !$request->input('name') || !$request->input('startYear') || !$request->input('alias')){
                throw new Exception('incomplete fields.');
            }

            $fundData = [
                'name' => $request->input('name'),
                'startYear' => $request->input('startYear'),
                'alias' => $request->input('alias')
            ];

            $newFund = Funds::create($fundData);
            
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
        try{
            if( empty($id) ){
                throw new Exception('An fund id must be informed');
            }

            $fund = Funds::find($id);
            
            if( empty($fund) ){
                throw new Exception('Fund not found. Verify the id informed');
            }

            $changed = [];

            $fields = $request->input('fields');

            if( !empty($fields[0]['name']) ){
                $fund->name = $fields[0]['name'];
                array_push($changed, ['name' => $fields[0]['name']] );
            }
            if( !empty($fields[0]['startYear']) ){
                $fund->startYear = $fields[0]['startYear'];
                array_push($changed, ['startYear' => $fields[0]['startYear']] );
            }
            if( !empty($fields[0]['alias']) ){
                $fund->alias = $fields[0]['alias'];
                array_push($changed, ['alias' => $fields[0]['alias']] );
            }
            
            $fund->save();

            $data = ["id" => $id, "changed" => $changed];
            return response()->json($data, 200);
        }catch(Exception $caught){
            return response()->json($caught->getMessage(), 500);
        }
    }
}
