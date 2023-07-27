<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoorRequest;
use App\Models\DoorParameter;
use App\Services\DoorService;
use Illuminate\Support\Facades\Redirect;

class DoorController extends Controller
{
    protected $doorService;

    public function __construct(DoorService $doorService)
    {
        $this->doorService = $doorService;
    }

    public function store(StoreDoorRequest $request)
    {
        $this->doorService->storeDoorAndSendPdf($request);
        echo '<script>alert("PDF успешно отправлен в Telegram");</script>';
        return Redirect::to('/');
    }
}
