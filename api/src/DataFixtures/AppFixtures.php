<?php
namespace App\DataFixtures;

use App\Entity\CategoriePathologie;
use App\Entity\CategorieTreatment;
use App\Entity\ClinicalCase;
use App\Entity\Commentaire;
use App\Entity\Jobs;
use App\Entity\Notation;
use App\Entity\Pathologie;
use App\Entity\Patient;
use App\Entity\Treatment;
use App\Entity\Speciality;
use App\Entity\Symptome;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Faker\Factory;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager){
        $faker = Factory::create('fr_FR');
        $user = new User();

        // Traumatoloqgie
        $traumatologie = new CategoriePathologie();
        $traumatologie->setName("Traumatologie Facial");
        $manager->persist($traumatologie);

        $plaie = new Pathologie();
        $plaie->setName('Brûlures de la face');
        $plaie->setCategorie($traumatologie);
        $manager->persist($plaie);

        $fracture = new Pathologie();
        $fracture->setName('Fracture de la face');
        $fracture->setCategorie($traumatologie);
        $manager->persist($fracture);

        $brulure = new Pathologie();
        $brulure->setName('Brulure de la face');
        $brulure->setCategorie($traumatologie);
        $manager->persist($brulure);

        //Symptomes
        $irritabilite = new Symptome();
        $irritabilite->setName('Une irritabilité. ...');
        $manager->persist($irritabilite);

        $gencivesGonflees = new Symptome();
        $gencivesGonflees->setName('Des gencives gonflées. ...');
        $manager->persist($gencivesGonflees);
        
        $gencivesRougesOrBleues = new Symptome();
        $gencivesRougesOrBleues->setName('Des gencives rouges voir bleues. ...');
        $manager->persist($gencivesRougesOrBleues);
        
        $diarrheeLegere = new Symptome();
        $diarrheeLegere->setName('Une diarrhée légère. ...');
        $manager->persist($diarrheeLegere);
        
        $fessesRougesAndIrritees = new Symptome();
        $fessesRougesAndIrritees->setName('Des fesses rouges et irritées.');
        $manager->persist($fessesRougesAndIrritees);


        // Treatement 
        $omnipratique = new CategorieTreatment();
        $omnipratique->setName('Omnipratique');
        $manager->persist($omnipratique);

        $detartrage = new Treatment();
        $detartrage->setName('Détartrage');
        $detartrage->setCategorie($omnipratique);
        $manager->persist($detartrage);

        $devitalisation = new Treatment();
        $devitalisation->setName('Dévitalisation');
        $devitalisation->setCategorie($omnipratique);
        $manager->persist($devitalisation);

        $implantologie = new CategorieTreatment();
        $implantologie->setName('Implantologie');
        $manager->persist($implantologie);

        $greffe = new Treatment();
        $greffe->setName('Greffe osseuse');
        $greffe->setCategorie($implantologie);
        $manager->persist($greffe);


        $omnipratique = new Speciality();
        $omnipratique->setName('Omnipratique');
        $manager->persist($omnipratique);
    
        $esthétique = new Speciality();
        $esthétique->setName('Esthétique');
        $manager->persist($esthétique);

        $parodontie = new Speciality();
        $parodontie->setName('Parodontie');
        $manager->persist($parodontie);

        $pedodontie = new Speciality();
        $pedodontie->setName('Pedodontie');
        $manager->persist($pedodontie);
  
        $implantologie = new Speciality();
        $implantologie->setName('Implantologie');
        $manager->persist($implantologie);
   
        $orthodontie = new Speciality();
        $orthodontie->setName('Orthodontie');
        $manager->persist($orthodontie);
        
        $orthopédie = new Speciality();
        $orthopédie->setName('Orthopédie');
        $manager->persist($orthopédie);
 
        $chirurgieBuccale = new Speciality();
        $chirurgieBuccale->setName('Chirurgie buccale');
        $manager->persist($chirurgieBuccale);
   
        $chirurgieMaxillofaciale = new Speciality();
        $chirurgieMaxillofaciale->setName('Chirurgie maxillofaciale');
        $manager->persist($chirurgieMaxillofaciale);
 
        $stomatologie = new Speciality();
        $stomatologie->setName('Stomatologie');
        $manager->persist($stomatologie);

        $radiologie = new Speciality();
        $radiologie->setName('Radiologie');
        $manager->persist($radiologie);

        $atm = new Speciality();
        $atm->setName('ATM');
        $manager->persist($atm);

        $muqueuseOrale = new Speciality();
        $muqueuseOrale->setName('Muqueuse orale');
        $manager->persist($muqueuseOrale);
            
        $gérodontologie = new Speciality();
        $gérodontologie->setName('Gérodontologie');
        $manager->persist($gérodontologie);


        $job1 = new Jobs();
        $job1->setName('Chirurgien Dentiste')
            ->setIdent('CD');
        $manager->persist($job1);

        $job2 = new Jobs();
        $job2->setName('Etudiant Dentiste')
            ->setIdent('ED');
        $manager->persist($job2);
 
        $job3 = new Jobs();
        $job3->setName('Dentiste Interne')
            ->setIdent('DI');
        $manager->persist($job3);

        // Utilisateurs

        $user->setPrenom('dentiio')
            ->setNom('dentiio')
            ->setPseudo('dentiio')
            ->setEmail('api@dentiio.fr')
            ->setIsEnabled(true)
            ->setJob($job2)
            ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]))
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');
        
        $manager->persist($user);

        $userAdmin = new User();
        $userAdmin->setPrenom('admin')
            ->setNom('admin')
            ->setPseudo('admin')
            ->setEmail('admin@dentiio.fr')
            ->setIsEnabled(true)
            ->setJob($job1)
            ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]))
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');
    
        $manager->persist($userAdmin);

        $userModerator = new User();
        $userModerator->setPrenom('moderator')
            ->setNom('moderator')
            ->setPseudo('moderator')
            ->setEmail('moderator@dentiio.fr')
            ->setIsEnabled(true)
            ->setJob($job3)
            ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]))
            ->setRoles(["ROLE_MODERATOR"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');
    
        $manager->persist($userModerator);

        // Cas Clinique
        for ($u=0; $u < 30; $u++){
            $user = new User();
            $user->setPrenom($faker->firstName)
                ->setNom($faker->lastName)
                ->setPseudo("$faker->lastName"."$faker->firstName")
                ->setEmail($faker->email)
                ->setIsEnabled(true)
                ->setJob($faker->randomElement([$job1, $job2, $job3]))
                ->setPassword('$2y$13$Q27cK8NiNv7FFDjdKOoloO2FvukD4sKSZuCS8MY41n7yitBA2.Aj2');

            $manager->persist($user);

            for($c=0; $c < 5; $c++){
                $patient = new Patient();
                $patient->setAge($faker->randomNumber())
                    ->setGender($faker->randomElement(["Monsieur", "Madame"]))
                    ->setIsASmoker($faker->boolean)
                    ->setIsMedicalBackground($faker->boolean)
                    ->setInTreatment('test')
                    ->setProblemHealth('test')
                ;
                $clinicalCase = new ClinicalCase();
                $clinicalCase->setUser($user)
                    ->setPatient($patient)
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
                    ->setIsEnabled($faker->randomElement([true,false]))
                    ->addSymptome($faker->randomElement([$irritabilite,$gencivesGonflees, $gencivesRougesOrBleues,$diarrheeLegere, $fessesRougesAndIrritees]));


                    for($n=0; $n < rand(1, 5); $n++){

                        $clinicalCase->addPathologie($faker->randomElement([$plaie,  $fracture, $brulure]))
                        ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]));
                    }

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
