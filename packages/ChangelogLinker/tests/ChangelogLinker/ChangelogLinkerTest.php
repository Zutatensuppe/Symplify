<?php declare(strict_types=1);

namespace Symplify\ChangelogLinker\Tests\ChangelogLinker;

use Iterator;
use Symplify\ChangelogLinker\ChangelogLinker;
use Symplify\ChangelogLinker\DependencyInjection\ContainerFactory;
use Symplify\ChangelogLinker\Tests\AbstractContainerAwareTestCase;

/**
 * @covers \Symplify\ChangelogLinker\ChangelogLinker
 * @covers \Symplify\ChangelogLinker\Worker\UserReferencesWorker
 * @covers \Symplify\ChangelogLinker\Worker\LinkifyWorker
 * @covers \Symplify\ChangelogLinker\Worker\LinksToReferencesWorker
 * @covers \Symplify\ChangelogLinker\Worker\DiffLinksToVersionsWorker
 * @covers \Symplify\ChangelogLinker\Worker\BracketsAroundReferencesWorker
 */
final class ChangelogLinkerTest extends AbstractContainerAwareTestCase
{
    /**
     * @var ChangelogLinker
     */
    private $changelogLinker;

    protected function setUp(): void
    {
        $container = (new ContainerFactory())->createWithConfig(__DIR__ . '/Source/config.yml');
        $this->changelogLinker = $container->get(ChangelogLinker::class);
    }

    /**
     * @dataProvider dataProvider()
     */
    public function test(string $originalFile, string $expectedFile): void
    {
        $processedFile = $this->changelogLinker->processContentWithLinkAppends(file_get_contents($originalFile));

        $this->assertStringEqualsFile($expectedFile, $processedFile);
    }

    public function dataProvider(): Iterator
    {
        yield [__DIR__ . '/Source/before/01.md', __DIR__ . '/Source/after/01.md'];
        yield [__DIR__ . '/Source/before/02.md', __DIR__ . '/Source/after/02.md'];
        yield [__DIR__ . '/Source/before/03.md', __DIR__ . '/Source/after/03.md'];
        yield [__DIR__ . '/Source/before/04.md', __DIR__ . '/Source/after/04.md'];
        yield [__DIR__ . '/Source/before/05.md', __DIR__ . '/Source/after/05.md'];
        yield [__DIR__ . '/Source/before/06.md', __DIR__ . '/Source/after/06.md'];
        yield [__DIR__ . '/Source/before/07.md', __DIR__ . '/Source/after/07.md'];
        yield [__DIR__ . '/Source/before/08.md', __DIR__ . '/Source/after/08.md'];
        yield [__DIR__ . '/Source/before/09.md', __DIR__ . '/Source/after/09.md'];
        yield [__DIR__ . '/Source/before/10.md', __DIR__ . '/Source/after/10.md'];
    }
}
