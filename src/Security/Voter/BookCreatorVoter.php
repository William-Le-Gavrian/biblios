<?php

namespace App\Security\Voter;

use App\Entity\Book;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BookCreatorVoter extends Voter{
     
    /**
     * Cette méthode détermine si ce voter doit gérer l'attribut et le sujet donnés.
     */
    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, mixed $subject): bool
    {
        return 'book.is_creator' === $attribute && $subject instanceOf Book;
    }

    /**
     * Cette méthode contient la logique pour déterminer si l'utilisateur peut effectuer l'action.
     */
    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if(!$user instanceOf User){
            return false;
        }

        /**
         * @var Book $subject
         */

         return $user === $subject->getCreatedBy();
    }
}