<?php

    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model{
        protected $table = 'tblstudent';
        protected $fillable = [
            'studid','lastname','firstname','middlename','bday','age'
        ];

        public $timestamps = false;
        protected $primarykey = 'studid';
    }
