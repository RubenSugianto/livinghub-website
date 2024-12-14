<?php

namespace App\CustomChatify;

use Chatify\ChatifyMessenger;

class CustomChatifyMessenger extends ChatifyMessenger
{
    public function getUserWithAvatar($user)
    {
        if ($user->avatar == 'avatar.png' && config('chatify.gravatar.enabled')) {
            $imageSize = config('chatify.gravatar.image_size');
            $imageset = config('chatify.gravatar.imageset');
            $user->avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=' . $imageSize . '&d=' . $imageset;
        } else {
            if (!filter_var($user->avatar, FILTER_VALIDATE_URL)) {
                $user->avatar = self::getUserAvatarUrl($user->avatar);
            }
        }
        return $user;
    }
}
