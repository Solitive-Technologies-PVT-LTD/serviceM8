<?php

namespace App\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Customer;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class CustomerImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach($collection as $key=>$data)
        {
         if($key != 0 && $key != 1)
         {
            $customer = new Customer();
            $customer->name = $data['1'];
            $customer->code=$data['0'];
            $accountant=User::where('office_name',$data['2'])->where('designation_name','Initiater')->first();
            if($accountant)
            {
                $customer->accountant_id=$accountant->id;
                $customer->save();
            }
            
         }
        }
    }
}