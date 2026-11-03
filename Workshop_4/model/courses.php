<?php

require_once __DIR__ . '/../utils/database.php';

function getAllCourses()
{
    global $conn;

    try {
        $stmt = $conn->prepare(
            'SELECT id, name, course_code, career_id, credits, description
             FROM Courses
             ORDER BY id DESC'
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Courses error: ' . $exception->getMessage());
        return [];
    }
}