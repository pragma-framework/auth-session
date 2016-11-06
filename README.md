# Pragma AuthSession

## Pré-requis

Le package utilise les méthodes PHP `password_hash` et `password_verify` qui requièrent php5.5 au minimum.

## Configuration

### config.php
Dans le config.php, vous avez une constante requise pour le bon fonctionnement du package : `AUTH_USER_MODEL`.

Cette constante définit le nom du modèle qui représente les utilisateurs dans votre application.

__Ex :__

```
define('get_signed_user', 'App\\Models\\User');
```

Vous avez également la possibilité de définir le coût pour la génération du hash lié au password des utilisateurs. Par défaut, le système prévoit un coût de 10. Vous avez cependant la possibilité de le surcharger :

```
define('AUTH_CRYPTO_COST', 13);
```

### session_start()

Ne pas oublier de démarrer la session dans le public/index.php si vous utilisez ce package.

## Fonctions proposées

### AuthSession::hashgen($pwd)

Cette méthode permet d'obtenir un hash correspondant au `$pwd` passé en clair.

### AuthSession::check_password($pwd, $hash)

Cette méthode permet de comparer un mot de passe passé en clair (`$pwd`) au `$hash` d'un utilisateur.

retourne true si le mot de passe correspond au hash, false sinon.

### AuthSession::register_session($u)

Stocke les informations de l'utilisateur connecté en session.

### AuthSession::signed_in()

Retourne true si l'utilisateur est connecté, false sinon.

### AuthSession::get_signed_user()

Retourne l'objet correspondant à l'utilisateur connecté.

### AuthSession::destroy_session()

Permet la destruction des infos de l'utilisateur dans la session. L'utilisateur sera déconnecté.
