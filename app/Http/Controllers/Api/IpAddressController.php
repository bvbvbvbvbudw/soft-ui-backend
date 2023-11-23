<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InformationTask;
use App\Models\IpAdress;
use App\Models\Status;
use Illuminate\Http\Request;

class IpAddressController extends Controller
{
    public function save(Request $request)
    {
        $ipAddress = $request->input('ipAddress');
        $score = $request->input('score');
        try {
            IpAdress::updateOrCreate(
                ['ip' => $ipAddress], // Поиск записи по IP-адресу
                ['score' => $score] // Увеличение счетчика на 1
            );
            return response()->json(['message' => 'IP address saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error saving IP address'], 500);
        }
    }
}
