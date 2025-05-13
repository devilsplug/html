namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetComment extends Model
{
    use HasFactory;

    protected $table = 'set_comments';

    protected $fillable = [
        'set_id',
        'creator_id',
        'body',
    ];

    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}