<?php

declare(strict_types=1);

use App\Generator\AnnotationGenerator;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\DocParser;

require_once __DIR__ . '/../../vendor/autoload.php';

$namespace = 'App\Generator\Annotation';
$annotationDirectory = __DIR__ . '/../../' . str_replace('App', 'src', str_replace('\\', '/', $namespace));

if (!file_exists($annotationDirectory)) {
    mkdir($annotationDirectory, 0777, true);
}

$annotationGenerator = new AnnotationGenerator(
    new AnnotationReader(new DocParser()),
    $namespace
);

$files = glob(__DIR__ . '/../Annotation/Entity/*.php');
$entityAnnotationsContainers = array_map(
    static fn ($file) => 'App\\Annotation\\Entity\\' . basename($file, '.php'),
    $files
);

echo "===================================================================\n";
echo 'Generating annotation containers for ' . count($entityAnnotationsContainers) . " entities\n";
foreach ($entityAnnotationsContainers as $entity) {
    echo 'Start ' . $entity . "\n";

    $reflection = new ReflectionClass($entity);
    $code = $annotationGenerator->generate($reflection);
    file_put_contents(
        $annotationDirectory . '/' . AnnotationGenerator::getAnnotationContainerClass($entity) . '.php',
        $code
    );

    echo 'Done ' . $entity . "\n";
}
