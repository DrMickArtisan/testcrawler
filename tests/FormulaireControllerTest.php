<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormulaireControllerTest extends WebTestCase
{

    /** Test de la soumission d'un formulaire
    * @dataProvider providePhases
    **/
    public function testIndex($data)
    {
        $client = static::createClient();
        //~ On ne veut pas récuperer les exceptions
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();

        //~ On appelle la page avec la phase donnée, pour récuperer le formulaire
        $form = $crawler->selectButton('Suivant');
        $form = $form->form($data);
        //~ On soumet le formulaire
        $crawler = $client->submit($form);
        $this->assertResponseIsSuccessful();
    }
    //~ Data provider pour le test "index"
    public function providePhases() {
        return  [
            'ToutOk' => [
                        ['formulaire[myArray]'  => ['hs','hdj']]
                    ],
            'nOk' => [
                        ['formulaire[myArray]'  => ['HC']]
                    ],
        ];
    }
}
