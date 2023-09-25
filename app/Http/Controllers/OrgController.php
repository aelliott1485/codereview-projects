<?php

namespace App\Http\Controllers;

use App\Models\Org;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgController extends Controller
{
    //
    public function merger()
    {
        //Select main organisations, that have matching addresses on sub-organisations and that is not already merged together.
        $MainOrganisations = DB::table("orgs_main AS j")
            ->selectRaw("DISTINCT j.address, (SELECT COUNT(*) FROM orgs_sub i WHERE i.address = j.address) AS SubCount")
            ->whereRaw("(SELECT COUNT(*) FROM orgs_sub i WHERE i.address = j.address AND i.merged=0) > 0")
            ->simplePaginate(10);

        //Loop through the main companies, so we get all main companies with the same address.
        foreach($MainOrganisations as $key => $SameAddress){
            $CompaniesSameAddress = DB::table('orgs_main')
                ->select('name', 'code')
                ->where('address', $SameAddress->address)
                ->where('code', 'LIKE', '64%')
                ->get();
            $SameAddress->Companies = $CompaniesSameAddress;
        }

        //Foreach found Main Organisation Address, list all the sub companies with this address.
        foreach($MainOrganisations as $key => $MainOrganisation){

            $SubOrganisations = DB::table('orgs_sub')
                ->select('name', 'code', 'id')
                ->where('address', $MainOrganisation->address)
                ->get();
            $MainOrganisation->SubOrganisations = $SubOrganisations;

        }
        //Return the data to our view.
        $data = [
            'MainOrganisations'            => $MainOrganisations,
        ];
        return $data;
    }
}
