<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanRank extends Model
{
    use HasFactory;

    protected $table = 'clan_ranks';

    protected $fillable = [
        'clan_id',
        'name',
        'rank',
        'can_post_wall',
        'can_moderate_wall',
        'can_invite_users',
        'can_manage_relations',
        'can_rank_members',
        'can_manage_ranks',
        'can_edit_description',
        'can_post_shout',
        'can_add_funds',
        'can_take_funds',
        'can_edit_clan',
    ];
}