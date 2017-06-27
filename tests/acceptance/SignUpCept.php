<?php

// Test the complate sign up and defaul shelves flow.
$I = new AcceptanceTester($scenario);
$I->wantTo('sign up for booknshelf');

$I->amOnPage("/");

$I->click('SIGN UP');
$I->fillField('name', 'Miles');
$I->fillField('username', 'milesaaa');
$I->fillField('email', 'tik@test.com');
$I->fillField('password', 'password');

$I->click('register');

$I->seeCurrentUrlEquals('/');


$I->click('.menu');

$I->click('My profile');

$I->seeCurrentUrlEquals('/@milesaaa');

//$I->see('Books I have read');
