<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Transaction([
            'merchant' => $row['merchant'],
            'amount' => $row['amount'],
            'category_id' => $this->getCategory($row['merchant']),
            'transaction_date' => $row['transaction_date'],
            'transaction_type' => $row['transaction_type'],
            'description' => $row['description'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public static function getCategory($merchant)
    {
        $categoryMapping = [
            'Transportation' => ['Gocar', 'Gojek', 'Indrive'],
            'Food & Drinks' => ['ShopeeFood', 'Gofood'],
            'Groceries' => ['Griya', 'Alfamart'],
            'Bills & Utilities' => ['Indihome', 'Megavision'],
            'Housing' => ['Informa'],
            'Shopping' => ['Blibli', 'Shopee', 'Tokopedia'],
            'Entertainment' => ['Netflix', 'Spotify'],
            'Health & Beauty' => ['Barbershop', 'Apotik Kimia Farma'],
            'Education' => ['Course Online'],
        ];

        foreach ($categoryMapping as $key => $value) {
            $category = in_array($merchant, $value);
            if ($category) return Category::where('name', $key)->first('id')->id;
        }
    }
}
