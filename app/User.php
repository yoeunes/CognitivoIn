<?php

namespace App;

use App\Profile;
use App\ProfilePost;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lab404\Impersonate\Models\Impersonate;
use Overtrue\LaravelFollow\Traits\CanFollow;

class User extends Authenticatable
{
    use Notifiable, CanFollow;

    protected $primaryKey = 'profile_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id',
        'name',
        'email',
        'password',
        'gender',
        'google_id',
        'provider',
        'provider_id',
        'access_token'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSocial(){
        return Socialite::drive($driver)
        ->scopes(['public_profile', 'user_friends'])
        ->redirect();
    }

    /**
     * Get the Profile record associated with the model.
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Get the ProfilePost for the model.
     */
    public function posts()
    {
        return $this->hasMany(ProfilePost::class);
    }



// Send a Friend Request
//
// $user->befriend($recipient);
// Accept a Friend Request
//
// $user->acceptFriendRequest($sender);
// Deny a Friend Request
//
// $user->denyFriendRequest($sender);
// Remove Friend
//
// $user->unfriend($friend);
// Block a Model
//
// $user->blockFriend($friend);
// Unblock a Model
//
// $user->unblockFriend($friend);
// Check if Model is Friend with another Model
//
// $user->isFriendWith($friend);
// Check if Model has a pending friend request from another Model
//
// $user->hasFriendRequestFrom($sender);
// Check if Model has already sent a friend request to another Model
//
// $user->hasSentFriendRequestTo($recipient);
// Check if Model has blocked another Model
//
// $user->hasBlocked($friend);
// Check if Model is blocked by another Model
//
// $user->isBlockedBy($friend);
// Get a single friendship
//
// $user->getFriendship($friend);
// Get a list of all Friendships
//
// $user->getAllFriendships();
// Get a list of pending Friendships
//
// $user->getPendingFriendships();
// Get a list of accepted Friendships
//
// $user->getAcceptedFriendships();
// Get a list of denied Friendships
//
// $user->getDeniedFriendships();
// Get a list of blocked Friendships
//
// $user->getBlockedFriendships();
// Get a list of pending Friend Requests
//
// $user->getFriendRequests();
// Get the number of Friends
//
// $user->getFriendsCount();
// Get the number of mutual Friends with another user
//
// $user->getMutualFriendsCount($otherUser);
}
