<?php

class InvalidParametersException extends Exception {
    public function __construct($message = "Invalid parameters.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class FileUploadException extends Exception {
    public function __construct($message = "File upload error.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class FileSizeException extends Exception {
    public function __construct($message = "File size too large.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class FileTypeException extends Exception {
    public function __construct($message = "File type not allowed.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class FileUploadSuccessException extends Exception {
    public function __construct($message = "File upload success.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class UnknownErrorException extends Exception {
    public function __construct($message = "Unknown error.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
