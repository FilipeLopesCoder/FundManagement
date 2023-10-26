<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\CompanyInvestment;
use Exception;

class CompanyInvestmentController extends Controller
{
    //
    public function list(Request $request): JsonResponse
    {
        $companyInvestments = [];
        $where = [];

        $filters = $request->input('filters');

        if( !empty($filters[0]['name']) ){ array_push($where, ['name' , 'LIKE', '%' . $filters[0]['name'] . '%']); }
        if( !empty($filters[0]['startYear']) ){ array_push($where, [ 'startYear' , $filters[0]['startYear'] ]); }
        //TODO: correlacionar coma outra tabela
        // if( $filters[0]['manager'] ){ array_push($where, ['manager' , 'LIKE', '%' . $filters[0]['manager'] . '%']); }

        foreach (CompanyInvestment::where($where)->get() as $index => $companyInvestment) {
            $companyInvestments[$index] = $companyInvestment;
        }

        return response()->json($companyInvestments, 200);
    }
    public function single(Request $request, string $id): JsonResponse
    {

    }
    public function create(Request $request): JsonResponse
    {
        try{
            if( !$request->input('company_id') || !$request->input('fund_id') ){
                throw new Exception('incomplete fields.');
            }

            $companyData = [
                'company_id' => $request->input('company_id'),
                'fund_id' => $request->input('fund_id')
            ];

            $newCompany = CompanyInvestment::create($companyData);
            
            if( !$newCompany ){
                throw new Exception('the include of the new company could not be completed.');
            }
            
            $data = $newCompany;

            return response()->json($data, 200);
        }catch(Exception $caught){
            return response()->json($caught->getMessage(), 500);
        }
    }
    public function edit(Request $request, string $id): JsonResponse
    {

    }
}
