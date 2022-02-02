<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string short_code
 * @property string original_link
 */
class ShortLink extends Model
{
    /**
     * @var string
     */
    public $primaryKey = 'short_link_id';

    /**
     * @var array
     */
    protected $fillable = [
        'short_code',
        'original_link',
    ];
}
