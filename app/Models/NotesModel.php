<?php

namespace App\Models;

use CodeIgniter\Model;

class NotesModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['topic_id', 'note', 'user_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}