<?php

namespace Tests\Feature;

use Tests\TestCase;

class WorkshopTest extends TestCase
{
    public function test_advisor_displays_advice_based_on_age_and_interest(): void
    {
        $this->get('/advisor?age=22&interet=developpement')
            ->assertOk()
            ->assertSee('Vous avez 22 ans.')
            ->assertSee('développement est une bonne base')
            ->assertSee('explorer plusieurs pistes');

        $this->get('/advisor?age=30&interet=design')
            ->assertOk()
            ->assertSee('progresser en design')
            ->assertSee('Appuyez-vous sur votre expérience');

        $this->get('/advisor?age=23')
            ->assertOk()
            ->assertSee('Indiquez votre centre');
    }

    public function test_advisor_rejects_young_or_invalid_ages(): void
    {
        $this->get('/advisor?age=18')->assertRedirect('/acces-refuse');
        $this->get('/advisor?age=17')->assertRedirect('/acces-refuse');
        $this->get('/advisor')->assertStatus(422);
        $this->get('/advisor?age=abc')->assertStatus(422);

        $this->get('/acces-refuse')
            ->assertOk()
            ->assertSee('trop jeune');
    }

    public function test_articles_show_alerts_before_cards_with_article_content(): void
    {
        $response = $this->get('/articles')
            ->assertOk()
            ->assertSee('alert-success', false)
            ->assertSee('alert-error', false)
            ->assertSee('alert-info', false)
            ->assertSee('Titre1')
            ->assertSee('Auteur1')
            ->assertSee('Contenu1')
            ->assertSee('Titre2')
            ->assertSee('Auteur2')
            ->assertSee('Contenu2');

        $response->assertSeeInOrder(['alert-success', 'alert-error', 'alert-info', 'Titre1', 'Titre2'], false);
    }
}
