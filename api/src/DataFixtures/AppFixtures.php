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
        for ($u=0; $u < 30; $u++){
            $user = new User();
            $user->setPrenom($faker->firstName)
                ->setNom($faker->lastName)
                ->setPseudo($faker->email)
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
