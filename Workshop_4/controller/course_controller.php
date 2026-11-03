<?php

require_once __DIR__ . '/../utils/auth.php';
require_once __DIR__ . '/../models/course.php';

requireLogin();

$courses = getAllCourses();

require_once __DIR__ . '/../views/course_view.php';