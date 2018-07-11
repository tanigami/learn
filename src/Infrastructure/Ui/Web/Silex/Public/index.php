<?php

use Shippinno\Learn\Application\Query\AllCoursesQuery;
use Shippinno\Learn\Application\Query\OneCourseQuery;
use Shippinno\Learn\Application\Query\SessionsOfCourseQuery;
use Shippinno\Learn\Application\Service\AddSessionToCourseRequest;
use Shippinno\Learn\Application\Service\CreateCourseRequest;
use Shippinno\Learn\Infrastructure\Ui\Web\Silex\Application;
use Symfony\Component\Debug\Debug;
use Tanigami\ValueObjects\Time\TimeRange;

require_once __DIR__ . '/../../../../../../vendor/autoload.php';

Debug::enable();

$app = Application::bootstrap();

$app->get('/', function () use ($app) {
    $courses = $app['query_bus']->handle(new AllCoursesQuery);

    return $app['twig']->render('home.html.twig', compact('courses'));
});

$app->get('/create', function () use ($app) {
    $app['create_course_service']->execute(new CreateCourseRequest('コース'));
    $app['em']->flush();
});

$app->get('/add', function () use ($app) {
    $app['add_session_to_course_service']->execute(
        new AddSessionToCourseRequest(
            '7739adca-c600-4f56-9edb-76f9f6549bcc',
            'session '.time(),
            new TimeRange(
                new DateTimeImmutable,
                new DateTimeImmutable('tomorrow')
            )
        )
    );
    $app['em']->flush();
});

$app->get('/courses/{courseId}/sessions', function ($courseId) use ($app) {
    $course = $app['query_bus']->handle(new OneCourseQuery($courseId));
    $sessions = $app['query_bus']->handle(new SessionsOfCourseQuery($courseId));

    return $app['twig']->render('sessions.html.twig', compact('course', 'sessions'));
});

$app->run();