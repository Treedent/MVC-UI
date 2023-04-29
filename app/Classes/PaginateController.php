<?php

namespace SYRADEV\app;

/**
 * Classe PaginateController étends MvcUIControlller
 */
class PaginateController extends MvcUIController
{

    protected static ?MvcUIController $instance = null;

    /**
     * Instantie l'objet PaginateController
     * @return MvcUIController object *
     */
    public static function getInstance(): MvcUIController
    {
        if (PaginateController::$instance === null) {
            PaginateController::$instance = new PaginateController;
        }
        return PaginateController::$instance;
    }

    /**
     * Fonction de test
     * @return void *
     */
    public function paginateDemo(): void
    {
        echo $this->render('Layouts.default', 'Templates.paginate');
    }

    /**
     * Construit une barre de pagination
     * @param int $num
     * @param int $maxpage
     * @param string $align
     * @return string
     */
    public static function getPagination(int $num, int $maxpage, string $align):string {
        return (new self)->renderPartial('pagination', ['num'=>$num,'maxpage'=>$maxpage, 'align'=>$align]);
    }


}