<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $merchants = [
            'Shopee',
            'ShopeeFood',
            'Tokopedia',
            'Gofood',
            'Gocar',
            'Gojek',
            'Blibli',
            'Indrive',
            'Indihome',
            'Megavision',
            'Netflix',
            'Spotify',
            'Informa',
            'Apotik Kimia Farma',
            'Barbershop',
            'Course Online',
            'Alfamart',
            'Griya'
        ];
        $transactions = [];
        for ($i=0; $i < 1000; $i++) {
            $start_date = new Carbon('2023-01-01');
            $date = $start_date->addDays($i)->format('Y-m-d');
            for ($j=0; $j < random_int(1,8); $j++) {
                $merchant = $merchants[random_int(0, (count($merchants) - 1))];
                $transactions[] = [
                    'category_id' => $this->getCategory($merchant),
                    'merchant' => $merchant,
                    'transaction_date' => $date,
                    'transaction_type' => 'outcome',
                    'description' => '-',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'amount' => random_int(50000, 200000)
                ];
            }

        }
        Transaction::insert($transactions);
    }

    private function getCategory($merchant) {
          $categoryMapping = [
            'Transportation' => ['Gocar','Gojek','Indrive'],
            'Food & Drinks' => ['ShopeeFood','Gofood'],
            'Groceries' => ['Griya', 'Alfamart'],
            'Bills & Utilities' => ['Indihome','Megavision'],
            'Housing' => ['Informa'],
            'Shopping' => ['Blibli','Shopee','Tokopedia'],
            'Entertainment' => ['Netflix','Spotify'],
            'Health & Beauty' => ['Barbershop', 'Apotik Kimia Farma'],
            'Education' => ['Course Online'],
        ];

        foreach ($categoryMapping as $key => $value) {
            $category = in_array($merchant,$value);
            if($category) return Category::where('name', $key)->first('id')->id;
        }
    }
}
