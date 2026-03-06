<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookBorrow extends Model
{
    /** @use HasFactory<\Database\Factories\BookBorrowFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'borrower_name',
        'borrower_email',
        'borrower_phone',
        'borrower_class',
        'book_title',
        'book_author',
        'borrowed_at',
        'returned_at',
        'is_returned',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    
    
}
