<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    private ?int $amountOfAnswers = null;

    /** @var array */
    protected $fillable = [
        'id',
        'text'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class)->orderBy('created_at');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAmountOfAnswers(): int
    {
        return $this->amountOfAnswers ?? $this->answers()->count();
    }

    public function setAmountOfAnswers(int $amountOfAnswers): void
    {
        $this->amountOfAnswers = $amountOfAnswers;
    }
}
