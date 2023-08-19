<?php
const DB_NAME = 'task';
const DB_USER = 'root';
const DB_PASSWORD = 'admin123';
const DB_HOST = 'localhost';

const ROOT_PATH = 'task';
const url = 'http://127.0.0.1';

const UPLOAD_PATH = DIRECTORY_SEPARATOR. __dir__ . '/uploads';
const BOOTSTRAP_PATH = DIRECTORY_SEPARATOR. ROOT_PATH.'/source/bootstrap-5.3.1-dist/';
const CSS_PATH = DIRECTORY_SEPARATOR.ROOT_PATH.'/source/css/';
const JS_PATH = DIRECTORY_SEPARATOR.ROOT_PATH.'/source/js/';

function Redirect($url): void
{
    session_start();

    header('Location: ' . url.'/'.$url, true,  301);
    exit();
}

// connect to DB
function db_connect()
{
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    return $mysqli;
}