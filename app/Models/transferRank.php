<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanMember extends Model
{
    use HasFactory;

    protected $table = 'clan_members';

    protected $fillable = [
        'user_id',
        'clan_id',
        'rank',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }

    public function transferRank(User $newOwner)
    {
        \DB::beginTransaction();

        try {
            $this->where('clan_id', $this->clan_id)
                ->where('user_id', $this->user_id)
                ->update(['rank' => 1]);

            $this->where('clan_id', $this->clan_id)
                ->where('user_id', $newOwner->id)
                ->update(['rank' => 100]);

            $this->clan->owner_id = $newOwner->id;
            $this->clan->save();

            \DB::commit();

            return true;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }
}
