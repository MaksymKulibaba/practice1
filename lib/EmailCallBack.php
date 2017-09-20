<?php
/**
 * Created by PhpStorm.
 * User: Kulibacks
 * Date: 15.09.2017
 * Time: 20:08
 */

require_once 'CallbackForm.php';
require_once 'Connection.php';

class EmailCallBack extends CallbackForm
{
    public $email;
    public $file;

    const SIZE = 1024 * 1024 * 5;
    const UPLOAD_DIR = 'files/'; //менять название папки и путь

    public function __construct(string $name, string $phone, string $email, $file)
    {
        parent::__construct($name, $phone);
        $this->email = $email;
        $this->file = $file;

        if (!file_exists(self::UPLOAD_DIR)) {
            mkdir(self::UPLOAD_DIR, 0777);
        }

    }

    public function validate(): bool
    {
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        if ((parent::validate()) && ((empty($this->email)) || (filter_var($this->email, FILTER_VALIDATE_EMAIL)))) {
            if (($fileSize < self::SIZE) && ($fileType == 'application/pdf')) {
                return true;
            }
        }
        return false;
    }

    public function send()
    {
        parent::send();
        echo "</br>" . 'Email: ' . $this->email . "</br>";
        echo 'File added, file size: ' . $_FILES['file']['size'] . ' Byte';

        move_uploaded_file($_FILES['file']['tmp_name'], self::UPLOAD_DIR . $this->file);

    }
}
