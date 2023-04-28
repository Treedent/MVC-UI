<?php

namespace SYRADEV\app;

/**
 * Classe TestController étends MvcUIControlller
 */
class TestController extends MvcUIController
{

    protected static ?MvcUIController $instance = null;

    /**
     * Instantie l'objet TestController
     * @return MvcUIController object *
     */
    public static function getInstance(): MvcUIController
    {
        if (TestController::$instance === null) {
            TestController::$instance = new TestController;
        }
        return TestController::$instance;
    }

    /**
     * Fonction de test
     * @return void *
     */
    public function test1(): void
    {
        echo $this->render('Layouts.default', 'Templates.test');
    }

}