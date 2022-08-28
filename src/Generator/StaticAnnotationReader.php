<?php

namespace App\Generator;

use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class StaticAnnotationReader implements Reader
{
    private string $containersNamespace;

    public function __construct(string $containerNamespace)
    {
        $this->containersNamespace = $containerNamespace;
    }

    public function getClassAnnotations(ReflectionClass $class)
    {
        return $this->getFromStaticClass($class->getName(), 'class');
    }

    public function getClassAnnotation(ReflectionClass $class, $annotationName)
    {
        $annotations = $this->getFromStaticClass($class->getName(), 'class');
        return array_key_exists($annotationName, $annotations) ? $annotations[$annotationName] : null;
    }

    public function getMethodAnnotations(ReflectionMethod $method)
    {
        $annotations = $this->getFromStaticClass($method->class, 'method');
        return array_key_exists($method->getName(), $annotations) ? $annotations[$method->getName()] : [];
    }

    public function getMethodAnnotation(ReflectionMethod $method, $annotationName)
    {
        $annotations = $this->getFromStaticClass($method->class, 'class');
        if (!array_key_exists($method->getName(), $annotations)) {
            return null;
        }

        return array_key_exists($annotationName, $annotations[$method->getName()])
            ? $annotations[$method->getName()][$annotationName]
            : null;
    }

    public function getPropertyAnnotations(ReflectionProperty $property)
    {
        $annotations = $this->getFromStaticClass($property->class, 'property');
        return array_key_exists($property->getName(), $annotations) ? $annotations[$property->getName()] : [];
    }

    public function getPropertyAnnotation(ReflectionProperty $property, $annotationName)
    {
        $annotations = $this->getFromStaticClass($property->class, 'property');
        if (!array_key_exists($property->getName(), $annotations)) {
            return null;
        }

        return array_key_exists($annotationName, $annotations[$property->getName()])
            ? $annotations[$property->getName()][$annotationName]
            : null;
    }

    private function getFromStaticClass(string $className, string $type): ?array
    {
        $staticClass = $this->getGeneratedClass($className);
        return $staticClass::getAnnotations()[$type];
    }

    private function getGeneratedClass(string $className): string
    {
        return $this->containersNamespace . '\\' . AnnotationGenerator::getAnnotationContainerClass($className);
    }
}
