<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use Cycle\ORM\EntityManager;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Select;
use Cycle\ORM\Select\Repository;

class UserRepository extends Repository
{
    public function __construct(Select $select, private readonly EntityManager $entityManager)
    {
        parent::__construct($select);
    }

    public function setOtpForUser(User $user, int $otp, \DateTimeImmutable $expiration): void
    {
        $user->setOtpCode($otp);
        $user->setOtpExpiredAt($expiration);

        $this->entityManager->persist($user);
        $this->entityManager->run();
    }

}
