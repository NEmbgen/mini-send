<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class MailAttachment
 * @package App\Models
 * @property integer id
 * @property string file_name
 * @property string mime_type
 * @property string path
 * @property integer file_size
 * @property integer user_mail_id
 * @property UserMail userMail
 * @property string created_at
 * @property string updated_at
 * @property string download_url
 */
class UserMailAttachment extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function userMail(): BelongsTo
    {
        return $this->belongsTo(UserMail::class, 'user_mail_id');
    }
}
