<?php
/**
 * MvcUI classe de gestion de la pagination
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.2.0
 */
namespace SYRADEV\app;

/**
 * Classe PaginateController étends MvcUIControlller
 * Gestion de la pagination
 */
class PaginateController extends MvcUIController
{

    protected static ?MvcUIController $instance = null;

    /**
     * Instantie l'objet PaginateController
     * @return PaginateController object *
     */
    public static function getInstance(): MvcUIController
    {
        if (PaginateController::$instance === null) {
            PaginateController::$instance = new PaginateController;
        }
        return PaginateController::$instance;
    }

    /**
     * Affiche la page de test de la pagination
     * @return void *
     */
    public function paginateDemo(): void
    {
        echo $this->render('Layouts.default', 'Templates.paginate', null, 'Démo Pagination');
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

    public function productslist() {
        echo $this->render('Layouts.default', 'Templates.productlist', null, 'Liste de produits');
    }


    /**
     * Affiche la page de démo du défilement de contenus infini
     * @param int $page
     * @param int $maxPerPage
     * @return void
     */
    public function infinitescroll(int $page, int $maxPerPage): void
    {
        $cnx = PdoMySQL::getInstance();
        // Récupère le nombre d'enregistrements
        $requeteNbProducts = 'SELECT COUNT(*) AS nbProduits FROM `Products`';
        $resultNBProducts = $cnx->requete($requeteNbProducts, 'fetch');
        $nbProduits = $resultNBProducts['nbProduits'];
        $nbPages = $nbProduits > 0 ? ceil($nbProduits/$maxPerPage) : 0;
        $position = $page === 1 ? 0 : $page * $maxPerPage;
        $requeteProducts = sprintf('SELECT * from `Products` ORDER BY `ProductID` LIMIT %d,%d', $position, $maxPerPage);
        echo $requeteProducts;
        $produits = $cnx->requete($requeteProducts);
        echo $this->renderPartial('products', $produits);
    }
}