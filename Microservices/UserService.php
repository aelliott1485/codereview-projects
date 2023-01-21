<?php

namespace Microservices;

use App\Models\User;

class UserService
{
    private static array $cache = [];
    public function get($id)
    {
        if (isset(self::$cache[$id])) {
            return self::$cache[$id];
        }
        $user = User::find($id);
        if (is_object($user)) {
            self::$cache[$id] = $user;
        }
        return $user;
    }
}
