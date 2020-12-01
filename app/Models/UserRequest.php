<?php

namespace App\Models;

use App\Models\Traits\DBQuerySelect;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory, DBQuerySelect;

    const TABLE = "user_requests";
    const MAX_REQUEST = 10;

    protected $table = self::TABLE;

    public $timestamps = false;

    protected $fillable = ["user_id", "game_method_id", "actual_request", "max_request"];

    protected static $selectFields = ["id", "user_id", "game_method_id", "actual_request", "max_request"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameMethod()
    {
        return $this->belongsTo(GameMethod::class, 'game_method_id', 'id');
    }
}
