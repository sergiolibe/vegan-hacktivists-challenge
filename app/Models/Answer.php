<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    /** @var array */
    protected $fillable = [
        'text', 'question_id'
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuestionId(): int
    {
        return (int)$this->question_id;
    }

    public function getText(): string
    {
        return $this->text;
    }

}
