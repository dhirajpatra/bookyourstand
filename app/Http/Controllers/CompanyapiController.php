<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use App\Stand;

class CompanyapiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function registration(Request $request)
    {
        try {

            $companyName = $request->input('company_name');
            $companyAdmin = $request->input('admin');
            $companyEmail = $request->input('admin_email');
            $companyPhone = $request->input('phone');
            $companyAdd1 = $request->input('add1');
            $companyAdd2 = $request->input('add2');
            $companyZip = $request->input('zip');

            $standId = $request->input('stand_id');

            $company = new Company();
            $company->admin = $companyAdmin;
            $company->name = $companyName;
            $company->email = $companyEmail;
            $company->phone = $companyPhone;
            $company->add1 = $companyAdd1;
            $company->add2 = $companyAdd2;
            $company->zip = $companyZip;
            $company->save();
            $companyId = $company->id;
            
            $stand = new Stand();
            $result = $stand->reserveStand(array(
                'companyId' => $companyId,
                'standId' => $standId
            ));

            if(is_numeric($result) &&  $result > 0){
                $statusCode = 200;
                return response(array(
                    'error' => false,
                    'message' =>'Reserved stand successfully',
                    'company' => $companyId
                ), $statusCode);

            }else{
                $statusCode = 400;
                return response(array(
                    'error' => true,
                    'message' =>'Reserved stand save error',
                ), $statusCode);

            }

        } catch (\Exception $e){

            $statusCode = $e->getCode();
            return response(array(
                'error' => true,
                'message' => $e->getMessage(),
            ), $statusCode);

        }
    }
}
