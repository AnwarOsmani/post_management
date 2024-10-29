<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property float $postal_code
 * @property-read Admin|null $admin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeliveryRequest> $deliveryRequests
 * @property-read int|null $delivery_requests_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PostalCode $postalCode
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Worker|null $worker
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Worker> $workers
 * @property-read int|null $workers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereUserId($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $sender_name
 * @property string $sender_phone
 * @property string $receiver_name
 * @property string $receiver_phone
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $sender_postal_code
 * @property float $receiver_postal_code
 * @property int|null $assigned_worker
 * @property int $status
 * @property-read \App\Models\Package|null $package
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereAssignedWorker($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereReceiverName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereReceiverPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereReceiverPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereSenderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereSenderPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereSenderPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryRequest whereUserId($value)
 */
	class DeliveryRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $request_id
 * @property string $weight
 * @property string $price
 * @property string $tracking_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DeliveryRequest $deliveryRequest
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereWeight($value)
 */
	class Package extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $postal_code
 * @property string $district
 * @property string $post_office
 * @property string $province
 * @property string $latitude
 * @property string $longitude
 * @property string $shape_leng
 * @property string $shape_area
 * @property string $geom
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Admin> $admins
 * @property-read int|null $admins_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Worker> $workers
 * @property-read int|null $workers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode whereGeom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode wherePostOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode whereShapeArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PostalCode whereShapeLeng($value)
 */
	class PostalCode extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role
 * @property-read \App\Models\Admin|null $admin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeliveryRequest> $deliveryRequests
 * @property-read int|null $delivery_requests_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Worker|null $worker
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $admin_id
 * @property float $postal_code
 * @property-read \App\Models\Admin $admin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeliveryRequest> $deliveryRequests
 * @property-read int|null $delivery_requests_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PostalCode $postalCode
 * @property-read \App\Models\User $user
 * @property-read Worker|null $worker
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Worker whereUserId($value)
 */
	class Worker extends \Eloquent {}
}

