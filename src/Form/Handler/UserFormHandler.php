<?php

namespace App\Form\Handler;

use App\Entity\User;
use App\Utils\Manager\UserManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFormHandler
{

    private UserManager $userManager;
    private UserPasswordEncoderInterface $userPasswordEncode;

    public function __construct(UserManager $userManager, UserPasswordEncoderInterface $userPasswordEncode)
    {
        $this->userManager = $userManager;
        $this->userPasswordEncode = $userPasswordEncode;
    }

    /**
     * @param Form $form
     * @return User|null
     */
    public function processEditForm(FormInterface $form): ?User
    {
        $plainPassword = $form->get('plainPassword')->getData();
        $newEmail = $form->get('newEmail')->getData();

        /** @var User $user */
        $user = $form->getData();

        if (!$user->getId()) {
            $user->setEmail($newEmail);
        }

        if ($plainPassword) {
            $encodedPassword = $this->userPasswordEncode->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);
        }

        $this->userManager->save($user);

        return $user;
    }
}