<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoorRequest;
use App\Models\Door;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DoorController extends Controller
{
    public function store(StoreDoorRequest $request)
    {
        // Получаем валидированные данные из Request
        $validatedData = $request->validated();

        // Создаем новую дверь и заполняем её данными из запроса
        $door = new Door();
        $door->fill($validatedData);

        // Сохраняем дверь в базу данных
        $door->save();

        // Возвращаем представление с данными о двери
        $pdf = Pdf::loadView('pdf.template', array('door' => $door));

        $telegramBotToken = 'https://api.telegram.org/bot6632502241:AAGgvnrqoPa7fv-EtJZT9emstzwZlQdpxEI/sendDocument';
        $chatId = '406438688';

        Http::attach(
            'document',
            $pdf->output(),
            'door_configuration.pdf',
            ['Content-Type' => 'application/pdf']
        )->post($telegramBotToken, ['chat_id' => $chatId]);

    }
}
