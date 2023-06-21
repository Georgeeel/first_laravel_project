<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    //propriété protegée pour le champs remplisable pour de problemes des securité
    protected $fillable = [
        "title",
        "slug",
        "content",
        "category_id"
    ];

    //propriété protegée pour le champs qui n'est sont pas authorisé 
    protected $guarded = [

    ];

    //la function me permet d'associer un article a une category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //la function permet d'associer un article a plusieurs tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

}
