<?php

namespace App\Tests\Notification;

use App\Entity\Serie;
use App\Notification\Sender;
use App\Repository\SerieRepository;
use PHPUnit\Framework\TestCase;

class SenderTest extends TestCase
{

    /**
     * * A propos des tests de service:
     * * - on peut choisir de faire un test unitaire ou un test d'intégration
     * * - la différence c'est que dans le premier cas on va devoir faire un mock des des classes dont dépend le service (anetitymanager par exemple)
     * * dans le secon cas on doit instancier un kernel
     * * - l'un est plus rapide que l'autre, mais l'autre est plus réaliste que l'un
     * * - ici je vais utiliser un mock pour rester dans le cadre d'un test unitaire
     * * Source : https://symfonycasts.com/screencast/phpunit-integration/service-test
     * * exemple utilisé pour mock un repository : https://symfony.com/doc/6.4/testing/database.html
     */

    public function testSendAjoutSerieWithSuccess()
    {
        // Arrange
        // * Instanciation d'une entité $serie
        $serie = new Serie();
        $serie->setName("testnom");

        // * Mock du repository d'une série : on utilise la méthode create mock qui prend en paramètre la classe qu'on souhaite imiter
        $serieRepository = $this->createMock(SerieRepository::class);
        // * on dit ici à notre imitation comment elle doit agir quand on fera appel à la méthode findAll(),
        // * en l'occurrence, elle retourne un tableau qui contient l'objets $serie faussement enregistré en base
        $serieRepository->expects($this->any())
            ->method('findAll')
            ->willReturn([$serie]);

        // * Maintenant qu'on a une instance de SerieRepositroy, on peut créer une instance de notre service
        $service = new Sender($serieRepository);
        
        // Act
        // * On appelle la méthode à tester
        $service->sendAjoutSerieWithSuccess($serie);

        // Assert
        // * est ce que le fichier existe ?
        $this->assertFileExists('debug.txt', 'le fichier n\'existe pas');
        // * est ce que le fichier contient bien le nom de la nouvelle série ajouter en BDD ?
        $this->assertStringEqualsFile(
            'debug.txt',
            'testnom',
            'Le contenu du fichier n\'est pas correct'
        );
    }
}