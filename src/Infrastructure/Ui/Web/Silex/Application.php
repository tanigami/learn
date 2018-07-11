<?php

namespace Shippinno\Learn\Infrastructure\Ui\Web\Silex;

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Shippinno\Learn\Application\DataTransformer\CourseDtoDataTransformer;
use Shippinno\Learn\Application\DataTransformer\SessionDtoDataTransformer;
use Shippinno\Learn\Application\Query\AllCoursesQueryHandler;
use Shippinno\Learn\Application\Query\OneCourseQueryHandler;
use Shippinno\Learn\Application\Query\QueryBus;
use Shippinno\Learn\Application\Query\SessionsOfCourseQuery;
use Shippinno\Learn\Application\Query\SessionsOfCourseQueryHandler;
use Shippinno\Learn\Application\Service\AddSessionToCourseService;
use Shippinno\Learn\Application\Service\CreateCourseService;
use Shippinno\Learn\Domain\Model\Course\Course;
use Shippinno\Learn\Domain\Model\Course\Session;
use Shippinno\Learn\Infrastructure\Persistence\Doctrine\EntityManagerFactory;

class Application
{
    public static function bootstrap(): Silex
    {
        $app = new Application;

        $app['debug'] = true;

        $app->register(new DoctrineServiceProvider, [
            'db.options' => [
                'driver' => 'pdo_mysql',
                'dbname' => 'learn',
                'host' => 'mariadb',
                'user' => 'root',
                'password' => 'root',
//                'path' => __DIR__ . '/../../../../../sqlite.db',
            ],
        ]);

        $app->register(new DoctrineOrmServiceProvider, array(
            'orm.em.options' => [
                'mappings' => [
                    [
                        'type' => 'xml',
                        'namespace' => '',
                        'path' => __DIR__ . '/../../../Persistence/Doctrine/Mapping',
                    ]
                ]
            ]
        ));

        $app['em'] = function (Silex $app) {
            return (new EntityManagerFactory)->build($app['db']);
        };

//        $app['user_repository'] = $app->share(function ($app) {
//            return $app['em']->getRepository('Lw\Application\Model\User\User');
//        });

        $app->register(
            new TwigServiceProvider,
            ['twig.path' => __DIR__.'/../../Views/Twig']
        );

        $app['course_repository'] = function ($app) {
            return $app['em']->getRepository(Course::class);
        };

        $app['session_repository'] = function ($app) {
            return $app['em']->getRepository(Session::class);
        };

        $app['create_course_service'] = function ($app) {
            return new CreateCourseService(
                $app['course_repository']
            );
        };

        $app['add_session_to_course_service'] = function ($app) {
            return new AddSessionToCourseService(
                $app['course_repository'],
                $app['session_repository']
            );
        };

        $app['query_bus'] = function($app) {
            $queryBus = new QueryBus;
            $queryBus->register(new AllCoursesQueryHandler($app['course_repository'], new CourseDtoDataTransformer));
            $queryBus->register(new OneCourseQueryHandler($app['course_repository'], new CourseDtoDataTransformer));
            $queryBus->register(new SessionsOfCourseQueryHandler($app['session_repository'], new SessionDtoDataTransformer, $app['em']));

            return $queryBus;
        };

        return $app;
    }
}