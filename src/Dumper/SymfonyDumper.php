<?php

namespace Creads\Api2Symfony\Dumper;

use Symfony\Component\Filesystem\Filesystem;
use Creads\Api2Symfony\SymfonyController;
use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Dump a symfony controller
 *
 * @author Quentin <q.pautrat@creads.org>
 * @author Damien Pitard <d.pitard@creads.org>
 */
class SymfonyDumper implements DumperInterface
{
    /**
     * Twig
     *
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * Filesystem
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Initialize dumper.
     * We don't use injection because we don't want the engine to be overriden
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../Resources/templates/symfony');
        $this->twig = new Twig_Environment($loader);

        $this->filesystem = new Filesystem();
    }

    protected function getFilepath(SymfonyController $controller, $destination)
    {
        return $destination . '/' .$controller->getName() . '.php';
    }

    /**
     * {@inheritDoc}
     */
    public function exists(SymfonyController $controller, $destination = '.')
    {
        $filepath = $this->getFilepath($controller, $destination);

        return $this->filesystem->exists($filepath);
    }

    /**
     * {@inheritDoc}
     */
    public function dump(SymfonyController $controller, $destination = '.')
    {

        $template = $this->twig->loadTemplate('controller.php.twig');

        if (!$template) {
            throw new \Exception('Unable to find template');
        }

        $output = $template->render(array(
            'controller' => $controller
        ));

        if (!$this->filesystem->exists($destination)) {
            throw new \InvalidArgumentException(sprintf('Folder %s does not exist', $destination));
        }

        $filepath = $this->getFilepath($controller, $destination);

        if ($this->filesystem->exists($filepath)) {

            $old = $filepath . '.old';
            $i = 1;
            while ($this->filesystem->exists($old)) {
                $i++;
                $old = $filepath . '.old~' .$i;
            }

            $this->filesystem->copy($filepath, $old);
        }

        $this->filesystem->dumpFile($filepath, $output);

        return $filepath;
    }
}