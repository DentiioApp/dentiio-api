<?php
namespace App\DataFixtures;

use App\Entity\Avatar;
use App\Entity\CategoriePathologie;
use App\Entity\ClinicalCase;
use App\Entity\Commentaire;
use App\Entity\Favorite;
use App\Entity\ImageClinicalCase;
use App\Entity\ImageClinicalCaseType;
use App\Entity\Jobs;
use App\Entity\Keyword;
use App\Entity\MessageNotification;
use App\Entity\Notation;
use App\Entity\Notification;
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

        // Traumatoloqgie
        $traumatologie = new CategoriePathologie();
        $traumatologie->setName("Traumatologie Facial");
        $manager->persist($traumatologie);



        $plaie = new Pathologie();
        $plaie->setName('Plaies de la face');
        $plaie->setCategorie($traumatologie);
        $manager->persist($plaie);

        $fracture = new Pathologie();
        $fracture->setName('Fracture de la face');
        $fracture->setCategorie($traumatologie);
        $manager->persist($fracture);

        $brulure = new Pathologie();
        $brulure->setName('Brûlure de la face');
        $brulure->setCategorie($traumatologie);
        $manager->persist($brulure);

        $fractureFaciale = new Pathologie();
        $fractureFaciale->setName('Fractures du massif facial');
        $fractureFaciale->setCategorie($traumatologie);
        $manager->persist($fractureFaciale);

        $mandibule = new Pathologie();
        $mandibule->setName('Fractures de la mandibule');
        $mandibule->setCategorie($traumatologie);
        $manager->persist($mandibule);

        $coronaire = new Pathologie();
        $coronaire->setName('Fracture coronaire');
        $coronaire->setCategorie($traumatologie);
        $manager->persist($coronaire);

        $corono = new Pathologie();
        $corono->setName('Fracture corono-radicualires');
        $corono->setCategorie($traumatologie);
        $manager->persist($corono);

        $traumaTissu = new Pathologie();
        $traumaTissu->setName('Traumatisme des tissus pardontaux');
        $traumaTissu->setCategorie($traumatologie);
        $manager->persist($traumaTissu);

        $osAlveolaire = new Pathologie();
        $osAlveolaire->setName('Fracture de l\'os alveolaire');
        $osAlveolaire->setCategorie($traumatologie);
        $manager->persist($osAlveolaire);

        $traumaDent = new Pathologie();
        $traumaDent->setName('Traumatisme des dents temporaires');
        $traumaDent->setCategorie($traumatologie);
        $manager->persist($traumaDent);


        // Pathologies Dentaire
        $pathDentaire = new CategoriePathologie();
        $pathDentaire->setName("Pathologies Dentaires");
        $manager->persist($pathDentaire);

        $dentSurnum = new Pathologie();
        $dentSurnum->setName('Dents surnumeraires');
        $dentSurnum->setCategorie($pathDentaire);
        $manager->persist($dentSurnum);

        $anomEruption = new Pathologie();
        $anomEruption->setName('Anomalies d\'eruption');
        $anomEruption->setCategorie($pathDentaire);
        $manager->persist($anomEruption);

        $amelogenese = new Pathologie();
        $amelogenese->setName('Amelogenese imparfaite');
        $amelogenese->setCategorie($pathDentaire);
        $manager->persist($amelogenese);

        $dylapsie = new Pathologie();
        $dylapsie->setName('Dysplasie dentinaire');
        $dylapsie->setCategorie($pathDentaire);
        $manager->persist($dylapsie);

        $carie = new Pathologie();
        $carie->setName('Carie dentaire');
        $carie->setCategorie($pathDentaire);
        $manager->persist($carie);

        $pulpite = new Pathologie();
        $pulpite->setName('Pulpites');
        $pulpite->setCategorie($pathDentaire);
        $manager->persist($pulpite);

        $desmodentite = new Pathologie();
        $desmodentite->setName('Desmodontites');
        $desmodentite->setCategorie($pathDentaire);
        $manager->persist($desmodentite);

        $endocardite = new Pathologie();
        $endocardite->setName('Endocardite infectieuses');
        $endocardite->setCategorie($pathDentaire);
        $manager->persist($endocardite);

        $cellulite = new Pathologie();
        $cellulite->setName('Cellulites faciales');
        $cellulite->setCategorie($pathDentaire);
        $manager->persist($cellulite);

        // Parodontopathies
        $parodontopathies = new CategoriePathologie();
        $parodontopathies->setName("Parodontopathies");
        $manager->persist($parodontopathies);

        $gingivite = new Pathologie();
        $gingivite->setName('Gingivites');
        $gingivite->setCategorie($parodontopathies);
        $manager->persist($gingivite);

        $parodontieChronique = new Pathologie();
        $parodontieChronique->setName('Parodontite chronique');
        $parodontieChronique->setCategorie($parodontopathies);
        $manager->persist($parodontieChronique);

        // Pathologie de la muqueuse buccale
        $muqueuseBuccale = new CategoriePathologie();
        $muqueuseBuccale->setName("Pathologie de la muqueuse buccale");
        $manager->persist($muqueuseBuccale);

        $Stomatites = new Pathologie();
        $Stomatites->setName('Stomatites');
        $Stomatites->setCategorie($muqueuseBuccale);
        $manager->persist($Stomatites);

        $Pseudokyste = new Pathologie();
        $Pseudokyste->setName('Pseudokyste mucoide');
        $Pseudokyste->setCategorie($muqueuseBuccale);
        $manager->persist($Pseudokyste);

        $Lipome = new Pathologie();
        $Lipome->setName('Lipome');
        $Lipome->setCategorie($muqueuseBuccale);
        $manager->persist($Lipome);

        $Papilome = new Pathologie();
        $Papilome->setName('Papilome');
        $Papilome->setCategorie($muqueuseBuccale);
        $manager->persist($Papilome);

        // Maladies infectieuses et stomatologie
        $stomatologie = new CategoriePathologie();
        $stomatologie->setName("Maladies infectieuses et stomatologie");
        $manager->persist($stomatologie);

        $Tuberculose = new Pathologie();
        $Tuberculose->setName('Tuberculose');
        $Tuberculose->setCategorie($stomatologie);
        $manager->persist($Tuberculose);

        $Syphilis = new Pathologie();
        $Syphilis->setName('Syphilis');
        $Syphilis->setCategorie($stomatologie);
        $manager->persist($Syphilis);

        $vih = new Pathologie();
        $vih->setName('Infection VIH');
        $vih->setCategorie($stomatologie);
        $manager->persist($vih);

        //Symptomes
        $irritabilite = new Symptome();
        $irritabilite->setName('Irritabilité');
        $manager->persist($irritabilite);

        $gencivesGonflees = new Symptome();
        $gencivesGonflees->setName('Gencives gonflées');
        $manager->persist($gencivesGonflees);

        $gencivesRougesOrBleues = new Symptome();
        $gencivesRougesOrBleues->setName('Gencives rouges');
        $manager->persist($gencivesRougesOrBleues);

        $diarrheeLegere = new Symptome();
        $diarrheeLegere->setName('Diarrhée légère');
        $manager->persist($diarrheeLegere);

        $fessesRougesAndIrritees = new Symptome();
        $fessesRougesAndIrritees->setName('Fesses rouges et irritées.');
        $manager->persist($fessesRougesAndIrritees);

        //Image clinical case type
        $principal = new ImageClinicalCaseType();
        $principal->setName("principal");
        $manager->persist($principal);

        $scanner = new ImageClinicalCaseType();
        $scanner->setName("scanner");
        $manager->persist($scanner);

        $biopsy = new ImageClinicalCaseType();
        $biopsy->setName("biopsy");
        $manager->persist($biopsy);


        $examen = new ImageClinicalCaseType();
        $examen->setName("examen");
        $manager->persist($examen);

        $treatmentplan = new ImageClinicalCaseType();
        $treatmentplan->setName("plan-de-traitement");
        $manager->persist($treatmentplan);

        $evolution = new ImageClinicalCaseType();
        $evolution->setName("evolution");
        $manager->persist($evolution);

        //Speciality
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



        $detartrage = new Treatment();
        $detartrage->setName('Détartrage');
        $detartrage->setSpeciality($omnipratique);
        $manager->persist($detartrage);

        $devitalisation = new Treatment();
        $devitalisation->setName('Dévitalisation');
        $devitalisation->setSpeciality($omnipratique);
        $manager->persist($devitalisation);

        $extraction = new Treatment();
        $extraction->setName('Extractions');
        $extraction->setSpeciality($omnipratique);
        $manager->persist($extraction);

        $protheseDentaire = new Treatment();
        $protheseDentaire->setName('Prothèses dentaires');
        $protheseDentaire->setSpeciality($omnipratique);
        $manager->persist($protheseDentaire);



        $greffe = new Treatment();
        $greffe->setName('Greffe osseuse');
        $greffe->setSpeciality($implantologie);
        $manager->persist($greffe);

        $sinusLift = new Treatment();
        $sinusLift->setName('Sinus lift');
        $sinusLift->setSpeciality($implantologie);
        $manager->persist($sinusLift);

        $poseImplant = new Treatment();
        $poseImplant->setName('Pose d\'implant');
        $poseImplant->setSpeciality($implantologie);
        $manager->persist($poseImplant);

        $protheseImplant = new Treatment();
        $protheseImplant->setName('Prothèse sur implant');
        $protheseImplant->setSpeciality($implantologie);
        $manager->persist($protheseImplant);


        $gingivectomie = new Treatment();
        $gingivectomie->setName('Gingivectomie');
        $gingivectomie->setSpeciality($parodontie);
        $manager->persist($gingivectomie);

        $resecCrete = new Treatment();
        $resecCrete->setName('Résection des crêtes');
        $resecCrete->setSpeciality($parodontie);
        $manager->persist($resecCrete);

        $gingivectomie = new Treatment();
        $gingivectomie->setName('Ostéoplastie');
        $gingivectomie->setSpeciality($parodontie);
        $manager->persist($gingivectomie);

        $paroGreffe = new Treatment();
        $paroGreffe->setName('Greffes');
        $paroGreffe->setSpeciality($parodontie);
        $manager->persist($paroGreffe);

        $lambChirurgicaux = new Treatment();
        $lambChirurgicaux->setName('Lambeaux chirurgicaux');
        $lambChirurgicaux->setSpeciality($parodontie);
        $manager->persist($lambChirurgicaux);



        //keywords
        $cancerKeyword = new Keyword();
        $cancerKeyword->setName('Cancer');
        $manager->persist($cancerKeyword);

        $smokerKeyword = new Keyword();
        $smokerKeyword->setName('Fumeur');
        $manager->persist($smokerKeyword);

        $fractureKeyword = new Keyword();
        $fractureKeyword->setName('Fracture');
        $manager->persist($fractureKeyword);

        $Alcool = new Keyword();
        $Alcool->setName('Alcool');
        $manager->persist($Alcool);

        $Greffe = new Keyword();
        $Greffe->setName('Greffe');
        $manager->persist($Greffe);

        $Enfant = new Keyword();
        $Enfant->setName('Enfant');
        $manager->persist($Enfant);

        $Douleur = new Keyword();
        $Douleur->setName('Douleur');
        $manager->persist($Douleur);

        $Parodontie = new Keyword();
        $Parodontie->setName('Parodontie');
        $manager->persist($Parodontie);

        $conplication = new Keyword();
        $conplication->setName('Complication');
        $manager->persist($conplication);

        $protheseKeyword = new Keyword();
        $protheseKeyword->setName('Prothèse');
        $manager->persist($protheseKeyword);

        $carAccidentKeyword = new Keyword();
        $carAccidentKeyword->setName('Accident de voiture');
        $manager->persist($carAccidentKeyword);

        $allergieKeyword = new Keyword();
        $allergieKeyword->setName('Allergie');
        $manager->persist($allergieKeyword);



        //Jobs
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

        $user = new User();
        $user->setPrenom('Nikita de Dentiio')
            ->setNom('dentiio')
            ->setPseudo('dentiio')
            ->setEmail('api@dentiio.fr')
            ->setIsEnabled(true)
            ->setJob($job2)
            ->setCreatedAt(new \DateTime('NOW'))
            ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]))
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');

        $manager->persist($user);

        $avatar = new Avatar();
        $avatar->setAccessoriesType("Blank")
            ->setClotheColor("Red")
            ->setClotheType("ShirtCrewNeck")
            ->setEyebrowType("Default")
            ->setEyeType("Dizzy")
            ->setFacialHairColor("BrownDark")
            ->setFacialHairType("Blank")
            ->setHairColor("BrownDark")
            ->setMouthType("Smile")
            ->setSkinColor("Brown")
            ->setTopType("ShortHairShortWaved")
            ->setUser($user);
        $manager->persist($avatar);


        $userAdmin = new User();
        $userAdmin->setPrenom('admin')
            ->setNom('admin')
            ->setPseudo('admin')
            ->setEmail('admin@dentiio.fr')
            ->setIsEnabled(true)
            ->setJob($job1)
            ->setCreatedAt(new \DateTime('NOW'))
            ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]))
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');

        $manager->persist($userAdmin);

        $avatar = new Avatar();
        $avatar->setAccessoriesType("Blank")
            ->setClotheColor("Red")
            ->setClotheType("ShirtCrewNeck")
            ->setEyebrowType("Default")
            ->setEyeType("Dizzy")
            ->setFacialHairColor("BrownDark")
            ->setFacialHairType("Blank")
            ->setHairColor("BrownDark")
            ->setMouthType("Smile")
            ->setSkinColor("Brown")
            ->setTopType("ShortHairShortWaved")
            ->setUser($userAdmin);
        $manager->persist($avatar);

        $userModerator = new User();
        $userModerator->setPrenom('moderator')
            ->setNom('moderator')
            ->setPseudo('moderator')
            ->setEmail('moderator@dentiio.fr')
            ->setIsEnabled(true)
            ->setJob($job3)
            ->setCreatedAt(new \DateTime('NOW'))
            ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]))
            ->setRoles(["ROLE_MODERATOR"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$36aRrz+SmeQb08j79kmbLw$ktAwWQX8cjHj8ZcpzCWWkwPxHwN3QxAABDYMO/MROT0');

        $manager->persist($userModerator);

        $avatar = new Avatar();
        $avatar->setAccessoriesType("Blank")
            ->setClotheColor("Red")
            ->setClotheType("ShirtCrewNeck")
            ->setEyebrowType("Default")
            ->setEyeType("Dizzy")
            ->setFacialHairColor("BrownDark")
            ->setFacialHairType("Blank")
            ->setHairColor("BrownDark")
            ->setMouthType("Smile")
            ->setSkinColor("Brown")
            ->setTopType("ShortHairShortWaved")
            ->setUser($userModerator);
        $manager->persist($avatar);

        //Messages Notifications
        $message1 = new MessageNotification();
        $message1->setMessage("a publié un commentaire sur votre cas");
        $manager->persist($message1);
        $message2 = new MessageNotification();
        $message2->setMessage("a noté votre cas");
        $manager->persist($message2);
        $message3 = new MessageNotification();
        $message3->setMessage("vous a envoyé un message");
        $manager->persist($message3);
        $message4 = new MessageNotification();
        $message4->setMessage("a participé à votre discussion");
        $manager->persist($message4);

        // Cas Clinique
        $userBasic = new User();
        $userBasic->setPrenom($faker->firstName)
            ->setNom($faker->lastName)
            ->setPseudo("$faker->lastName"."$faker->firstName")
            ->setEmail($faker->email)
            ->setIsEnabled(true)
            ->setJob($faker->randomElement([$job1, $job2, $job3]))
            ->setCreatedAt(new \DateTime('NOW'))
            ->setPassword('$2y$13$Q27cK8NiNv7FFDjdKOoloO2FvukD4sKSZuCS8MY41n7yitBA2.Aj2');

        $manager->persist($userBasic);


        $patient = new Patient();
        $patient->setAge($faker->randomNumber($nbDigits = 2, $strict = true))
            ->setGender($faker->randomElement(["Masculin", "Féminin"]))
            ->setIsASmoker($faker->boolean)
            ->setInTreatment('Aucun')
            ->setProblemHealth('Aucun')
        ;
        $manager->persist($patient);

        $clinicalCase = new ClinicalCase();
        $clinicalCase->setUser($user)
            ->setPatient($patient)
            ->setCreatedAt(new \DateTime('NOW'))
            ->setTitle("Gingivite complexe")
            ->setPresentation("Patient de 25 ans, non fumeur, sans antécédents médicaux. Il a perdu les dents supero-antérieures il y a 10 ans lors d’un accident de voiture. Les dents infero-anterieur ont une légère mobilité et sont douloureuses depuis quelques jours.")
            ->setEvolution("Evolution au bout d’un mois après le traitement. Plus de movilité, plus de douleur.")
            ->setTreatmentPlan("Mise sous antibiotique (amoxicilline acide clavulanique) pour diminuer la douleur. Traitement endodontique des 3 incisives inférieures restantes 3 jours après plus surfaçage de la zone.")
            ->setObservation("A la radio panoramique on observe un kyste qui englobe les racine de 31 41 42 et l’absence de 32.")
            ->setConclusion("Traitement réussi avec succès. A surveiller, le patient revient dans 6 mois pour un contrôle")
            ->setAge($faker->randomDigit)
            ->setUpdatedAt(new \DateTime('NOW'))
            ->setAverage($faker->randomDigit)
            ->setSmoking($faker->randomElement([true,false]))
            ->setIsEnabled($faker->randomElement([true,false]))
            ->setReasonConsult("La patient a des douleurs au niveau de la gencive")
            ->setScanner("Aucun scanner")
            ->setBiopsy("Aucune")
            ->setDiagnostic("Kyste traumatique")
            ->addSymptome($faker->randomElement([$irritabilite,$gencivesGonflees, $gencivesRougesOrBleues,$diarrheeLegere, $fessesRougesAndIrritees]));

        for($n=0; $n < rand(1, 5); $n++){

            $clinicalCase->addPathologie($faker->randomElement([$plaie,  $fracture, $brulure]))
                ->addKeyword($faker->randomElement([$allergieKeyword,  $carAccidentKeyword, $fractureKeyword, $smokerKeyword,$cancerKeyword,$fractureKeyword,$Alcool,$Greffe,$Enfant, $Douleur, $Parodontie]))
                ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]));
        }

        $manager->persist($clinicalCase);

        $imagePrincipal = new ImageClinicalCase();
        $imagePrincipal->setClinicalCase($clinicalCase)
            ->setType($principal)
            ->setPath($faker->randomElement(["fixtures/1apres.jpg", "fixtures/1avant.jpg", "fixtures/dent-necrose.jpg", "fixtures/dent-sur-numerer.jpg", "fixtures/gencive.jpg", "fixtures/gout.jpg", "fixtures/radio.jpg"]));
        $manager->persist($imagePrincipal);

        //Image Clinical case
        for ($n=0; $n < rand(5, 9); $n++){
            $image = new ImageClinicalCase();
            $image->setClinicalCase($clinicalCase)
                ->setType($faker->randomElement([$scanner, $biopsy, $treatmentplan, $examen, $evolution]))
                ->setPath($faker->randomElement(["fixtures/1apres.jpg", "fixtures/1avant.jpg", "fixtures/dent-necrose.jpg", "fixtures/dent-sur-numerer.jpg", "fixtures/gencive.jpg", "fixtures/gout.jpg", "fixtures/radio.jpg"]));
            $manager->persist($image);
        }

        $patient1 = new Patient();
        $patient1->setAge($faker->randomNumber($nbDigits = 2, $strict = true))
            ->setGender($faker->randomElement(["Masculin", "Féminin"]))
            ->setIsASmoker($faker->boolean)
            ->setIsMedicalBackground($faker->boolean)
            ->setInTreatment('Aucun')
            ->setProblemHealth('Aucun')
        ;
        $manager->persist($patient1);

        $clinicalCase1 = new ClinicalCase();
        $clinicalCase1->setUser($user)
            ->setPatient($patient1)
            ->setCreatedAt(new \DateTime('NOW'))
            ->setTitle("Extraction pièce antérieure")
            ->setPresentation("La patiente âgée de 49 ans, vient consulter pour une réhabilitation prothétique suite à l’extraction de la 16. Les 2 prémolaires et la molaire porteuses d’amalgame sont pulpées.")
            ->setEvolution("Plus de mobilité, plus de douleur.")
            ->setTreatmentPlan("Remplacement de l’amalgame sur la 14 par un composite.")
            ->setObservation(" La tige raccordant le faux moignon à l’ébauche doit être supprimée, après quoi le faux moignon doit subir un nouveau scan avant la réalisation de la chape.")
            ->setConclusion("Traitement réussi avec succès.")
            ->setAge($faker->randomDigit)
            ->setUpdatedAt(new \DateTime('NOW'))
            ->setAverage($faker->randomDigit)
            ->setSmoking($faker->randomElement([true,false]))
            ->setIsEnabled($faker->randomElement([true,false]))
            ->setReasonConsult("Douleurs")
            ->setScanner("Aucun scanner")
            ->setBiopsy("Aucune")
            ->setDiagnostic("Kyste traumatique")
            ->addSymptome($faker->randomElement([$irritabilite,$gencivesGonflees, $gencivesRougesOrBleues,$diarrheeLegere, $fessesRougesAndIrritees]));

        for($n=0; $n < rand(1, 5); $n++){

            $clinicalCase1->addPathologie($faker->randomElement([$plaie,  $fracture, $brulure]))
                ->addKeyword($faker->randomElement([$allergieKeyword,  $carAccidentKeyword, $fractureKeyword, $smokerKeyword,$cancerKeyword,$fractureKeyword,$Alcool,$Greffe,$Enfant, $Douleur, $Parodontie]))
                ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]));
        }

        $manager->persist($clinicalCase1);

        $imagePrincipal = new ImageClinicalCase();
        $imagePrincipal->setClinicalCase($clinicalCase1)
            ->setType($principal)
            ->setPath($faker->randomElement(["fixtures/1apres.jpg", "fixtures/1avant.jpg", "fixtures/dent-necrose.jpg", "fixtures/dent-sur-numerer.jpg", "fixtures/gencive.jpg", "fixtures/gout.jpg", "fixtures/radio.jpg"]));
        $manager->persist($imagePrincipal);

        //Image Clinical case
        for ($n=0; $n < rand(5, 9); $n++){
            $image = new ImageClinicalCase();
            $image->setClinicalCase($clinicalCase1)
                ->setType($faker->randomElement([$scanner, $biopsy, $treatmentplan, $examen, $evolution]))
                ->setPath($faker->randomElement(["fixtures/1apres.jpg", "fixtures/1avant.jpg", "fixtures/dent-necrose.jpg", "fixtures/dent-sur-numerer.jpg", "fixtures/gencive.jpg", "fixtures/gout.jpg", "fixtures/radio.jpg"]));
            $manager->persist($image);
        }


        $patient2 = new Patient();
        $patient2->setAge($faker->randomNumber($nbDigits = 2, $strict = true))
            ->setGender($faker->randomElement(["Masculin", "Féminin"]))
            ->setIsASmoker($faker->boolean)
            ->setIsMedicalBackground($faker->boolean)
            ->setInTreatment('Il a été traité par des anti-inflammatoires non stéroïdiens (AINS)')
            ->setProblemHealth('alcoolo-tabagisme')
        ;
        $manager->persist($patient2);

        $clinicalCase2 = new ClinicalCase();
        $clinicalCase2->setUser($user)
            ->setPatient($patient2)
            ->setCreatedAt(new \DateTime('NOW'))
            ->setTitle("Cellulite d'origine dentaire")
            ->setPresentation("Les cellulites cervico-faciales compliquent souvent une infection dentaire et plus rarement une infection de la sphère oto-rhino-laryngologique (ORL). Elles se propagent par voie indirecte via des emboles septiques mais le plus souvent par contiguïté vers la région cervicale.")
            ->setEvolution("Plus de mobilité, plus de douleur.")
            ->setTreatmentPlan("Lame de drainage cervical en place.TDM cervicale en reconstruction sagittale, montrant l’extension de la cellulite au
niveau du cou.")
            ->setObservation(" Orthopantomogramme montrant la dent 46 mortifiée. ")
            ->setConclusion("La Cellulite n'est plus visible")
            ->setAge($faker->randomDigit)
            ->setUpdatedAt(new \DateTime('NOW'))
            ->setAverage($faker->randomDigit)
            ->setSmoking($faker->randomElement([true,false]))
            ->setIsEnabled($faker->randomElement([true,false]))
            ->setReasonConsult("Douleurs")
            ->setScanner("Aucun scanner")
            ->setBiopsy("Aucune")
            ->setDiagnostic("Dent mortifiée")
            ->addSymptome($faker->randomElement([$irritabilite,$gencivesGonflees, $gencivesRougesOrBleues,$diarrheeLegere, $fessesRougesAndIrritees]));

        for($n=0; $n < rand(1, 5); $n++){

            $clinicalCase2->addPathologie($faker->randomElement([$plaie,  $fracture, $brulure]))
                ->addKeyword($faker->randomElement([$allergieKeyword,  $carAccidentKeyword, $fractureKeyword, $smokerKeyword,$cancerKeyword,$fractureKeyword,$Alcool,$Greffe,$Enfant, $Douleur, $Parodontie]))
                ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]));
        }

        $manager->persist($clinicalCase2);

        $imagePrincipal = new ImageClinicalCase();
        $imagePrincipal->setClinicalCase($clinicalCase2)
            ->setType($principal)
            ->setPath($faker->randomElement(["fixtures/1apres.jpg", "fixtures/1avant.jpg", "fixtures/dent-necrose.jpg", "fixtures/dent-sur-numerer.jpg", "fixtures/gencive.jpg", "fixtures/gout.jpg", "fixtures/radio.jpg"]));
        $manager->persist($imagePrincipal);

        //Image Clinical case
        for ($n=0; $n < rand(5, 9); $n++){
            $image = new ImageClinicalCase();
            $image->setClinicalCase($clinicalCase2)
                ->setType($faker->randomElement([$scanner, $biopsy, $treatmentplan, $examen, $evolution]))
                ->setPath($faker->randomElement(["fixtures/1apres.jpg", "fixtures/1avant.jpg", "fixtures/dent-necrose.jpg", "fixtures/dent-sur-numerer.jpg", "fixtures/gencive.jpg", "fixtures/gout.jpg", "fixtures/radio.jpg"]));
            $manager->persist($image);
        }

        $patient3 = new Patient();
        $patient3->setAge($faker->randomNumber($nbDigits = 2, $strict = true))
            ->setGender($faker->randomElement(["Masculin", "Féminin"]))
            ->setIsASmoker($faker->boolean)
            ->setIsMedicalBackground($faker->boolean)
            ->setInTreatment('CHIMIOTHÉRAPIE')
            ->setProblemHealth('AVC')
        ;
        $manager->persist($patient3);

        $clinicalCase3 = new ClinicalCase();
        $clinicalCase3->setUser($userBasic)
            ->setPatient($patient3)
            ->setCreatedAt(new \DateTime('NOW'))
            ->setTitle("LYMPHOME APRÈS CHIMIOTHÉRAPIE")
            ->setPresentation("Cancer du système lymphatique qui se développe aux dépens des lymphocytes")
            ->setEvolution("Plus de mobilité, plus de douleur.")
            ->setTreatmentPlan("Lame de drainage cervical en place.TDM cervicale en reconstruction sagittale, montrant l’extension de la cellulite au
niveau du cou.")
            ->setObservation("TDM, confirmant une volumineuse adénopathie submandibulaire gauche")
            ->setConclusion("Lymphome réduit")
            ->setAge($faker->randomDigit)
            ->setUpdatedAt(new \DateTime('NOW'))
            ->setAverage($faker->randomDigit)
            ->setSmoking($faker->randomElement([true,false]))
            ->setIsEnabled($faker->randomElement([true,false]))
            ->setReasonConsult("Suite à une chimio")
            ->setScanner("Lymphome sur gencive près de la 14")
            ->setBiopsy("Cellule regénératrices")
            ->setDiagnostic("Lymphome B diffus à grandes cellules centroblastiques polymorphes")
            ->addSymptome($faker->randomElement([$irritabilite,$gencivesGonflees, $gencivesRougesOrBleues,$diarrheeLegere, $fessesRougesAndIrritees]));

        for($n=0; $n < rand(1, 5); $n++){

            $clinicalCase3->addPathologie($faker->randomElement([$plaie,  $fracture, $brulure]))
                ->addKeyword($faker->randomElement([$allergieKeyword,  $carAccidentKeyword, $fractureKeyword, $smokerKeyword,$cancerKeyword,$fractureKeyword,$Alcool,$Greffe,$Enfant, $Douleur, $Parodontie]))
                ->addSpeciality($faker->randomElement([$omnipratique, $orthopédie, $chirurgieBuccale, $esthétique, $parodontie, $parodontie, $pedodontie, $implantologie, $orthodontie, $chirurgieMaxillofaciale, $stomatologie, $radiologie, $atm, $muqueuseOrale, $gérodontologie  ]));
        }

        $manager->persist($clinicalCase3);

        $imagePrincipal = new ImageClinicalCase();
        $imagePrincipal->setClinicalCase($clinicalCase3)
            ->setType($principal)
            ->setPath($faker->randomElement(["fixtures/1apres.jpg", "fixtures/1avant.jpg", "fixtures/dent-necrose.jpg", "fixtures/dent-sur-numerer.jpg", "fixtures/gencive.jpg", "fixtures/gout.jpg", "fixtures/radio.jpg"]));
        $manager->persist($imagePrincipal);

        //Image Clinical case
        for ($n=0; $n < rand(5, 9); $n++){
            $image = new ImageClinicalCase();
            $image->setClinicalCase($clinicalCase3)
                ->setType($faker->randomElement([$scanner, $biopsy, $treatmentplan, $examen, $evolution]))
                ->setPath($faker->randomElement(["fixtures/1apres.jpg", "fixtures/1avant.jpg", "fixtures/dent-necrose.jpg", "fixtures/dent-sur-numerer.jpg", "fixtures/gencive.jpg", "fixtures/gout.jpg", "fixtures/radio.jpg"]));
            $manager->persist($image);
        }








        //Notifications
        $notification = new Notification();
        $notification->setMessage($faker->randomElement([$message1, $message2, $message3, $message4]))
            ->setCreatedAt(new \DateTime('NOW'))
            ->setViewAt($faker->randomElement([new \DateTime('NOW'), null]))
            ->setReceiver($faker->randomElement([$user, $userAdmin, $userModerator]))
            ->setSender($faker->randomElement([$userBasic, $userModerator]))
            ->setClinicalCase($clinicalCase);

        $manager->persist($notification);

        //Favorites
        $favorite = new Favorite();
        $favorite->setCreatedAt(new \DateTime('NOW'))
            ->setUserId($user)
            ->setClinicalCaseId($clinicalCase);

        $manager->persist($favorite);

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

        $manager->flush();
    }
}
