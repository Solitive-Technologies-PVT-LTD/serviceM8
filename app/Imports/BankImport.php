<?php

namespace App\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\Bank;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class BankImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach($collection as $key=>$data)
        {
         if($key != 0)
         {
            $bank = new Bank();
            $bank->name = $data['1'];
            $bank->save();
        }
        }
    }
}