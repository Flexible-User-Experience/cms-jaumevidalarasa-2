<?php

namespace App\Manager;

use App\Model\Page;
use Sulu\Component\DocumentManager\DocumentInspector;
use Sulu\Component\DocumentManager\DocumentManager;
use Sulu\Component\DocumentManager\Exception\DocumentManagerException;
use Sulu\Component\DocumentManager\PathBuilder;

class ContentRespositoryManager
{
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
     * @var string
     */
    private $defaultLocale;

    /**
     * @var string
     */
    private $crWorkspace;

    /**
     * Methods
     */

    /**
     * ContentRespositoryManager constructor.
     *
     * @param DocumentManager   $dm
     * @param PathBuilder       $pb
     * @param DocumentInspector $di
     * @param string            $defaultLocale
     * @param string            $crWorkspace
     */
    public function __construct(DocumentManager $dm, PathBuilder $pb, DocumentInspector $di, string $defaultLocale, string $crWorkspace)
    {
        $this->dm = $dm;
        $this->pb = $pb;
        $this->di = $di;
        $this->defaultLocale = $defaultLocale;
        $this->crWorkspace = $crWorkspace;
    }

    public function findPage(string $page)
    {
        try {
            $path = $this->pb->build([
                '%base%',
                $this->crWorkspace,
                '%content%',
                $page,
            ]);
            $node = $this->dm->find($path, $this->defaultLocale);
            $result = new Page($this->di->getNode($node)->getPropertyValue('i18n:'.$this->defaultLocale.'-title'), $this->di->getNode($node)->getPropertyValue('i18n:'.$this->defaultLocale.'-article'));
        } catch (DocumentManagerException $exception) {
            $result = new Page('', '');
        }

        return $result;
    }
}
