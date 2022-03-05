<?php

declare(strict_types=1);

namespace App\Swagger;

use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;

final class SwaggerDecorator implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    // public function supportsNormalization($data, $format = null): bool
    // {
    //     return $this->decorated->supportsNormalization($data, $format);
    // }

    public function __invoke(array $context = []): OpenApi
    // public function normalize($object, $format = null, array $context = [])
    {
        // $docs = $this->decorated->normalize($object, $format, $context);

        // $docs['components']['schemas']['Token'] = [
        //     'type' => 'object',
        //     'properties' => [
        //         'token' => [
        //             'type' => 'string',
        //             'readOnly' => true,
        //         ],
        //     ],
        // ];

        // $docs['components']['schemas']['Credentials'] = [
        //     'type' => 'object',
        //     'properties' => [
        //         'username' => [
        //             'type' => 'string',
        //             'example' => 'api@dentiio.fr',
        //         ],
        //         'password' => [
        //             'type' => 'string',
        //             'example' => 'password',
        //         ],
        //     ],
        // ];

        // $tokenDocumentation = [
        //     'paths' => [
        //         '/api/login_check' => [
        //             'post' => [
        //                 'tags' => ['Token'],
        //                 'operationId' => 'postCredentialsItem',
        //                 'summary' => 'Get JWT token to login.',
        //                 'requestBody' => [
        //                     'description' => 'Create new JWT Token',
        //                     'content' => [
        //                         'application/json' => [
        //                             'schema' => [
        //                                 '$ref' => '#/components/schemas/Credentials',
        //                             ],
        //                         ],
        //                     ],
        //                 ],
        //                 'responses' => [
        //                     Response::HTTP_OK => [
        //                         'description' => 'Get JWT token',
        //                         'content' => [
        //                             'application/json' => [
        //                                 'schema' => [
        //                                     '$ref' => '#/components/schemas/Token',
        //                                 ],
        //                             ],
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // return array_merge_recursive($docs, $tokenDocumentation);
        $openApi = $this->decorated->__invoke($context);
        $pathItem = $openApi->getPaths()->getPath('/api/login_check');
        $operation = $pathItem->getGet();

        $openApi->getPaths()->addPath('/api/login_check', $pathItem->withGet(
            $operation->withParameters(array_merge(
                $operation->getParameters(),
                [new Model\Parameter('fields', 'query', 'Fields to remove of the output')]
            ))
        ));

        // $openApi = $openApi->withInfo((new Model\Info('New Title', 'v2', 'Description of my custom API'))->withExtensionProperty('info-key', 'Info value'));
        // $openApi = $openApi->withExtensionProperty('key', 'Custom x-key value');
        // $openApi = $openApi->withExtensionProperty('x-value', 'Custom x-value value');

        return $openApi;
    }
}