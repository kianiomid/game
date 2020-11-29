<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMethod extends Model
{
    use HasFactory;

    const TABLE = "game_methods";

    protected $table = self::TABLE;

    public $timestamps = false;

    protected $fillable = ["name", "descriptor", "enable"];
}
