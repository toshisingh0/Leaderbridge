<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientsExport implements FromCollection
{
    public function collection()
    {
        return Client::all(['id','name','company','email','phone','source','created_at']);
    }
}
