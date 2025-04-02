<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\QrCodes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function memorials()
    {
        $memorials = Memorial::all();
        return view('admin.memorials', compact('memorials'));
    }

    public function codeattach()
    {
        return view('admin.codeattach');
    }

    public function codegenerate()
    {
        return view('admin.codegenerate');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    protected function generateUniqueToken(Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $mod = $request->input('mod');
        $country = $request->input('country');
        $maxAttempts = 10;
    
        $year = date('y');
        $week = str_pad(date('W'), 2, '0', STR_PAD_LEFT);
    
        $prefix = $year . $week . $mod . $country;
        $generatedTokens = [];
        $usedTokens = [];
    
        for ($i = 0; $i < $quantity; $i++) {
            $attempts = 0;
            do {
                $randomPart = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT); // Теперь от 001 до 999
                $token = $prefix . $randomPart;
    
                $existsInDb = QrCodes::where('token', $token)->exists();
                $existsInCurrent = in_array($token, $usedTokens);
                $attempts++;
            } while (($existsInDb || $existsInCurrent) && $attempts < $maxAttempts);
    
            if ($existsInDb || $existsInCurrent) {
                $randomPart = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                $token = $prefix . $randomPart;
    
                if (QrCodes::where('token', $token)->exists() || in_array($token, $usedTokens)) {
                    return redirect()->back()->with('error', 'Unable to generate unique token');
                }
            }
    
            $usedTokens[] = $token;
            $generatedTokens[] = [
                'token' => $token,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
    
        // Сохранение в базу данных
        QrCodes::insert($generatedTokens);
    
        // Подготовка данных для текстового файла
        $fileContent = "Generated QR Codes - " . now()->toDateTimeString() . "\n";
        $fileContent .= "Country: $country\n";
        $fileContent .= "Quantity: $quantity\n";
        $fileContent .= "https://app.rememus.com/memorial/attach/\n";
        $fileContent .= "------------------------\n";
    
        foreach ($usedTokens as $token) {
            $fileContent .= "$token\n";
        }
    
        // Сохранение в текстовый файл
        $fileName = 'qrcodes_' . $prefix . '_' . time() . '.txt';
        Storage::disk('public')->put('qrcodes/' . $fileName, $fileContent);
    
        $fileUrl = 'https://app.rememus.com/storage/qrcodes/' . $fileName;
    
        return redirect()->back()
            ->with('success', "Generated {$quantity} QR codes successfully")
            ->with('file_path', $fileUrl);
    }
    
    // protected function generateUniqueToken(Request $request)
    // {
    //     // dd($request);
    //     $quantity = $request->input('quantity', 1);
    //     $mod = $request->input('mod');
    //     $country = $request->input('country');
    //     $maxAttempts = 10;

    //     $year = date('y');
    //     $week = str_pad(date('W'), 2, '0', STR_PAD_LEFT);

    //     $prefix = $year . $week . $mod . $country;
    //     $generatedTokens = [];
    //     $usedTokens = [];

    //     for ($i = 0; $i < $quantity; $i++) {
    //         $attempts = 0;
    //         do {
    //             $randomPart = str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
    //             $token = $prefix . $randomPart;

    //             $existsInDb = QrCodes::where('token', $token)->exists();
    //             $existsInCurrent = in_array($token, $usedTokens);
    //             $attempts++;
    //         } while (($existsInDb || $existsInCurrent) && $attempts < $maxAttempts);

    //         if ($existsInDb || $existsInCurrent) {
    //             $randomPart = substr(time() . rand(0, 9999), -6);
    //             $token = $prefix . $randomPart;

    //             if (QrCodes::where('token', $token)->exists() || in_array($token, $usedTokens)) {
    //                 return redirect()->back()->with('error', 'Unable to generate unique token');
    //             }
    //         }

    //         $usedTokens[] = $token;
    //         $generatedTokens[] = [
    //             'token' => $token,
    //             'created_at' => now(),
    //             'updated_at' => now()
    //         ];
    //     }

    //     // Сохранение в базу данных
    //     QrCodes::insert($generatedTokens);

    //     // Подготовка данных для текстового файла
    //     $fileContent = "Generated QR Codes - " . now()->toDateTimeString() . "\n";
    //     $fileContent .= "Country: $country\n";
    //     $fileContent .= "Quantity: $quantity\n";
    //     $fileContent .= "https://app.rememus.com/memorial/attach/\n";
    //     $fileContent .= "------------------------\n";

    //     foreach ($usedTokens as $token) {
    //         $fileContent .= "$token\n";
    //     }

    //     // Сохранение в текстовый файл
    //     $fileName = 'qrcodes_' . $prefix . '_' . time() . '.txt';
    //     Storage::disk('public')->put('qrcodes/' . $fileName, $fileContent);

    //     $fileUrl = 'https://app.rememus.com/storage/qrcodes/' . $fileName;

    //     return redirect()->back()
    //         ->with('success', "Generated {$quantity} QR codes successfully")
    //         ->with('file_path', $fileUrl);
    // }

    public function codelink(Request $request)
    {
        $request->validate([
            'token' => 'required|string|exists:qr_codes,token',
            'memorial_id' => 'required|string|max:255',
        ]);

        $token = $request->input('token');
        $memorialId = $request->input('memorial_id');

        $qrCode = QrCodes::where('token', $token)->first();

        if (!$qrCode) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'QR Code not found');
        }

        if ($qrCode->memorial_id) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This QR Code is already linked to a memorial page');
        }

        $qrCode->update([
            'memorial_id' => $memorialId,
            'updated_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', "QR Code {$token} successfully linked to Memorial ID {$memorialId}");
    }
}
