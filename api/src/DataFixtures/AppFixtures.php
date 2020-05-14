<?php
namespace App\DataFixtures;

use App\Entity\ClinicalCase;
use App\Entity\Commentaire;
use App\Entity\Notation;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Faker\Factory;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager){
        $faker = Factory::create('fr_FR');
        $user = new User();
        $user->setPrenom('dentiio')
            ->setNom('dentiio')
            ->setPseudo('dentiio')
            ->setEmail('api@dentiio.fr')
            ->setIsEnabled(true)
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');
        
        $manager->persist($user);

        $userAdmin = new User();
        $userAdmin->setPrenom('admin')
            ->setNom('admin')
            ->setPseudo('admin')
            ->setEmail('admin@dentiio.fr')
            ->setIsEnabled(true)
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');
    
        $manager->persist($userAdmin);

        $userModerator = new User();
        $userModerator->setPrenom('moderator')
            ->setNom('moderator')
            ->setPseudo('moderator')
            ->setEmail('moderator@dentiio.fr')
            ->setIsEnabled(true)
            ->setRoles(["ROLE_MODERATOR"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');
    
        $manager->persist($userModerator);

        for ($u=0; $u < 30; $u++){
            $user = new User();
            $user->setPrenom($faker->firstName)
                ->setNom($faker->lastName)
                ->setPseudo("$faker->lastName"."$faker->firstName")
                ->setEmail($faker->email)
                ->setIsEnabled(true)
                ->setPassword('$2y$13$Q27cK8NiNv7FFDjdKOoloO2FvukD4sKSZuCS8MY41n7yitBA2.Aj2');

            $manager->persist($user);

            for($c=0; $c < 5; $c++){
                $clinicalCase = new ClinicalCase();
                $clinicalCase->setUser($user)
                    ->setCreatedAt(new \DateTime('NOW'))
                    ->setPresentation($faker->paragraph)
                    ->setEvolution($faker->paragraph)
                    ->setTreatmentPlan($faker->paragraph)
                    ->setObservation("le patient a mal au niveau de la gencive")
                    ->setConclusion("c'est reparer")
                    ->setAge($faker->randomDigit)
                    ->setUpdatedAt(new \DateTime('NOW'))
                    ->setAverage($faker->randomDigit)
                    ->setSmoking($faker->randomElement([true,false]))
                    ->setIsEnabled($faker->randomElement([true,false]));
                $manager->persist($clinicalCase);

                for ($n=0; $n < 5; $n++){
                    $notations = new Notation();
                    $notations->setCreatedAt(new \DateTime('NOW'))
                        ->setNote($faker->numberBetween(0,5))
                        ->setUser($user)
                        ->setClinicalCase($clinicalCase);

                    $manager->persist($notations);

                }
                for ($co=0; $co < 5; $co++){
                    $commentaire = new Commentaire();
                    $commentaire->setCreatedAt(new \DateTime('NOW'))
                        ->setComment($faker->paragraph)
                        ->setUser($user)
                        ->setClinicalCase($clinicalCase);

                    $manager->persist($commentaire);

                }
            }


        }

        $manager->flush();
    }
}
