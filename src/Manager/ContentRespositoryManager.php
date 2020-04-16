<?php

namespace App\Manager;

use App\Model\Page;
use Sulu\Component\DocumentManager\DocumentInspector;
use Sulu\Component\DocumentManager\DocumentManager;
use Sulu\Component\DocumentManager\Exception\DocumentManagerException;
use Sulu\Component\DocumentManager\PathBuilder;

class ContentRespositoryManager
{
    const DEFAULT_WORKSPACE = 'cms-jaumevidalarasa-2';
    const DEFAULT_SEARCH_LOCALE = 'es';

    /**
     * @var DocumentManager
     */
    private $dm;

    /**
     * @var PathBuilder
     */
    private $pb;

    /**
     * @var DocumentInspector
     */
    private $di;

    /**
     * Methods
     */

    /**
     * ContentRespositoryManager constructor.
     *
     * @param DocumentManager   $dm
     * @param PathBuilder       $pb
     * @param DocumentInspector $di
     */
    public function __construct(DocumentManager $dm, PathBuilder $pb, DocumentInspector $di)
    {
        $this->dm = $dm;
        $this->pb = $pb;
        $this->di = $di;
    }

    public function findPage(string $page)
    {
        try {
            $path = $this->pb->build([
                '%base%',
                self::DEFAULT_WORKSPACE,
                '%content%',
                $page,
            ]);
            $node = $this->dm->find($path, self::DEFAULT_SEARCH_LOCALE);
            $result = new Page($this->di->getNode($node)->getPropertyValue('i18n:'.self::DEFAULT_SEARCH_LOCALE.'-title'), $this->di->getNode($node)->getPropertyValue('i18n:'.self::DEFAULT_SEARCH_LOCALE.'-article'));
        } catch (DocumentManagerException $exception) {
            $result = new Page('', '');
        }

        return $result;
    }
}
