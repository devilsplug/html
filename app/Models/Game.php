<?php
/**
 * MIT License
 *
 * Copyright (c) 2021-2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'creator_id',
        'host_key',
        'name',
        'image'
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    public function thumbnail()
    {
        $url = config('site.storage_url');
        $filename = "{$url}/thumbnails/games/{$this->thumbnail}.png";

        if ($this->is_thumbnail_pending)
            return "{$url}/default/pendingset.png";
        else if ($this->thumbnail_url == 'declined')
            return "{$url}/default/declinedset.png";

        if (Str::startsWith($this->thumbnail, 'default_')) {
            $default = str_replace('default_', '', $this->thumbnail);
            $filename = "{$url}/default/games/{$default}.png";
        }

        return $filename;
    }
}
