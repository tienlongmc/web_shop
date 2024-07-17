<?php


namespace App\Http\Services;
use Carbon\Carbon;


class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $name =time() . '_' . uniqid() . '.' .  $request->file('file')->getClientOriginalExtension();
                $pathFull = 'uploads/' . date("Y/m/d");

                $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );

                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}