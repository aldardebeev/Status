<?php

namespace App\Services;

use App\Http\Requests\StoreDoorRequest;
use App\Models\Door;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class DoorService
{
    public function storeDoorAndSendPdf(StoreDoorRequest $request)
    {
        // Получаем валидированные данные из Request
        $validatedData = $request->validated();

        // Создаем новую дверь и заполняем её данными из запроса
        $door = new Door();
        $door->fill($validatedData);

        // Сохраняем дверь в базу данных
        $door->save();

        // Генерируем PDF с данными о двери
        $pdf = Pdf::loadView('pdf.template', ['door' => $door])->set_option('isRemoteEnabled', true);

        // Отправляем PDF в Telegram
        $telegramBotToken = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        Http::attach(
            'document',
            $pdf->output(),
            'door_configuration.pdf',
            ['Content-Type' => 'application/pdf']
        )->post($telegramBotToken, ['chat_id' => $chatId]);


    }
}