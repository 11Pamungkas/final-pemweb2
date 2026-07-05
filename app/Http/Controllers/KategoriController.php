<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori_list = [

            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],

            [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],

            [
                'id' => 3,
                'nama' => 'Design',
                'deskripsi' => 'UI UX dan desain grafis',
                'jumlah_buku' => 12
            ],

            [
                'id' => 4,
                'nama' => 'Networking',
                'deskripsi' => 'Jaringan komputer',
                'jumlah_buku' => 10
            ],

            [
                'id' => 5,
                'nama' => 'Cyber Security',
                'deskripsi' => 'Keamanan sistem informasi',
                'jumlah_buku' => 9
            ]
        ];

        return view('kategori.index', compact('kategori_list'));
    }


    public function show($id)
    {
        $kategori = [
            'id' => $id,
            'nama' => 'Programming',
            'deskripsi' => 'Buku pemrograman dan coding',
            'jumlah_buku' => 25
        ];

        $buku_list = [

            [
                'judul' => 'Laravel Dasar',
                'pengarang' => 'Budi'
            ],

            [
                'judul' => 'PHP Modern',
                'pengarang' => 'Andi'
            ],

            [
                'judul' => 'JavaScript ES6',
                'pengarang' => 'Rina'
            ]
        ];

        return view(
            'kategori.show',
            compact('kategori', 'buku_list')
        );
    }


    public function search($keyword)
    {
        $hasil = [

            [
                'nama' => 'Programming',
                'deskripsi' => 'Belajar coding Laravel'
            ]
        ];

        return view(
            'kategori.search',
            compact('keyword', 'hasil')
        );
    }
}