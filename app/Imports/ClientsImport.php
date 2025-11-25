<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Client([
            'name'      => $row['name'],
            'company'   => $row['company'] ?? null,
            'email'     => $row['email'] ?? null,
            'phone'     => $row['phone'] ?? null,
            'source'    => 'import',
            'notes'     => $row['notes'] ?? null,
            'owner_id'  => auth()->id(),
        ]);
    }
}
