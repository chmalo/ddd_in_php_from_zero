<?php

declare(strict_types=1);


namespace MN\Ddd\Courses\Infrastructure;


use MN\Ddd\Courses\Domain\Course;
use MN\Ddd\Courses\Domain\CourseRepository;

final class FileCourseRepository implements CourseRepository
{
    private const FILE_PATH = __DIR__ . '/courses';

    public function save(Course $course): void
    {
        file_put_contents($this->fileName($course->id()), serialize($course));
    }

    public function search(string $id): ?Course
    {
        return file_exists($this->fileName($id))
            ? unserialize(file_get_contents($this->fileName($id)))
            : null;
    }

    private function fileName(string $id): string
    {
        return sprintf('%s.%s.repo', self::FILE_PATH, $id);
    }
}