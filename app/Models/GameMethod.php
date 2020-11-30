<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMethod extends Model
{
    use HasFactory;

    const TABLE = "game_methods";
    const ALL_WORD = 'all_word';
    const CHARACTER_TO_CHARACTER = 'character_to_character';

    protected $table = self::TABLE;

    public $timestamps = false;

    protected $fillable = ["name", "descriptor", "enable"];
}
