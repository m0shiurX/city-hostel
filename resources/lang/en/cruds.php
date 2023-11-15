<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
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
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'approved'                  => 'Approved',
            'approved_helper'           => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
            'phone'                     => 'Phone',
            'phone_helper'              => 'Phone Number',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'hostel' => [
        'title'          => 'Hostel',
        'title_singular' => 'Hostel',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'name'                  => 'Name',
            'name_helper'           => 'Hostel name',
            'address'               => 'Address',
            'address_helper'        => ' ',
            'phone'                 => 'Phone',
            'phone_helper'          => ' ',
            'note'                  => 'Note',
            'note_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'created_by'            => 'Created By',
            'created_by_helper'     => ' ',
            'built_on'              => 'Built On',
            'built_on_helper'       => ' ',
            'total_seat'            => 'Total Seat',
            'total_seat_helper'     => ' ',
            'garage'                => 'Garage',
            'garage_helper'         => ' ',
            'garage_size'           => 'Garage Size',
            'garage_size_helper'    => ' ',
            'facility'              => 'Facility',
            'facility_helper'       => ' ',
            'area'                  => 'Area',
            'area_helper'           => ' ',
            'category'              => 'Category',
            'category_helper'       => ' ',
            'amenities'             => 'Amenities',
            'amenities_helper'      => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
        ],
    ],
    'room' => [
        'title'          => 'Seat',
        'title_singular' => 'Seat',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'hostel'            => 'Hostel',
            'hostel_helper'     => ' ',
            'room_info'         => 'Seat Title',
            'room_info_helper'  => ' ',
            'images'            => 'Images',
            'images_helper'     => ' ',
            'price'             => 'Price',
            'price_helper'      => 'per month',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'capacity'          => 'Capacity',
            'capacity_helper'   => ' ',
            'placement'         => 'Placement',
            'placement_helper'  => ' ',
            'facility'          => 'Facility',
            'facility_helper'   => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'tag'               => 'Tag',
            'tag_helper'        => ' ',
        ],
    ],
    'reservation' => [
        'title'          => 'Reservation',
        'title_singular' => 'Reservation',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'room'                => 'Room',
            'room_helper'         => ' ',
            'paid_amount'        => 'Down Payment',
            'paid_amount_helper' => 'Amount of the down payment',
            'status'              => 'Status',
            'status_helper'       => 'Reservation status (pending, approved, etc.)',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
        ],
    ],
    'facility' => [
        'title'          => 'Facility',
        'title_singular' => 'Facility',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'details'           => 'Details',
            'details_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'payment' => [
        'title'          => 'Payment',
        'title_singular' => 'Payment',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'amount'             => 'Amount',
            'amount_helper'      => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
            'reservation'        => 'Reservation',
            'reservation_helper' => ' ',
        ],
    ],
    'category' => [
        'title'          => 'Category',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'tag' => [
        'title'          => 'Tag',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'area' => [
        'title'          => 'Area',
        'title_singular' => 'Area',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],

];
