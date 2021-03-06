<?php declare(strict_types=1);

namespace Symplify\MonorepoBuilder\ComposerJsonDecorator;

use Composer\Json\JsonManipulator;
use Symplify\MonorepoBuilder\Composer\Section;
use Symplify\MonorepoBuilder\Contract\ComposerJsonDecoratorInterface;
use Symplify\PackageBuilder\Reflection\PrivatesCaller;

final class SortRequireComposerJsonDecorator implements ComposerJsonDecoratorInterface
{
    /**
     * @param mixed[] $composerJson
     * @return mixed[]
     */
    public function decorate(array $composerJson): array
    {
        // no name of monorepo package => nothing to remove
        if (! isset($composerJson['config']['sort-packages'])) {
            return $composerJson;
        }

        foreach ($composerJson as $key => $values) {
            if (! in_array($key, [Section::REQUIRE, Section::REQUIRE_DEV], true)) {
                continue;
            }

            $composerJson[$key] = $this->sortPackages($composerJson[$key]);
        }

        return $composerJson;
    }

    /**
     * @param string[] $packages
     * @return string[]
     */
    private function sortPackages(array $packages): array
    {
        return (new PrivatesCaller())->callPrivateMethodWithReference(
            JsonManipulator::class,
            'sortPackages',
            $packages
        );
    }
}
