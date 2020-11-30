<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameCode extends Model
{
    use HasFactory;

    const TABLE = "game_codes";

    protected $table = self::TABLE;

    protected $fillable = ["name", "descriptor", "code", "description"];
}
