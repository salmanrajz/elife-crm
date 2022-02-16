<?php

namespace App\Imports;

use App\elife_bulker;
use App\NumberDataBank;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class elife_bulk implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 2;
    }
    public function collection(Collection $collection)
    {
        //
        // dd($collection);
        foreach ($collection as $row) {
            // $random = mt_rand(13455623, 93455632);
            // $request['password'] = Hash::make($random);
            if (!NumberDataBank::where('mobile', '=', $row[2])->exists()) {
                NumberDataBank::create([
                    'name' => $row[1],
                    'mobile' => $row[2],
                    'building' => $row[3],
                    'tenant_type' => $row[4],
                    'email' => $row[5],
                    'makani_eid' => $row[6],
                    'contract_date' => $row[7],
                    // 'statu' => $row[4],
                    // 'channel_type' => $row[8],
                ]);
            }
        }
    }
}
