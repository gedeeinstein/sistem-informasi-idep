<?php

return [
    'userManagement' => [
        'title'          => 'Manajemen User',
        'title_singular' => 'Manajemen User',
    ],
    'status' =>
    [
        'title' => 'Status',
        'aktif' => 'Aktif',
        'tidak_aktif'=> 'Tidak Aktif',
        'action'=> 'Aksi',
    ],
    'permission' => [
        'title'          => 'Izin',
        'title_singular' => 'Izin',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
        ],
    ],
    'country' => [
        'list' => 'Daftar Negara',
        'countries' => 'Negara-Negara',
        'title_singular' => 'Negara',
        'title' => 'Negara',
        'kode'=>'Kode',
        'nama'=>'Nama',
        'iso1'=>'ISO-1',
        'iso2'=>'ISO-2',
        'flag'=>'Bendera',
    ],
    'provinsi' => [
        'list' => 'Daftar Provinsi',
        'provincies' => 'Provinsi',
        'title_singular' => 'Provinsi',
        'title' => 'Provinsi',
        'kode'=>'Kode',
        'nama'=>'Nama',
    ],
    'kabupaten' => [
        'list' => 'Daftar Kabupaten',
        'kabupatens' => 'Kabupaten',
        'title_singular' => 'Kabupaten',
        'title' => 'Kabupaten',
        'kode'=>'Kode',
        'nama'=>'Nama',
        'aktif'=>'Aktif',
        'provinsi'=>'Provinsi',
        'kota'=>'Kota',
    ],
    'kecamatan' => [
        'list' => 'Daftar Kecamatan',
        'nama' => 'Nama Kecamatan',
        'title_singular' => 'Kecamatan',
        'title' => 'Kecamatan',
        'kode'=>'Kode',
        'name'=>'Nama',
        'aktif'=>'Aktif',
        'kota'=>'Kota',
        'kode_validation'=> 'Input Salah. Kode harus sesuai pola xx.xx.xx . Hanya angka dan karakter titik yang boleh diinputkan',
        'kab_validation' => 'Input Tidak Valid. Silahkan pilih Kabupaten.',
        'nama_validation'=> 'Input Salah. Minimal 3 karakter dan harus dimulai dengan huruf.',
    ],
    'desa' => [
        'list'          => 'List Data Desa',
        'title'         => 'Desa',
        'form'          => [
            'id'        => 'ID',
            'nama'      => 'Nama Desa',
            'kode'      => 'Kode',
            'kab'       => 'Nama Kabupaten',
            'kec'       => 'Nama Kecamatan',
            'prov'      => 'Nama Provinsi',
            'aktif'     => 'Aktif',
        ],
        'validation'    => [
            'nama'      => 'Input Salah. Silahkan Masukan Nama Desa.',
            'req_nama'  => 'Silahkan masukan Nama Desa.',
            'min_nama'  => 'Nama Desa minimal 3 karakter.',
            'min_kode'  => 'Kode Desa harus 13 karakter kode. Format xx.xx.xx.xxxx',
            'req_kode'  => 'Silahkan masukan Kode Desa.',
            'kode'      => 'Input Salah. Silahkan Masukan Kode Desa. Format xx.xx.xx.xxxx',
            'kec'       => 'Input Salah. Silahkan Pilih kecamatan.',
            'kab'       => 'Input Salah. Silahkan pilih Kabupaten.',
        ],
    ],
    'dusun' => [
        'list'          => 'List Data Dusun',
        'title'         => 'Dusun',
        'form'          => [
            'id'        => 'ID',
            'nama'      => 'Nama Dusun',
            'kode'      => 'Kode',
            'kode_pos'  => 'Kode Pos',
            'kab'       => 'Nama Kabupaten',
            'kec'       => 'Nama Kecamatan',
            'des'       => 'Nama Desa',
            'prov'      => 'Nama Provinsi',
            'aktif'     => 'Aktif',
        ],
        'validation'    => [
            'nama'      => 'Input Salah. Silahkan Masukan Nama Desa.',
            'req_nama'  => 'Silahkan masukan Nama Desa.',
            'min_nama'  => 'Nama Dusun minimal 3 karakter.',
            'min_kode'  => 'Kode Dusun harus 16 karakter kode. Format xx.xx.xx.xxxx.xx',
            'req_kode'  => 'Silahkan masukan Kode Dusun.',
            'max_kode'  => 'Maksimal 16 karakter untuk kode Dusun.',
            'prov'      => 'Silahkan pilih Provinsi.',
            'kode'      => 'Input Salah. Silahkan Masukan Kode Dusun. Format xx.xx.xx.xxxx.xx',
            'kec'       => 'Input Salah. Silahkan Pilih kecamatan.',
            'kab'       => 'Input Salah. Silahkan pilih Kabupaten.',
            'des'       => 'Input Salah. Silahkan pilih Desa.',
        ],
    ],

    'negara' => [
        'title'          => 'Negara',
        'title_singular' => 'Negara',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'nama'              => 'Nama',
            'nama_helper'       => ' ',
            'iso_1'             => 'ISO-1',
            'iso_1_helper'      => ' ',
            'iso_2'             => 'ISO-2',
            'iso_2_helper'      => ' ',
            'flag'              => 'Flag',
            'flag_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Role Sistem',
        'title_singular' => 'Role Sistem',
        'list'           => 'Daftar Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'nama'               => 'Nama Role',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
        'validation'             => [
            'nama'               => 'Nama role harus terdiri dari 5 karakter.',
            'permission'         => 'Pilih salah satu permision.',
        ],
    ],
    'user' => [
        'title'          => 'Daftar Pengguna',
        'title_singular' => 'User',
        'list'           => 'Daftar Pengguna',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Nama',
            'nama'                     => 'Nama',
            'username'                 => 'Username',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'jabatan'                  => 'Posisi',
            'role'                     => 'Role',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
        'validation'          => [
            'nama'            => 'Nama harus setidaknya 5 karakter',
            'username'        => 'Nama pengguna harus terdiri dari setidaknya 5 karakter.',
            'email'           => 'Format email tidak valid.',
            'user_unique'     => 'Nama pengguna harus unik.',
            'taken'           => 'telah diambil.',
            'email_unique'    => 'Email sudah diambil.',
            'password'        => 'Kata sandi harus terdiri dari setidaknya 8 karakter.',            
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'form'=> [
        'kode'=> 'Kode',
        'nama'=> 'Nama',
        'submit'=> 'Kirim',
        'cancel'=> 'Batalkan',
    ],
    'data' => [
        'data'      => 'Data',
        'added'     => 'Berhasil ditambahkan',
        'updated'   => 'Berhasil ditambahkan',
        'deleted'   => 'Berhasil dihapus' 
    ],
    'jenisbantuan' => [
        'list' => 'Daftar Jenis Bantuan',
        'jenisbantuan' => 'Jenis Bantuan',
        'title_singular' => 'Jenis Bantuan',
        'title' => 'Jenis Bantuan',
        'kode'=>'Kode',
        'no'=>'No',
        'nama'=>'Nama',
    ],
    'kategoripendonor' => [
        'list' => 'List Kategori Pendonor',
        'kategoripendonor' => 'Kategori Pendonor',
        'title_singular' => 'Kategori Pendonor',
        'title' => 'Kategori Pendonor',
        'kode'=>'Kode',
        'no'=>'No',
        'nama'=>'Nama',
    ],
    'kelompokmarjinal' => [
        'list' => 'List Kelompok Marjinal',
        'kelompokmarjinal' => 'Kelompok Marjinal',
        'title' => 'Kelompok Marjinal',
        'kode'=>'Kode',
        'no'=>'No',
        'nama'=>'Nama',
    ],

];
