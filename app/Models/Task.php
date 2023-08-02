<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Task extends Model
    {
        use HasFactory, SoftDeletes;

        protected $fillable =['title','status', 'description', 'deadline', 'assign_to', 'assign_by'];

        public function userInfo(){
            return $this->hasOne('App\Models\User','id','assign_to');
        }
        public function assignerInfo(){
            return $this->hasOne('App\Models\User','id','assign_by');
        }
    }
