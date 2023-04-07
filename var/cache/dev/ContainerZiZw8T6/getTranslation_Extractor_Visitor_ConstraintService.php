<?php

namespace ContainerZiZw8T6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTranslation_Extractor_Visitor_ConstraintService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'translation.extractor.visitor.constraint' shared service.
     *
     * @return \Symfony\Component\Translation\Extractor\Visitor\ConstraintVisitor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Extractor/Visitor/AbstractVisitor.php';
        include_once \dirname(__DIR__, 4).'/vendor/nikic/php-parser/lib/PhpParser/NodeVisitor.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Extractor/Visitor/ConstraintVisitor.php';

        return $container->privates['translation.extractor.visitor.constraint'] = new \Symfony\Component\Translation\Extractor\Visitor\ConstraintVisitor([0 => 'All', 1 => 'AtLeastOneOf', 2 => 'Bic', 3 => 'Blank', 4 => 'Callback', 5 => 'CardScheme', 6 => 'Choice', 7 => 'Cidr', 8 => 'Collection', 9 => 'Compound', 10 => 'Count', 11 => 'Country', 12 => 'CssColor', 13 => 'Currency', 14 => 'DateTime', 15 => 'Date', 16 => 'DivisibleBy', 17 => 'Email', 18 => 'EqualTo', 19 => 'ExpressionSyntax', 20 => 'Expression', 21 => 'File', 22 => 'GreaterThanOrEqual', 23 => 'GreaterThan', 24 => 'Hostname', 25 => 'Iban', 26 => 'IdenticalTo', 27 => 'Image', 28 => 'Ip', 29 => 'IsFalse', 30 => 'IsNull', 31 => 'IsTrue', 32 => 'Isbn', 33 => 'Isin', 34 => 'Issn', 35 => 'Json', 36 => 'Language', 37 => 'Length', 38 => 'LessThanOrEqual', 39 => 'LessThan', 40 => 'Locale', 41 => 'Luhn', 42 => 'NotBlank', 43 => 'NotCompromisedPassword', 44 => 'NotEqualTo', 45 => 'NotIdenticalTo', 46 => 'NotNull', 47 => 'Range', 48 => 'Regex', 49 => 'Sequentially', 50 => 'Time', 51 => 'Timezone', 52 => 'Type', 53 => 'Ulid', 54 => 'Unique', 55 => 'Url', 56 => 'Uuid', 57 => 'Valid', 58 => 'When', 59 => 'Expression', 60 => 'Email', 61 => 'NotCompromisedPassword', 62 => 'When', 63 => 'UniqueEntity', 64 => 'UserPassword']);
    }
}
