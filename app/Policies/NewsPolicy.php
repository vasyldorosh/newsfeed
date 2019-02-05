<?php
namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function update(User $user, News $news)
    {
        return $user->id;
    }
}
