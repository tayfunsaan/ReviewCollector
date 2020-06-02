<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [ 'id' ];

    public function links()
    {
        return $this->hasOne('App\Link', 'id', 'link_id');
    }

    public function getLangTextAttribute($value)
    {
        $lang = $this->attributes['lang'];
        switch ($lang){
            case 'turkey':
                return 'Türkiye';
                break;
            case 'australia':
                return 'Avustralya';
                break;
            case 'canada':
                return 'Kanada';
                break;
            case 'england':
                return 'İngiltere';
                break;
            case 'usa':
                return 'Amerika';
                break;
        }
    }
}
