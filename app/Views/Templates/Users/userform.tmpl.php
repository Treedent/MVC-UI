<?php
/**
 * MvcUI formulaire d'ajout/Modification d'un utilisateur
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.5.0
 */

use SYRADEV\app\UsersController;

/**
 * @var array $data Les données en provenance du controller
 * $data['action'] > newuser || edituser
 * $data['userid']
 * $data['userinfos']
 */
extract($data);

/**
 * @string $mandatory Message pour les champs obligatoires
 */
$mandatory = '(<span class="text-danger">*</span>)';

/**
 * @array $formErrors Tableau pour stocker le nom des champs en erreur
 */
$formErrors = [];

/**
 * @string $xxxValidationClass Chaines pour stocker les classes à appliquer aux champs en erreur
 */
$firstnameValidationClass = $lastnameValidationClass = $emailValidationClass = $passwordValidationClass = '';

/**
 * Instanciation du contrôleur UsersController
 */
$usersObj = UsersController::getInstance();

/**
 * On récupère le jeton CSRF
 */
$csrfToken = UsersController::getCSRFToken();

/** Validation du formulaire */
if (isset($_POST['useraction']) && !empty($_POST['useraction'])) {
    // Le champ prénom ne peut être vide
    if (empty($_POST['firstname'])) {
        $formErrors[] = 'firstname';
    }
    // Le champ nom ne peut être vide
    if (empty($_POST['lastname'])) {
        $formErrors[] = 'lastname';
    }
    // Le champ adresse email encrypté ne peut être vide
    // et doit être valide
    if (empty($_POST['cryptedEmail']) || !$usersObj->validateEmail($usersObj->aesDecrypt(base64_decode($_POST['cryptedEmail']), $csrfToken))) {
        $formErrors[] = 'email';
    }
    // Pour un nouvel utilisateur, le champ mot de passe encrypté ne peut être vide
    if ($action === 'newuser' && empty($_POST['cryptedPw'])) {
        $formErrors[] = 'password';
    }


    /** S'il n'y a pas d'erreur de saisie dans le formulaire */
    if (empty($formErrors)) {

        /** On valide le jeton csrf */
        if ($usersObj->validateFormRequest()) {

            /** Ajout du nouvel utilisateur */
            if ($action === 'newuser') {
                $insertUser = $usersObj->createUser($_POST);
                if ($insertUser) {
                    header('location: ' . UsersController::getRoute('users'));
                }
            }

            /** Modification d'un utilisateur existant */
            if ($action === 'edituser' && !empty($_POST['uid'])) {
                $updateUser = $usersObj->updateUser($_POST);
                if ($updateUser) {
                    header('location: ' . UsersController::getRoute('users'));
                }
            }
        }
    }
}
?>

<div class="container">
    <?php
    // Détermination de l'action du formulaire
    $actionform = '';
    switch ($action) {
        case 'newuser':
            $actionform = UsersController::getRoute('newuser');
            break;
        case 'edituser':
            $actionform = UsersController::getRoute('edituser') . '/' . $userinfos['uid'];
            break;
    }
    ?>

    <form action="<?= $actionform; ?>" id="userform" method="post" autocomplete="off">

        <!-- Header Area -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 text-center p-3 bg-ui wow bounceIn">
                <a class="d-flex justify-content-start small link-underline link-underline-opacity-25 link-underline-opacity-100-hover"
                   href="<?= UsersController::getRoute('users'); ?>">&lt; Retour à la liste</a>
                <?php if ($action === 'newuser') { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#833500"
                         class="bi bi-person-add"
                         viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                        <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                    </svg>
                <?php } elseif ($action === 'edituser') { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#833500"
                         class="bi bi-person-gear"
                         viewBox="0 0 16 16">
                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                    </svg>
                <?php } ?>
                <div class="small">Les champs précédés d'une astérisque <?= $mandatory; ?> sont <span
                            class="text-danger">obligatoires</span>.
                </div>
            </div>
        </div>


        <!-- Formulaire Ajout/Modification d'un utilisateur -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 m-3 p-3 border rounded-3 bg-light">

                <!-- Champs cachés -->
                <?php if ($action === 'edituser') { ?>
                    <!-- Champ de stockage de l'uid de l'utilisateur à modifier -->
                    <input type="hidden" name="uid" value="<?= $userinfos['uid']; ?>">
                <?php } ?>
                <!-- Champ de stockage de l'email encrypté -->
                <input type="hidden" id="cryptedEmail" name="cryptedEmail" value="">
                <!-- Champ de stockage du mot de passe encrypté -->
                <input type="hidden" id="cryptedPw" name="cryptedPw" value="">
                <!-- Champ de stockage de l'action newuser/edituser  -->
                <input type="hidden" id="useraction" name="useraction" value="<?= $action; ?>">
                <!-- Champ de stockage du jeton CSRF -->
                <?= UsersController::insertHiddenToken(); ?>


                <!-- Champ compte actif -->
                <div class="form-group has-validation mb-5 wow fadeIn">
                    <div class="form-check form-switch">
                        <?php
                        $checkedActive = '';
                        $etatCompte = 'Compte d&eacute;sactiv&eacute';
                        if (isset($_POST['active']) && $_POST['active'] == '1') {
                            $checkedActive = ' checked';
                            $etatCompte = 'Compte activ&eacute';
                        } elseif ($action === 'edituser' && $userinfos['active'] === 1) {
                            $checkedActive = ' checked';
                            $etatCompte = 'Compte activ&eacute';
                        }
                        ?>
                        <input class="form-check-input" type="checkbox" role="switch" name="active" value="1"
                               id="active"<?= $checkedActive; ?>>
                        <label class="form-check-label" for="active"><?= $etatCompte; ?></label>
                    </div>
                </div>


                <!-- Champ Rôle -->
                <div class="form-group has-validation mb-5 wow fadeIn">
                    <?php
                    $role = 'user';
                    if (isset($_POST['role'])) {
                        $role = $_POST['role'];
                    } elseif ($action === 'edituser') {
                        $role = $userinfos['role'];
                    }
                    ?>
                    <label class="form-label mb-2 bg-ui">R&ocirc;le <?= $mandatory; ?></label>
                    <div class="form-check mb-1">
                        <?php $checkedRole = $role === 'user' ? ' checked' : ''; ?>
                        <input type="radio" name="role" id="role-user" value="user"
                               class="form-check-input"<?= $checkedRole; ?>>
                        <label for="role-user" class="form-label">Utilisateur</label>
                    </div>
                    <div class="form-check mb-1">
                        <?php $checkedRole = $role === 'admin' ? ' checked' : ''; ?>
                        <input type="radio" name="role" id="role-admin" value="admin"
                               class="form-check-input"<?= $checkedRole; ?>>
                        <label for="role-admin" class="form-label">Administrateur</label>
                    </div>
                </div>


                <!-- Champ Prénom -->
                <div class="form-group has-validation mb-5 wow fadeIn">
                    <?php
                    $firstname = (isset($userinfos) && $action === 'edituser')
                        ? $userinfos['firstname'] : ((isset($_POST['firstname']) && !empty($_POST['firstname']))
                            ? $_POST['firstname'] : '');

                    $firstnameValidationClass = in_array('firstname', $formErrors) ? ' is-invalid' : '';
                    ?>
                    <label for="firstname" class="form-label bg-ui">Prénom <?= $mandatory; ?></label>
                    <input type="text" id="firstname" name="firstname"
                           class="form-control<?= $firstnameValidationClass; ?>" value="<?= $firstname; ?>" required>
                    <div class="invalid-feedback">Veuillez saisir un prénom !</div>
                </div>


                <!-- Champ Nom -->
                <div class="form-group has-validation mb-5 wow fadeIn">
                    <?php
                    $lastname = (isset($userinfos) && $action === 'edituser')
                        ? $userinfos['lastname'] : ((isset($_POST['lastname']) && !empty($_POST['lastname']))
                            ? $_POST['lastname'] : '');
                    $lastnameValidationClass = in_array('lastname', $formErrors) ? ' is-invalid' : '';
                    ?>
                    <label for="lastname" class="form-label bg-ui">Nom <?= $mandatory; ?></label>
                    <input type="text" id="lastname" name="lastname"
                           class="form-control<?= $lastnameValidationClass; ?>" value="<?= $lastname; ?>" required>
                    <div class="invalid-feedback">Veuillez saisir un nom !</div>
                </div>


                <!-- Champ Email -->
                <div class="form-group has-validation mb-5 wow fadeIn">
                    <?php
                    $email = (isset($userinfos) && $action === 'edituser')
                        ? $userinfos['email'] : ((isset($_POST['cryptedEmail']) && !empty($_POST['cryptedEmail']))
                            ? $usersObj->aesDecrypt(base64_decode($_POST['cryptedEmail']), $csrfToken) : '');
                    $emailValidationClass = in_array('email', $formErrors) ? ' is-invalid' : '';
                    ?>
                    <label for="email" class="form-label bg-ui">Adresse email <?= $mandatory; ?></label>
                    <input type="text" id="email" class="form-control<?= $emailValidationClass; ?>"
                           value="<?= $email; ?>" required>
                    <div class="invalid-feedback">Veuillez saisir une adresse mail valide !</div>
                </div>

                <!-- Champ Mot de passe -->
                <div class="form-group has-validation mb-5 wow fadeIn">
                    <?php
                    $password = (isset($userinfos) && $action === 'edituser')
                        ? '' : ((isset($_POST['cryptedPw']) && !empty($_POST['cryptedPw']))
                            ? $usersObj->aesDecrypt(base64_decode($_POST['cryptedPw']), $csrfToken) : '');
                    $passwordValidationClass = in_array('password', $formErrors) ? ' is-invalid' : '';
                    ?>
                    <label for="password" class="form-label bg-ui">Mot de
                        passe <?= $action === 'newuser' ? $mandatory : ''; ?></label>
                    <input type="password" id="password" class="form-control<?= $passwordValidationClass; ?>"
                           value="<?= $password; ?>" autocomplete="new-password" required>
                    <div class="invalid-feedback">Veuillez saisir un mot de passe !</div>
                    <?php if ($action === 'edituser') { ?>
                        <span class="small">Saisissez un mot de passe seulement si vous souhaitez le changer.</span>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="row d-flex justify-content-center wow bounceIn">
            <div class="col-md-6 text-center p-3 bg-ui">
                <div class="form-group mb-3">
                    <a href="<?= UsersController::getRoute('users'); ?>"
                       class="btn btn-secondary float-start">Annuler</a>
                    <?php $actionLabel = $action === 'newuser' ? 'Enregistrer' : 'Mettre à jour'; ?>
                    <button id="actionuser" type="button" class="btn btn-primary text-white float-end">
                        <?= $actionLabel; ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
