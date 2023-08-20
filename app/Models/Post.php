<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'content',
        'published',
    ];
    
  /**
   * The "post" method is used to publish a post.
   *
   * @return void
   */
  public function post()
  {
      $this->published = true;
      $this->save();
  }
    
    //To Category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //To Users
    public function user(){
        return $this->belongsTo(User::class);
    }
}
