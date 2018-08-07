<?php declare(strict_types=1);

namespace Symplify\CodingStandard\Tests\Fixer\Yaml\YamlIndentFixer;

use Iterator;
use Symplify\EasyCodingStandardTester\Testing\AbstractCheckerTestCase;

/**
 * @see \Symplify\CodingStandard\Fixer\Yaml\YamlIndentFixer
 */
final class YamlIndentFixerTest extends AbstractCheckerTestCase
{
    /**
     * @dataProvider provideWrongToFixedCases()
     */
    public function testFix(string $wrongFile, string $fixedFile): void
    {
        $this->doTestWrongToFixedFile($wrongFile, $fixedFile);
    }

    public function provideWrongToFixedCases(): Iterator
    {
        yield [__DIR__ . '/wrong/wrong.yml', __DIR__ . '/fixed/fixed.yml'];
    }

    protected function provideConfig(): string
    {
        return __DIR__ . '/config.yml';
    }
}
