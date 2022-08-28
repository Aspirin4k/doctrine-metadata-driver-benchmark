<?php

namespace App\Generator;

use Doctrine\Common\Annotations\Reader;

class AnnotationGenerator
{
    public const NAMESPACE = 'Annotation';

    private Reader $annotationReader;
    private string $namespace;

    public function __construct(Reader $reader, string $namespace)
    {
        $this->annotationReader = $reader;
        $this->namespace = $namespace;
    }

    public static function getAnnotationContainerClass(string $className): string
    {
        return str_replace('\\', '', $className) . 'AnnotationContainer';
    }

    public function generate(\ReflectionClass $initialClass): string
    {
        $class = self::getAnnotationContainerClass($initialClass->getName());
        $body = $this->generateBody($initialClass);

        return <<<PHP
<?php declare(strict_types=1);

namespace {$this->namespace};

class {$class}
{
    private static array \$annotations = [];

    public static function getAnnotations(): array
    {
        if (empty(self::\$annotations)) {
{$body}
        }

        return self::\$annotations;
    }
}

PHP;
    }

    private function generateBody(\ReflectionClass $initialClass): string
    {
        $code = StringOperations::withTabs("self::\$annotations['class'] = [];\n", 3);
        foreach ($this->annotationReader->getClassAnnotations($initialClass) as $annotation) {
            $annotationClass = get_class($annotation);
            $code .= $this->getAnnotationValue($annotation, "self::\$annotations['class'][\\{$annotationClass}::class]");
        }

        $code .= StringOperations::withTabs("self::\$annotations['method'] = [];\n", 3);
        foreach ($initialClass->getMethods() as $reflectionMethod) {
            $code .= StringOperations::withTabs("self::\$annotations['method']['{$reflectionMethod->getName()}'] = [];\n", 3);

            foreach ($this->annotationReader->getMethodAnnotations($reflectionMethod) as $annotation) {
                $annotationClass = get_class($annotation);
                $code .= $this->getAnnotationValue(
                    $annotation,
                    "self::\$annotations['method']['{$reflectionMethod->getName()}'][\\{$annotationClass}::class]"
                );
            }
        }

        $code .= StringOperations::withTabs("self::\$annotations['property'] = [];\n", 3);
        foreach ($initialClass->getProperties() as $reflectionProperty) {
            $code .= StringOperations::withTabs("self::\$annotations['property']['{$reflectionProperty->getName()}'] = [];\n", 3);

            foreach ($this->annotationReader->getPropertyAnnotations($reflectionProperty) as $annotation) {
                $annotationClass = get_class($annotation);
                $code .= $this->getAnnotationValue(
                    $annotation,
                    "self::\$annotations['property']['{$reflectionProperty->getName()}'][\\{$annotationClass}::class]"
                );
            }
        }

        return $code;
    }

    private function getAnnotationValue($value, string $paramName): string
    {
        if (\is_array($value)) {
            return $this->getAnnotationArrayValue($value, $paramName);
        }

        if (\is_object($value)) {
            return $this->getAnnotationObjectValue($value, $paramName);
        }

        return $this->getAnnotationBasicValue($value, $paramName);
    }

    private function getAnnotationArrayValue(array $value, string $paramName): string
    {
        $code = StringOperations::withTabs("{$paramName} = [];\n", 3);
        foreach ($value as $key => $element) {
            $childParamName = '$element' . mt_rand();
            $code .= $this->getAnnotationValue($element, $childParamName);
            $key = $this->encodeBasicValue($key);
            $code .= StringOperations::withTabs("{$paramName}[{$key}] = {$childParamName};\n", 3);
        }

        return $code;
    }

    private function getAnnotationObjectValue($value, string $paramName): string
    {
        $className = get_class($value);
        $classReflection = new \ReflectionClass($className);
        $reflectionParamName = lcfirst($classReflection->getShortName());
        $code = "\n";
        $code .= StringOperations::withTabs("\${$reflectionParamName} = new \\ReflectionClass(\\{$className}::class);\n", 3);
        $code .= StringOperations::withTabs("{$paramName} = \${$reflectionParamName}->newInstanceWithoutConstructor();\n", 3);
        foreach ($classReflection->getProperties() as $reflectionProperty) {
            if (!$reflectionProperty->isPublic()) {
                continue;
            }

            $childValue = $reflectionProperty->getValue($value);
            if (!\is_object($childValue) && !\is_array($childValue) || \is_array($childValue) && empty($childValue)) {
                $code .= \is_array($childValue)
                    ? $this->getAnnotationArrayValue($childValue, "{$paramName}->{$reflectionProperty->getName()}")
                    : $this->getAnnotationBasicValue($childValue, "{$paramName}->{$reflectionProperty->getName()}");
            } else {
                $childParamName = '$' . lcfirst($classReflection->getShortName()) . '_' . $reflectionProperty->getName() . mt_rand();
                $code .= $this->getAnnotationValue($childValue, $childParamName);
                $code .= StringOperations::withTabs("{$paramName}->{$reflectionProperty->getName()} = {$childParamName};\n", 3);
            }
        }

        return $code;
    }

    private function getAnnotationBasicValue($value, string $paramName): string
    {
        $value = $this->encodeBasicValue($value);
        return StringOperations::withTabs("{$paramName} = {$value};\n", 3);
    }

    private function encodeBasicValue($value): string
    {
        return match (true) {
            null === $value => 'null',
            \is_string($value) => "'{$value}'",
            \is_bool($value) => false === $value ? 'false' : 'true',
            default => (string)$value,
        };
    }
}
