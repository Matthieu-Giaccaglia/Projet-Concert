<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    
    const USER_EDIT = 'user_edit';
    const USER_SHOW = 'user_show';
    const USER_DELETE = 'user_delete';
    
    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::USER_EDIT, self::USER_SHOW])
            && $subject instanceof User;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::USER_SHOW:
                return $this->canShow($subject, $user);
            case self::USER_EDIT:
                return $this->canEdit($subject, $user);
            case self::USER_DELETE:
                return $this->canDelete($subject, $user);
        }

        return false;
    }

    private function canShow($userShow, UserInterface $user): bool
    {
        return $userShow === $user ;
    }

    private function canEdit($userShow, UserInterface $user): bool
    {
        return $userShow === $user ;
    }

    private function canDelete($userShow, UserInterface $user) : bool
    {
        return $userShow != $user;
    }
}
