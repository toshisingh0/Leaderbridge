<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Files\ExportHandler;

class ClientsExport extends ExportHandler
{
    public function handle()
    {
        return Client::all()->toArray();
    }
}
