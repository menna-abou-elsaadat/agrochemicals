<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Resources\CompanyDataResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\AdvertismentResource;
use App\Models\Advertisment;
use App\Models\CompanyData;
use App\Models\Contact;

class GeneralController extends Controller
{
    public function adv()
    {
        $adv = Advertisment::get();
        $data['advs'] = AdvertismentResource::collection($adv);
         return ApiResponse::sendResponse(200,'Advs Data',$data);
    }

    public function company_data()
    {
        $company_data = CompanyData::get();
        $data['data'] = CompanyDataResource::collection($company_data);
         return ApiResponse::sendResponse(200,'Company Data',$data);
    }

    public function contact_us()
    {
        $contacts = Contact::get();
        $data['contacts'] = ContactResource::collection($contacts);
         return ApiResponse::sendResponse(200,'contacts Data',$data);
    }
}
