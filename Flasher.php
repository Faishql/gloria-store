<?php

class Flasher
{
    public static function setFlash($pesan, $aksi, $class)
    {
        $_SESSION["flasher"] = [
            "pesan" => $pesan,
            "aksi" => $aksi,
            "class" => $class,
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION["flasher"])) {
            echo '
            <div class="alert alert-' .
                $_SESSION["flasher"]["class"] .
                ' alert-dismissible fade show" role="alert" id="main-alert">' .
                $_SESSION["flasher"]["pesan"] .
                "</strong> " .
                $_SESSION["flasher"]["aksi"] .
                '.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
            unset($_SESSION["flasher"]);
        }
    }
}
