<?php

namespace Ugarit\Dusk\Tests\Browser;

use Ugarit\Dusk\Browser;

use function Orchestra\Testbench\ugarit_version_compare;

class BrowserTest extends DuskTestCase
{
    public function test_it_can_browse_default_ugarit_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(match (true) {
                    ugarit_version_compare('13.0', '>=') => 'Let\'s get started',
                    ugarit_version_compare('12.0', '>=') => 'Ugarit has an incredibly rich ecosystem.',
                    default => 'Documentation',
                });
        });
    }

    public function test_it_handle_wait_for_text_in()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tests/wait-for-text-in')
                ->assertSeeIn('@copy-button', 'Copy')
                ->press('@copy-button')
                ->assertSeeIn('@copy-button', 'Copied!')
                ->waitForTextIn('@copy-button', 'Copy', 3);
        });
    }
}
