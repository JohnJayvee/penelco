<?php 

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Laravel\Traits\DateFormatter;
use Str,Carbon,Helper,DB;

class BillDetails extends Model{
    
    use SoftDeletes,DateFormatter;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "bill_details";

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
    protected $fillable = ['bill_month','account_number','account_name','due_date','amount','email','contact_number','payment_status'];


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

    
    public function getFullNameAttribute(){
        return Str::title("{$this->first_name} {$this->last_name} ");
    }
   
}