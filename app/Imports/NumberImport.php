<?php

// namespace App\Imports;

// use App\stock_data;
// use Maatwebsite\Excel\Concerns\ToModel;

// class StockImport implements ToModel
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function model(array $row)
//     {
//         return new stock_data([
//             //
//         ]);
//     }
// }


namespace App\Imports;

use App\numberdetail;
// use App\User;
// use App\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



// }
// $faker fake $faker;
// $faker = fake $faker::create();

// $factory->define(App\User::class, function (Faker $faker){
class NumberImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    public function collection(Collection $rows)
    {
        // $faker = Faker::create();
        foreach ($rows as $row) {
            // $random = mt_rand(13455623, 93455632);
            // $request['password'] = Hash::make($random);

            if(!numberdetail::where('number','=',$row[1])->exists()){
                numberdetail::create([
                    'number' => $row[1],
                    'passcode' => $row[2],
                    'type' => $row[7],
                    'channel_type' => $row[8],
                ]);
                // StockData::create([
                //     'vendor' => $row[0],
                //     'model' => $row[1],
                //     'description' => $row[2],
                //     'shipping_type' => $row[3],
                //     'SKU' => $row[4],
                //     'stock' => $row[5],
                //     'CP' => $row[6],
                //     'product_title' => $row[7],
                //     'storage' => $row[8],
                //     'cpu' => $row[9],
                //     'DDR' => $row[10],
                //     'video_graphics' => $row[11],
                //     'display' => $row[12],
                //     'price' => $row[13],
                //     // 'father_name' => $row[4],
                //     // 'email' => $faker->unique()->email,
                //     // 'secondary_email' => $random,
                //     // 'password' => $request['password'],
                //     // 'batch_no' => $row[1],
                //     // 'batch_group' => $row[5],
                //     // 'contact' => $row[6],
                //     // 'f_contact' => $row[7],
                //     // 'address' => $row[8],
                //     // 'form_no' => $row[9],
                //     // 'status' => 1,
                //     ]);
            // }
            // else{
                // return "failed";
            }
        }
    }
    // public function batchSize(): int
    // {
    //     return 500;
    // }

    // public function chunkSize(): int
    // {
    //     return 500;
    // }
}
