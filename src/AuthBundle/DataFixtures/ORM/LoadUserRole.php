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
    /**
     * @param array $data
     *
     * @return mixed
     */
    protected function createObject($data)
    {
        $userRole = new UserRole();
        $userRole->setUser($data['user']);
        $userRole->setRole($data['role']);

        return $userRole;
    }

    /**
     * @return array
     */
    protected function getObjects()
    {
        /** @var ObjectManager $em */
        $em = $this->container->get('doctrine')->getManager();
        /** @var User $user */
        $user = $em->getRepository(User::class)->findOneBy(['email' => User::$admin['email']]);
        /** @var Role $user */
        $role = $em->getRepository(Role::class)->findOneBy(['role' => Role::$adminRole['role']]);

        $data = ['user' => $user, 'role' => $role];

        return [$data];
    }

    /**
     * @param ObjectManager $manager
     * @param array $data
     *
     * @return mixed
     */
    protected function find(ObjectManager $manager, $data)
    {
       return $manager->getRepository(UserRole::class)->findOneBy([
           'user' => $data['user'],
           'role' => $data['role']
       ]);
    }
}
