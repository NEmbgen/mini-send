<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UserMail
 * @package App\Models
 * @property integer id
 * @property string sender_id
 * @property User sender
 * @property string to
 * @property string status
 * @property string sent_at
 * @property string subject
 * @property UserMailAttachment[] attachments
 * @property string body
 * @property string created_at
 * @property string updated_at
 */
class UserMail extends Model
{
    use HasFactory;

    protected $fillable = ['to', 'subject', 'body'];

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(UserMailAttachment::class, 'user_mail_id');
    }

    /**
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
