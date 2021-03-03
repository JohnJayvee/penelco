<?php 

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Laravel\Traits\DateFormatter;
use Str;

class Transaction extends Model{
    
    use SoftDeletes,DateFormatter;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "transaction";

    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = "master_db";

    /**
     * Enable soft delete in table
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_name','department_id'];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that created within the model.
     *
     * @var array
     */
    protected $appends = [];

    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function type(){
        return $this->BelongsTo("App\Laravel\Models\Application",'application_id','id');
    }

    public function department(){
        return $this->BelongsTo("App\Laravel\Models\Department",'department_id','id');
    }
    public function account(){
        return $this->BelongsTo("App\Laravel\Models\AccountTitle",'account_title_id','id');
    }

    public function customer(){
        return $this->BelongsTo("App\Laravel\Models\Customer",'customer_id','id');
    }

     public function admin(){
        return $this->BelongsTo("App\Laravel\Models\User",'processor_user_id','id');
    }
    public function getCustomerNameAttribute(){
        return Str::title("{$this->fname} {$this->lname} ");
    }
    
  
   

}