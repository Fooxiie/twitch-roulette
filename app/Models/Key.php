<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    public static function generateKey()
    {
        $base = "FfOoXxIiEe1234567890";
        $result = "key:";
        for ($i = 0; $i < 50; $i++) {
            $letter = random_int(0, strlen($base) - 1);
            $result .= $base[$letter];
        }
        return $result;
    }
}
