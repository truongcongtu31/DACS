<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'title', 'content', 'image'
    ];

    public function getAllAbout()
    {
        $about = About::all();
        return $about;
    }

    public function addAbout($data)
    {
        return About::create($data);
    }

    public function getDetail($id)
    {
        $aboutDetail = DB::table('abouts')
            ->select('id', 'title', 'content', 'image')
            ->where('id', '=', $id)
            ->get();

        return $aboutDetail;
    }

    public function updateAbout($request, $id)
    {
        $file = $request->file('hinhanh5');
        if ($file != null) {
            return DB::table('abouts')
                ->where('id', '=', $id)
                ->update([
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        } else {
            return DB::table('abouts')
                ->where('id', '=', $id)
                ->update([
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'image' => $request->input('hinhanh5'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }

    public function deleteAbout($id)
    {
        return DB::table('abouts')
            ->where('id', '=', $id)
            ->delete();
    }
}
