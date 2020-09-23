<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    private string $text = '';

    /** @var array */
    protected $fillable = [
        'text'
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo('App\Question');
    }

    public function getText(): string
    {
        return $this->text;
    }
}
