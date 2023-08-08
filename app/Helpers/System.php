<?php

use Illuminate\Support\Facades\Mail;

function uploadFile($nameFolder, $file)
{
    $fileName = time() . "_" . $file->getClientOriginalName();
    return $file->storeAs($nameFolder, $fileName, 'public');
}

function format_money($number, $suffix = 'đ')
{
    if (!empty($number)) {
        return number_format($number, 0, ',', '.') . " {$suffix}";
    }
}
function sendMail($email,$nameSpace){
    $sendMail =Mail::to($email)->queue($nameSpace);
    return $sendMail;
}
