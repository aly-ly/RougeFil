<?php

namespace App\DataPersister;

use App\Entity\Users;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserDataPersister implements ContextAwareDataPersisterInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Users;
    }

    public function persist($data, array $context = [])
    {
      // call your persistence layer to save $data

      $hash = $this->encoder->encodePassword($data,$data->getPassword());
      $data->setPassword($hash);
      return $data;
    }

    public function remove($data, array $context = [])
    {
      // call your persistence layer to delete $data
    }
}