<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'status' =>
    [
        'title' => 'Status',
        'aktif' => 'Active',
        'tidak_aktif'=> 'Non Active',
        'action'=> 'Action',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
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
        'list' => 'List Countries',
        'countries' => 'Countries',
        'title_singular' => 'Country',
        'title' => 'Country',
        'kode'=>'Kode',
        'nama'=>'Name',
        'iso1'=>'ISO-1',
        'iso2'=>'ISO-2',
        'flag'=>'Flag',
    ],
    'provinsi' => [
        'list' => 'List Provincies',
        'provincies' => 'Provincies',
        'title_singular' => 'Province',
        'title' => 'Province',
        'kode'=>'Code',
        'nama'=>'Name',
        'iso1'=>'ISO-1',
        'iso2'=>'ISO-2',
        'flag'=>'Flag',
    ],
    'kabupaten' => [
        'list' => 'List Regencies',
        'kabupatens' => 'Regencies',
        'title_singular' => 'Regency',
        'title' => 'Regency',
        'kabupaten' => 'Regency',
        'kode'=>'Code',
        'nama'=>'Name',
        'aktif'=>'Active',
        'provinsi'=>'Province',
        'kota'=>'City',
    ],
    'kecamatan' => [
        'list' => 'List of Subdistrict',
        'nama' => 'Subdistrict Name',
        'title_singular' => 'Subdistrict',
        'title' => 'Subdistrict',
        'kode'=>'Code',
        'name'=>'Name',
        'aktif'=>'Active',
        'kota'=>'City',
        'kode_validation'   => 'Invalid input. Please follow patern xx.xx.xx . Only numbers and dots are allowed.',
        'kab_validation'    => 'Invalid input. Please Select Regency.',
        'nama_validation'   => 'Invalid input. Must be at least 3 characters and cannot start with a number.',
    ],
    'desa' => [
        'list'          => 'List Villages',
        'title'         => 'Villages',
        'form'          => [
            'id'        => 'ID',
            'nama'      => 'Village Name',
            'kode'      => 'Code',
            'kab'       => 'Regency Name',
            'kec'       => 'Subdistrict Name',
            'prov'      => 'Province Name',
            'aktif'     => 'Active',
        ],
        'validation'    => [
            'nama'      => 'Invalid input. Please Input a valid Village Name.',
            'req_nama'  => 'Please provide Village Name.',
            'min_nama'  => 'Village Name must be at least 3 character.',
            'min_kode'  => 'Village Code must be at exact 13 code.',
            'req_kode'  => 'Please provide Village Code.',
            'kode'      => 'Invalid input. Please Input a valid Village Code. Format xx.xx.xx.xxxx',
            'kec'       => 'Invalid input. Please Select a Subdistrict.',
            'kab'       => 'Invalid input. Please Select a Regency.',
        ],
    ],
    'dusun' => [
        'list'          => 'List Hamlet',
        'title'         => 'Hamlet',
        'form'          => [
            'id'        => 'ID',
            'nama'      => 'Hamlet Name',
            'kode'      => 'Code',
            'kab'       => 'Regency Name',
            'kec'       => 'Subdistrict Name',
            'kode_pos'  => 'Postal Code',
            'des'       => 'Village Name',
            'prov'      => 'Province Name',
            'aktif'     => 'Active',
        ],
        'validation'    => [
            'nama'      => 'Invalid input. Please Input a valid Hamlet Name.',
            'req_nama'  => 'Please provide Hamlet Name.',
            'min_nama'  => 'Hamlet Name must be at least 3 character.',
            'min_kode'  => 'Hamlet Code must be at exact 16 code.',
            'req_kode'  => 'Please provide Hamlet Code.',
            'kode'      => 'Invalid input. Please Input a valid Hamlet Code. Format xx.xx.xx.xxxx.xxxx',
            'kec'       => 'Invalid input. Please Select a Subdistrict.',
            'kab'       => 'Invalid input. Please Select a Regency.',
            'des'       => 'Invalid input. Please Select a Village.',
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
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
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
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
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
        'added'     => 'Added Successfully',
        'updated'   => 'Updated Successfully',
        'deleted'   => 'Has Been Deleted' 
    ]

];
