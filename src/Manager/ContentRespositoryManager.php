<?php

namespace App\Manager;

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
     * Methods
     */

    /**
     * ContentRespositoryManager constructor.
     *
     * @param DocumentManager $dm
     * @param PathBuilder     $pb
     */
    public function __construct(DocumentManager $dm, PathBuilder $pb)
    {
        $this->dm = $dm;
        $this->pb = $pb;
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
            $result = $this->dm->find($path, self::DEFAULT_SEARCH_LOCALE);
        } catch (DocumentManagerException $exception) {
            $result = [];
        }

        return $result;
    }
}
