<?php

/**
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqCategory
 *
 * @property int $id
 * @property string $title
 *
 * @package App\Models
 */
class FaqCategory extends Model
{
	protected $table = 'faq_categories';

	public $timestamps = false;

	protected $fillable = [
		'title'
	];
}
