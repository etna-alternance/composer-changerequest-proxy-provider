# composer-changerequet-proxy-provider
Permets aux differentes applications d'avoir un proxy vers conversation-api

//todo : git status

## Installation

Modifier `composer.json` :

```
{
    // ...
    "require": {
        "etna/changerequest-proxy-provider": "~1.0.x"
    },
    "repositories": [
       {
           "type": "composer",
           "url": "http://blu-composer.herokuapp.com"
       }
   ]
}
```

## Utilisation

### Déclarer le composant

Le composant `etna/config-provider` met à disposition une classe permettant de faire utiliser ce proxy a notre application.

Lors de la configuration de l'application il faut donc utiliser la classe `ETNA\Silex\Provider\Config\ChangeRequestProxy` :

```
use ETNA\Silex\Provider\Config as ETNAConf;

class EtnaConfig implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        ...

        //L'utilisation du controlleur custom est expliquée plus bas
        $my_controller = new ConversationController();
        $app->register(new ETNAConf\ConversationProxy($my_controller));

        ...
    }
}
```

### Le contenu de ce composant

##### Le controlleur custom

Ce provider met a disposition un `DumbMethodsProxy` qui fournit toutes les routes basiques de changerequest :
-

Il est possible de creer un controlleur qui hérite de ce `DumbMethodsProxy` pour rajouter des routes custom :
```
class ConversationController extends DumbMethodsrsProxy
{
    public function connect(Application $app)
    {
        //Si il y'a besoin des routes basiques
        $controllers = parent::connect($app);
        //Sinon
        $controllers = $app["controllers_factory"];

        $controllers->get("/contract/{contract_id}/conversation", [$this, 'getConversation']);
        $controllers->post("/contract/{contract_id}/conversation", [$this, 'createConversation']);
    }

    public function getConversation(Application $app, $contract_id)
    {
        $conversation = $app["conversations"]->findOneByQueryString("+contract_id:{$contract_id} +app-name:gsa");

        return $app->json($conversation->toArray(), 200);
    }

    public function createConversation(Application $app, $contract_id)
    {
        $conversation = new Conversation();

        $conversation->setTitle("GSA - Contract {$contract_id}");

        $response = $app["conversations"]->save($conversation);

        return $app->json($response, 201);
    }
}
```

##### Les plus de ce proxy

Ce provider met a disposition :
- L'objet ChangeTodos, qui est une "entité" qui se comporte comme une entité doctrine le ferait
 - On peut la remplir avec un array grace a `$change_todos->fromArray($array)`
 - On peut la serializer en array grace a `$change_todos->toArray()`
- L'objet ChangeRequestManager ($app["changerequest"]) qui lui se comporte comme l'entity manager de doctrine, sauf qu'il permet aussi de recuperer des conversations. Il met a disposition les methodes :
 - `findByQueryString` qui prends en parametre une query string ElasticSearch (+contract_id:42 +app-name:gsa) et qui retourne un tableau de ChangeTodos
 - `findOneByQueryString` qui prends aussi en parametre une query string mais retourne l'objet le plus pertinent
 - `save` qui prend en paramètre un ChangeTodos et effectue les requetes necessaires pour sauvegarder les changements