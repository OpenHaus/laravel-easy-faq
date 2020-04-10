<?php

/**
 *
 */

namespace OpenHaus\LaravelEasyFaq\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Faq
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $order
 * @property bool $is_public
 * @property int $faq_category_id
 * @property int $likes
 * @property int $dislikes
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Faq extends Model
{
	protected $table = 'faqs';

	protected $casts = [
		'order' => 'int',
		'is_public' => 'bool',
		'faq_category_id' => 'int',
		'likes' => 'int',
		'dislikes' => 'int'
	];

	protected $fillable = [
		'question',
		'answer',
		'order',
		'is_public',
		'faq_category_id',
		'likes',
		'dislikes'
	];

    protected $attributes = [
        'likes' => 0,
        'dislikes' => 0,
        'is_public' => true,
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->likes = $query->likes ?? 0;
            $query->dislikes = $query->dislikes ?? 0;
        });
    }

}
