<?php
namespace AuthBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\ORM\AbstractLoad;
use AuthBundle\Entity\Role;
use AuthBundle\Entity\User;
use AuthBundle\Entity\UserRole;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadAdmin
 * @package AuthBundle\DataFixtures\ORM
 */
class LoadUserRole extends AbstractLoad
{
    /** @var ObjectManager $manager */
    private $manager;

    /**
     * @param $object
     *
     * @return mixed
     */
    protected function createObject($object)
    {
        $userRole = new UserRole();
        $userRole->setUser($object['user']);
        $userRole->setRole($object['role']);

        return $userRole;
    }

    /**
     * @return array
     */
    protected function getObjects()
    {
        $this->manager = $this->container->get('doctrine')->getManager();
        /** @var User $user */
        $user = $this->manager->getRepository(User::class)->findOneBy(['email' => User::$admin['email']]);
        /** @var Role $user */
        $role = $this->manager->getRepository(Role::class)->findOneBy(['role' => Role::$adminRole['role']]);

        $data = ['user' => $user, 'role' => $role];

        return [$data];
    }

    /**
     * @param ObjectManager $manager
     * @param $object
     *
     * @return mixed
     */
    protected function find(ObjectManager $manager, $object)
    {
       return $manager->getRepository(UserRole::class)->findOneBy([
           'user' => $object['user'],
           'role' => $object['role']
       ]);
    }
}
