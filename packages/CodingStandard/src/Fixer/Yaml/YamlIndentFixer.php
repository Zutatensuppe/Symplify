<?php declare(strict_types=1);

namespace Symplify\CodingStandard\Fixer\Yaml;

use Nette\Utils\FileSystem;
use Nette\Utils\Strings;
use PhpCsFixer\AbstractFixer;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;
use PHPStan\Type\StringType;
use SplFileInfo;

final class YamlIndentFixer extends AbstractFixer
{
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'Indent YAML files by 4 spaces',
            [
                new CodeSample(
<<<'CODE_SAMPLE'
key:
  sub_key: value
CODE_SAMPLE
                )
            ]
        );
    }

    public function supports(SplFileInfo $file): bool
    {
        return (bool) Strings::match($file->getBasename(), '#\.(yml|yaml)$#');
    }

    protected function applyFix(SplFileInfo $file, Tokens $tokens)
    {
        $fileContent = FileSystem::read($file->getPathname());

        $newContent = Strings::replace($fileContent, '#^ {2}#m', '    ');
        $tokens->setCode($newContent);
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return true;
    }
}