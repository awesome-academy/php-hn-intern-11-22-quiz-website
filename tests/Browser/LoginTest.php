<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    const EMAIL = 'phamvuhuy@mail.com';
    const PASSWORD = 'password';
    const WRONG_EMAIL = 'bingbong@chingchong';
    const WRONG_PASSWORD = 'chingchong';

    public function testLoginView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee(__('temp.welcome'))
                ->assertSee(__('temp.lang'))
                ->assertSee(__('temp.res'))
                ->assertSee(__('temp.in'))
                ->assertInputPresent('email')
                ->assertInputPresent('password')
                ->assertSee(__('temp.notpass'))
                ->assertSee(__('temp.remember'))
                ->assertSee(__('temp.creacc'))
                ->assertInputPresent('remember')
                ->assertSeeIn('@submit-form-login', __('temp.in'));
        });
    }

    public function testClickForgotPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->click('@forgot-password')
                ->assertRouteIs('password.request');
        });
    }

    public function testClickRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->clickAndWaitForReload('@btn-register')
                ->assertRouteIs('register');
        });
    }

    public function testClickCreateNewAccount()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->clickAndWaitForReload('@create-new-acc')
                ->assertRouteIs('register');
        });
    }

    public function testLoginFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', static::WRONG_EMAIL)
                ->type('password', static::WRONG_PASSWORD)
                ->clickAndWaitForReload('@submit-form-login')
                ->assertSee(__('auth.failed'));
        });
    }

    public function testLoginSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', static::EMAIL)
                ->type('password', static::PASSWORD)
                ->clickAndWaitForReload('@submit-form-login')
                ->assertSee(__('temp.welcome'));
        });
    }
}
